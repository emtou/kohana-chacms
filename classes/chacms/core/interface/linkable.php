<?php
/**
 * Declares ChaCMS_Core_Interface_Linkable
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/interface/linkable.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Interface_Linkable
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/interface/linkable.php
 */
interface ChaCMS_Core_Interface_Linkable
{

  /**
   * Fetches this object URL
   *
   * @return string url
   */
  public function linkee_url();


  /**
   * Fetches this linkee title
   *
   * @return string title
   */
  public function linkee_title();

} // End class ChaCMS_Core_Interface_Linkable