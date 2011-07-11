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
  protected $_meta = NULL;


  /**
   * Gets or sets meta aggregate
   *
   * @param ChaCMS_Meta_Model $meta optional meta aggregate (in set mode)
   *
   * @return ChaCMS_Meta_Model|NULL meta aggregate (in get mode)
   *
   * @throws ChaCMS_Exception Can't find meta aggregate: aggregate hasn\'t been set before use.
   */
  public function meta(ChaCMS_Meta_Model $meta = NULL)
  {
    if ($meta == NULL)
    {
      // get mode
      if ($this->_meta == NULL)
      {
        throw new ChaCMS_Exception(
          'Can\'t find meta aggregate: aggregate hasn\'t been set before use.'
        );
      }

      return $this->_meta;
    }

    // set mode
    $this->_meta = $meta;
  }

} // End class ChaCMS_Core_Base_Manager