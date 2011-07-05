<?php
/**
 * Declares ChaCMS_Core_Meta_DomainManager
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/meta/domainmanager.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Meta_DomainManager
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/meta/domainmanager.php
 */
abstract class ChaCMS_Core_Meta_DomainManager
{
  protected $_domains      = array();
  protected $_domain_codes = array();


  /**
   * Load a domain in the internal container from its code
   *
   * @param string $domain_code Domain code to load in internal container
   * @param bool   $force       Impose reload if Domain already in internal container
   *
   * @return null
   *
   * @throws ChaCMS_Exception Can't load domain: domain with code=:code does not exist.
   */
  protected function _load_from_code($domain_code, $force = FALSE)
  {
    if ($this->get($domain_code) === NULL
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
        throw new ChaCMS_Exception(
          'Can\'t load domain: domain with code=:code does not exist.',
          array(':code' => $domain_code)
        );
      }

      $this->_domains[ (string) $domain->id] = $domain;
      $this->_domain_codes[$domain->code]    = $domain->id;
    }
  }


  /**
   * Load a domain in the internal container from its id
   *
   * @param int  $domain_id Domain ID to load in internal container
   * @param bool $force     Impose reload if Domain already in internal container
   *
   * @return null
   */
  protected function _load_from_id($domain_id, $force = FALSE)
  {
    if ($this->get($domain_id) === NULL
        or $force)
    {
      $domain = $this->container
                        ->get('chacms.model.domain', $domain_id);

      if ( ! $domain->loaded())
      {
        throw new ChaCMS_Exception(
          'Can\'t load domain: domain with ID=:id does not exist.',
          array(':id' => $domain_id)
        );
      }

      $this->_domains[ (string) $domain->id] = $domain;
      $this->_domain_codes[$domain->code]    = $domain->id;
    }
  }


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
   * Delete all domains
   *
   * @return null
   */
  public function delete_all()
  {
    $this->load_all();

    foreach ($this->all() as $domain)
    {
      $domain->delete();
    }

    $this->unload_all();
  }


  /**
   * Returns a domain instance from internal container
   *
   * @param int|string $domain ID or code of the domain
   *
   * @return Model_ChaCMS_Domain|NULL
   *
   * @throws ChaCMS_Exception Can't get domain: parameter not understood.
   */
  public function get($domain)
  {
    switch (TRUE) {
      case (is_int($domain)):
        if (isset($this->_domains[ (string) $domain]))
        {
          return $this->_domains[ (string) $domain];
        }
      break;

      case (is_string($domain)):
        if (isset($this->_domain_codes[$domain]))
        {
          return $this->get($this->_domain_codes[$domain]);
        }
      break;

      default :
        throw new ChaCMS_Exception('Can\'t get domain: parameter not understood.');
    }

    return NULL;
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
        $domain       = $this->container->get('chacms.model.domain');
        $domain->code = $data[0];
        $domain->name = $data[1];

        try
        {
          $domain->save();

          $this->load($domain);

          $nb_imported++;
        }
        catch (Exception $exception)
        {
        }
      }
      fclose($handle);
    }

    return $nb_imported;
  }


  /**
   * Load a domain in the internal container
   *
   * @param int|string|Model_ChaCMS_Domain $domain Domain ID, code or instance to load in internal container
   * @param bool                           $force  Impose reload if Domain already in internal container
   *
   * @return null
   */
  public function load($domain, $force = FALSE)
  {
    switch (TRUE)
    {
      case ($domain instanceof Model_ChaCMS_Domain):
        $this->_domains[ (string) $domain->id] = $domain;
      break;

      case (is_int($domain)):
        $this->_load_from_id($domain, $force);
      break;

      case (is_string($domain)):
        $this->_load_from_code($domain, $force);
      break;

      default :
        throw new ChaCMS_Exception('Can\'t load domain: parameter not understood.');
    }
  }


  /**
   * Load all domains from database in internal container
   *
   * @return null
   */
  public function load_all()
  {
    $this->unload_all();

    $all_domains = $this->container
                        ->get('jelly.request')
                        ->query('chacms.model.domain')
                        ->select();

    foreach ($all_domains as $domain)
    {
      $this->load($domain, TRUE);
    }
  }


  /**
   * Unload all domains in internal container
   *
   * @return null
   */
  public function unload_all()
  {
    $this->_domains = array();
  }

} // End class ChaCMS_Core_Meta_DomainManager