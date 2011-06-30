<?php
/**
 * Declares ChaCMS_Core_Link_Manager
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/link/manager.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Link_Manager
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/link/manager.php
 */
abstract class ChaCMS_Core_Link_Manager
{

  /**
   * Gets the linkee of a linker occurence
   *
   * @param ChaCMS_Interface_MonoLinker &$linker linker
   *
   * @return ChaCMS_Interface_Linkable linkee
   *
   * @todo fetch the linkee or return a dummy linkee
   */
  public function get_linkee(ChaCMS_Interface_MonoLinker & $linker)
  {
    return NULL;
  }


  /**
   * Sets the linkee of a linker occurence
   *
   * @param ChaCMS_Interface_MonoLinker &$linker linker
   * @param ChaCMS_Interface_Linkee     &$linkee linkee
   *
   * @return null
   *
   * @todo set the linkee
   */
  public function set_linkee(ChaCMS_Interface_MonoLinker & $linker, ChaCMS_Interface_Linkee & $linkee)
  {
    return NULL;
  }

} // End class ChaCMS_Core_Link_Manager