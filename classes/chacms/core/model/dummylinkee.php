<?php
/**
 * Declares ChaCMS_Core_Model_DummyLinkee
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/dummylinkee.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Model_DummyLinkee
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/dummylinkee.php
 */
abstract class ChaCMS_Core_Model_DummyLinkee extends ChaCMS_Base_Model_Kohana implements ChaCMS_Interface_Linkable
{

  /**
   * Fetches this object URL (hash sign)
   *
   * @return string a hash sign
   *
   * @see ChaCMS_Interface_Linkable::linkee_url()
   */
  public function linkee_url()
  {
    return '#';
  }


  /**
   * Fetches this object title (Dummy link)
   *
   * @return string Dummy link
   *
   * @see ChaCMS_Interface_Linkable::linkee_title()
   */
  public function linkee_title()
  {
    return 'Dummy link';
  }

} // End class ChaCMS_Core_Model_DummyLinkee