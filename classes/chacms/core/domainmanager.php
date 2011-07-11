<?php
/**
 * Declares ChaCMS_Core_DomainManager
 *
 * PHP version 5
 *
 * @group ChaCMS
 *
 * @category  ChaCMS
 * @package   ChaCMS
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/domainmanager.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_DomainManager
 *
 * PHP version 5
 *
 * @group ChaCMS
 *
 * @category  ChaCMS
 * @package   ChaCMS
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/domainmanager.php
 */
abstract class ChaCMS_Core_DomainManager extends ChaCMS_Base_Manager
{
  protected $_domains      = array();
  protected $_domain_codes = array();


  /**
   * Creates this instance
   *
   * @return null
   */
  public function __construct()
  {

  }


  /**
   * Returns internal container
   *
   * @return array() all loaded models
   */
  public function all()
  {
    return $this->_domains;
  }


  /**
   * Creates a Domain instance and register it
   *
   * @param array $fields array of Domain fields
   *
   * @return Model_ChaCMS_Domain created model
   *
   * @throws ChaCMS_Exception Can't create domain: :exception
   * @throws ChaCMS_Exception Can't create root folder for domain «:domaincode»: :exception
   * @throws ChaCMS_Exception Can't attach root folder to domain «:domaincode»: :exception
   */
  public function create(array $fields)
  {
    try
    {
      $domain = $this->container->get('chacms.model.domain');

      foreach ($fields as $field_name => $field_value)
      {
        $domain->$field_name = $field_value;
      }

      $domain->save();
    }
    catch (Exception $exception)
    {
      throw new ChaCMS_Exception(
        'Can\'t create domain: :exception',
        array(':exception' => $exception->getMessage())
      );
    }

    try
    {
      $rootfolder = $this->cmsmeta()->foldermanager()->create(
          array(
            'code'   => $domain->code.'_root',
            'domain' => $domain,
            'name'   => '',
            'parent' => 0,
          )
      );
    }
    catch (Exception $exception)
    {
      throw new ChaCMS_Exception(
        'Can\'t create root folder for domain «:domaincode»: :exception',
        array(
          ':domaincode' => $domain->code,
          ':exception'  => $exception->getMessage()
        )
      );
    }

    try
    {
      $domain->rootfolder = $rootfolder;
      $domain->save();
    }
    catch (Exception $exception)
    {
      throw new ChaCMS_Exception(
        'Can\'t attach root folder to domain «:domaincode»: :exception',
        array(
          ':domaincode' => $domain->code,
          ':exception'  => $exception->getMessage()
        )
      );
    }

    $this->register($domain);

    return $domain;
  }


  /**
   * Deletes all domains in database
   *
   * @return null
   */
  public function delete_all()
  {
    $this->register_all();

    foreach ($this->all() as $domain)
    {
      $domain->delete();
    }

    $this->unregister_all();
  }


  /**
   * Finds a domain instance by code or ID
   *
   * First looks for a registered instance, then tries to load it from database
   *
   * @param int|string $domain Code or ID of the domain to find
   *
   * @return Model_ChaCMS_Domain|NULL
   *
   * @throws ChaCMS_Exception Can't get domain: parameter should be an ID or a code.
   */
  public function get($domain)
  {
    if ($this->is_registered($domain))
    {
      switch (TRUE) {
        case (is_int($domain)):
          return $this->_domains[ (string) $domain];

        case (is_string($domain)):
          return $this->get($this->_domain_codes[$domain]);

        default :
          throw new ChaCMS_Exception('Can\'t get domain: parameter should be a code or an code.');
      }
    }

    return $this->load($domain);
  }


  /**
   * Imports domain definitions into database
   *
   * Import file should define 2 fields, separated by a semi-colon. Its
   * first line is not imported (header)
   *
   * @param string $csvfile_name           Name of the CSV file to read definitions from
   * @param bool   $truncate_before_import Does the domain table needs truncating before import ?
   *
   * @return int number of imported domains
   */
  public function import_from_csvfile($csvfile_name, $truncate_before_import=FALSE)
  {
    if ($truncate_before_import)
    {
      $this->delete_all();
    }

    $nb_imported = 0;

    if (($handle = fopen($csvfile_name, "r")) !== FALSE)
    {
      $row_number = 1;

      // discard header
      $header = fgetcsv($handle, 1000, ";");

      while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
      {
        try
        {
          $this->create(
              array(
                'code' => $data[0],
                'name' => $data[1],
              )
          );

          $nb_imported++;
        }
        catch (Exception $exception)
        {
          throw $exception;
        }
      }
      fclose($handle);
    }

    return $nb_imported;
  }


  /**
   * Checks if a domain instance is registered by the manager
   *
   * @param int|string $domain Code or ID of the domain to check
   *
   * @return bool
   */
  public function is_registered($domain)
  {
    switch (TRUE) {
      case (is_int($domain)):
        return isset($this->_domains[ (string) $domain]);

      case (is_string($domain)):
        return isset($this->_domains[$this->_domain_codes[$domain]]);

      default :
        return FALSE;
    }
  }


  /**
   * Load a domain from database by its code or ID
   *
   * @param int|string $domain Domain code or ID to load
   * @param bool       $force  Impose reload if Domain already in internal container
   *
   * @return Model_ChaCMS_Model|NULL model if loaded
   */
  public function load($domain, $force = FALSE)
  {
    switch (TRUE)
    {
      case (is_int($domain)):
        return $this->_load_by_id($domain, $force);

      case (is_string($domain)):
        return $this->_load_by_code($domain, $force);

      default :
        return NULL;
    }
  }


  /**
   * Load a domain from database by its code
   *
   * @param string $domain_code Domain code to load in internal container
   * @param bool   $force       Impose reload if Domain already in internal container
   *
   * @return Model_ChaCMS_Model|NULL model if loaded
   */
  public function load_by_code($domain_code, $force = FALSE)
  {
    if ( ! isset($this->_domain_codes[$domain_code])
         or $force)
    {
      $domain = $this->container
                        ->get('jelly.request')
                        ->query('chacms.model.domain')
                        ->where('code', '=', $domain_code)
                        ->limit(1)
                        ->select();

      if ( ! $domain->loaded())
      {
        return NULL;
      }

      $this->register($domain);
    }

    return $this->_domain_codes[$domain_code];
  }


  /**
   * Load a domain from database by its id
   *
   * @param int  $domain_id Domain ID to load in internal container
   * @param bool $force     Impose reload if Domain already in internal container
   *
   * @return Model_ChaCMS_Model|NULL model if loaded
   */
  public function load_by_id($domain_id, $force = FALSE)
  {
    if ( ! isset($this->_domains[ (string) $domain_id])
        or $force)
    {
      $domain = $this->container
                        ->get('chacms.model.domain', $domain_id);

      if ( ! $domain->loaded())
      {
        return NULL;
      }

      $this->register($domain);
    }

    return $this->_domains[ (string) $domain_id];
  }


  /**
   * Registers a domain in the internal container
   *
   * @param Model_ChaCMS_Domain $domain Domain instance to register in internal container
   *
   * @return null
   */
  public function register(Model_ChaCMS_Domain $domain)
  {
    $this->_domains[ (string) $domain->id] = $domain;
    $this->_domain_codes[$domain->code]    = $domain->id;
  }


  /**
   * Registers all domains from database in internal container
   *
   * @return null
   */
  public function register_all()
  {
    $this->unregister_all();

    $all_domains = $this->container
                        ->get('jelly.request')
                        ->query('chacms.model.domain')
                        ->select();

    foreach ($all_domains as $domain)
    {
      $this->register($domain);
    }
  }


  /**
   * Unregisters all domains in internal container
   *
   * @return null
   */
  public function unregister_all()
  {
    $this->_domains      = array();
    $this->_domain_codes = array();
  }

} // End class ChaCMS_Core_DomainManager