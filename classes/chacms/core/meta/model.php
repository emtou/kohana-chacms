<?php
/**
 * Declares ChaCMS_Core_Meta_Model
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/meta/model.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Meta_Model
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/meta/model.php
 */
abstract class ChaCMS_Core_Meta_Model
{
  protected $_link_manager = NULL;


  /**
   * Creates this occurence with optional link manager aggregate
   *
   * @param ChaCMS_Link_Manager $link_manager optional agregate
   *
   * @return null
   */
  public function __construct(ChaCMS_Meta_LinkManager $link_manager = NULL)
  {
    if ($link_manager instanceof ChaCMS_Meta_LinkManager)
    {
      $this->link_manager($link_manager);
    }
  }


  /**
   * Gets or sets meta linkmanager aggregate
   *
   * @param ChaCMS_Meta_LinkManager $link_manager optional agregate (in set mode)
   *
   * @return ChaCMS_Meta_LinkManager|null agregate (in get mode)
   *
   * @throws ChaCMS_Exception Can't find meta link manager aggregate: aggregate hasn\'t been set before use.
   */
  public function link_manager(ChaCMS_Meta_LinkManager $link_manager = NULL)
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


  /**
   * Global setter
   *
   * only treats "container" setter (passes on to the link manager)
   *
   * @param string $attr  attribute name to set
   * @param mixed  $value value to set
   *
   * @return null
   */
  public function __set($attr, $value)
  {
    switch ($attr) {
      case 'container';
        $this->container = $value;
        if ($this->_link_manager instanceof ChaCMS_Meta_LinkManager)
        {
          $this->_link_manager->container = $value;
        }
      break;

      default :
        parent::$attr = $value;
      break;
    }
  }

} // End class ChaCMS_Core_Meta_Model