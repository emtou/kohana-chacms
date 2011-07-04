<?php
/**
 * Declares ChaCMS_Core_Base_Model_Jelly
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/base/model/jelly.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Base_Model_Jelly
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/base/model/jelly.php
 */
abstract class ChaCMS_Core_Base_Model_Jelly extends Jelly_Model
{
  protected $_meta_model = NULL;


  /**
   * Gets or sets ChaCMS_Meta_Model aggregate
   *
   * @param ChaCMS_Meta_Model $meta_model optional agregate (in set mode)
   *
   * @return ChaCMS_Meta_Model|null agregate (in get mode)
   *
   * @see ChaCMS_Core_Interface_Linker::meta_model()
   *
   * @throws ChaCMS_Exception Can't find meta model aggregate: aggregate hasn\'t been set before use.
   */
  public function meta_model(ChaCMS_Meta_Model $meta_model = NULL)
  {
    if ($meta_model == NULL)
    {
      // get mode
      if ($this->_meta_model == NULL)
      {
        throw new ChaCMS_Exception(
          'Can\'t find meta model aggregate: aggregate hasn\'t been set before use.'
        );
      }

      return $this->_meta_model;
    }

    // set mode
    $this->_meta_model = $meta_model;
  }


  /**
   * Gets or sets the linkee
   *
   * @param ChaCMS_Interface_Linkable &$linkee optional linkee (in set mode)
   *
   * @return ChaCMS_Interface_Linkable|null linkee (in get mode)
   *
   * @see ChaCMS_Core_Interface_MonoLinker::linkee()
   */
  public function linkee(ChaCMS_Interface_Linkable & $linkee = NULL)
  {
    $mode = ($linkee == NULL)?'get':'set';

    if ( ! $this instanceof ChaCMS_Interface_MonoLinker)
    {
      throw new ChaCMS_Exception(
        'Can\'t '.$mode.' linkee: this object doesn\'t accept any linkee.'
      );
    }

    if ( ! $this instanceof ChaCMS_Interface_Linker)
    {
      throw new ChaCMS_Exception(
        'Can\'t '.$mode.' linkee: this object doesn\'t accept an unique linkee.'
      );
    }

    if ( ! $this->_meta_model instanceof ChaCMS_Meta_Model)
    {
      throw new ChaCMS_Exception(
        'Can\'t '.$mode.' linkee: ChaCMS_Model aggregate hasn\'t been set.'
      );
    }

    if ($mode == 'get')
    {
      return $this->_meta_model->link_manager()->get_linkee($this);
    }

    // set mode
    return $this->_meta_model->link_manager()->set_linkee($this, $linkee);

  }


  /**
   * Global setter
   *
   * only treats "container" setter (passes on to the chacms model)
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
        if ($this->_meta_model instanceof ChaCMS_Meta_Model)
        {
          $this->_meta_model->container = $value;
        }
      break;

      default :
        parent::__set($attr, $value);
      break;
    }
  }

} // End class ChaCMS_Core_Base_Model_Jelly