<?php
/**
 * Declares ChaCMS_Core_Model
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Model
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model.php
 */
abstract class ChaCMS_Core_Model
{
  protected $_link_manager = NULL;


  /**
   * Creates this occurence with optional link manager aggregate
   *
   * @param ChaCMS_Link_Manager &$link_manager optional agregate
   *
   * @return null
   */
  public function __construct(ChaCMS_Link_Manager & $link_manager = NULL)
  {
    if ($link_manager instanceof ChaCMS_Link_Manager)
    {
      $this->link_manager($link_manager);
    }
  }


  /**
   * Gets or sets ChaCMS_Link_Manager aggregate
   *
   * @param ChaCMS_Link_Manager &$link_manager optional agregate (in set mode)
   *
   * @return ChaCMS_Link_Manager|null agregate (in get mode)
   *
   * @throws ChaCMS_Exception Can't find link manager aggregate: aggregate hasn\'t been set before use.
   */
  public function link_manager(ChaCMS_Link_Manager & $link_manager = NULL)
  {
    if ($link_manager == NULL)
    {
      // get mode
      if ($this->_link_manager == NULL)
      {
        throw new ChaCMS_Exception(
          'Can\'t find link manager aggregate: aggregate hasn\'t been set before use.'
        );
      }

      return $this->_link_manager;
    }

    // set mode
    $this->_link_manager = $link_manager;
  }


} // End class ChaCMS_Core_Model