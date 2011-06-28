<?php
/**
 * Declares Charougna_ChaCMS helper
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/charougna/chacms.php
 * @since     2011-06-20
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides Charougna_ChaCMS helper
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/charougna/chacms.php
 */
class Charougna_ChaCMS
{

  /**
   * Gets database table prefix
   *
   * @return string prefix
   *
   * @todo fetch from configuration variable
   */
  public static function db_table_prefix()
  {
    return 'cms_';
  }

} // End class Charougna_ChaCMS