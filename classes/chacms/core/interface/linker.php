<?php
/**
 * Declares ChaCMS_Core_Interface_Linker
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/interface/linker.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Interface_Linker
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/interface/linker.php
 */
interface ChaCMS_Core_Interface_Linker
{
  /**
   * Gets or sets ChaCMS_Model aggregate
   *
   * @param ChaCMS_Model $chacms_model optional agregate (in set mode)
   *
   * @return ChaCMS_Model|null agregate (in get mode)
   */
  public function chacms_model(ChaCMS_Model $chacms_model = NULL);

} // End class ChaCMS_Core_Interface_Linker