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
      $this->container
           ->get('jelly.request')
           ->query('chacms.model.domain')
           ->delete();
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

} // End class ChaCMS_Core_Meta_DomainManager