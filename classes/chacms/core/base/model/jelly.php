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
  protected $_cmsmeta = NULL;


  /**
   * Gets or sets CMSMeta aggregate
   *
   * @param ChaCMS_CMSMeta $cmsmeta optional CMSMeta agregate (in set mode)
   *
   * @return ChaCMS_CMSMeta|null agregate (in get mode)
   *
   * @see ChaCMS_Core_Interface_Linker::cmsmeta()
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
          'Can\'t find CMSMeta aggregate: aggregate hasn\'t been set before use.'
        );
      }

      return $this->_cmsmeta;
    }

    // set mode
    $this->_cmsmeta = $cmsmeta;
  }


  /**
   * Gets or sets the linkee
   *
   * @param ChaCMS_Interface_Linkable &$linkee optional linkee (in set mode)
   *
   * @return ChaCMS_Interface_Linkable|null linkee (in get mode)
   *
   * @see ChaCMS_Core_Interface_MonoLinker::linkee()
   *
   * @throws ChaCMS_Exception Can't :get_or_set linkee: this model doesn't accept any linkee.
   * @throws ChaCMS_Exception Can't :get_or_set linkee: this model doesn't accept an unique linkee.
   * @throws ChaCMS_Exception Can't :get_or_set linkee: meta model aggregate hasn't been set.
   */
  public function linkee(ChaCMS_Interface_Linkable & $linkee = NULL)
  {
    $mode = ($linkee == NULL)?'get':'set';

    if ( ! $this instanceof ChaCMS_Interface_MonoLinker)
    {
      throw new ChaCMS_Exception(
        'Can\'t :get_or_set linkee: this model doesn\'t accept any linkee.',
        array(':get_or_set', $mode)
      );
    }

    if ( ! $this instanceof ChaCMS_Interface_Linker)
    {
      throw new ChaCMS_Exception(
        'Can\'t :get_or_set linkee: this model doesn\'t accept an unique linkee.',
        array(':get_or_set', $mode)
      );
    }

    if ( ! $this->_cmsmeta instanceof ChaCMS_CMSMeta)
    {
      throw new ChaCMS_Exception(
        'Can\'t :get_or_set linkee: CMSMeta aggregate hasn\'t been set.',
        array(':get_or_set', $mode)
      );
    }

    if ($mode == 'get')
    {
      return $this->cmsmeta->linkmanager()->get_linkee($this);
    }

    // set mode
    return $this->cmsmeta->linkmanager()->set_linkee($this, $linkee);

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
        if ($this->_cmsmeta instanceof ChaCMS_CMSMeta)
        {
          $this->_cmsmeta->container = $value;
        }
      break;

      default :
        parent::__set($attr, $value);
      break;
    }
  }

} // End class ChaCMS_Core_Base_Model_Jelly