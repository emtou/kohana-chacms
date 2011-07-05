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
  protected $_domains = array();


  /**
   * Creates this instance
   *
   * @return null
   */
  public function __construct()
  {

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
   * Load a domain in the internal container
   *
   * @param int|Model_ChaCMS_Domain $domain Domain ID or Domain instance to load
   * @param bool                    $force  Impose reload if Domain already in internal container
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
        if ($this->get($domain) === NULL
            or $force)
        {
          $domain_id = $domain;
          $domain    = $this->container
                            ->get('chacms.model.domain', $domain_id);

          if ( ! $domain->loaded())
          {
            throw new ChaCMS_Exception(
              'Can\'t load domain: domain with ID=:id does not exist.',
              array(':id' => $domain_id)
            );
          }

          $this->_domains[ (string) $domain->id] = $domain;
        }
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


  /**
   * Returns internal container
   *
   * @return array() all loaded models
   */
  public function all()
  {
    return $this->_domains;
  }

} // End class ChaCMS_Core_Meta_DomainManager