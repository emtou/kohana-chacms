<?php
/**
 * Declares ChaCMS_Core_Base_Manager
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/base/manager.php
 * @since     2011-06-28
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides base functionalities for all ChaCMS managers
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/base/manager.php
 */
abstract class ChaCMS_Core_Base_Manager
{
  protected $_cmsmeta = NULL;


  /**
   * Gets or sets meta aggregate
   *
   * @param ChaCMS_CMSMeta $cmsmeta optional meta aggregate (in set mode)
   *
   * @return ChaCMS_CMSMeta|NULL CMSMeta aggregate (in get mode)
   *
   * @throws ChaCMS_Exception Can't find CMSMeta aggregate: aggregate hasn\'t been set before use.
   */
  public function cmsmeta(ChaCMS_CMSMeta $cmsmeta = NULL)
  {
    if ($cmsmeta == NULL)
    {
      // get mode
      if ($this->_cmsmeta == NULL)
      {
        throw new ChaCMS_Exception(
          'Can\'t find meta aggregate: aggregate hasn\'t been set before use.'
        );
      }

      return $this->_cmsmeta;
    }

    // set mode
    $this->_cmsmeta = $cmsmeta;
  }

} // End class ChaCMS_Core_Base_Manager