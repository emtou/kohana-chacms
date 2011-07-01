<?php
/**
 * Declares ChaCMS_Core_Interface_MonoLinker
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/interface/monolinker.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Interface_MonoLinker
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/interface/monolinker.php
 */
interface ChaCMS_Core_Interface_MonoLinker extends ChaCMS_Interface_Linker
{
  /**
   * Gets or sets the linkee
   *
   * @param ChaCMS_Interface_Linkable &$linkee optional linkee (in set mode)
   *
   * @return ChaCMS_Interface_Linkable|null linkee (in get mode)
   */
  public function linkee(ChaCMS_Interface_Linkable & $linkee = NULL);

} // End class ChaCMS_Core_Interface_MonoLinker