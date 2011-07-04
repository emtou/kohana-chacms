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
  protected $_domainmanager = NULL;
  protected $_linkmanager   = NULL;


  /**
   * Creates this occurence with optional link manager aggregate
   *
   * @param ChaCMS_Meta_DomainManager $domainmanager mandatory domain manager aggregate
   * @param ChaCMS_Meta_LinkManager   $linkmanager   mandatory link manager agregate
   *
   * @return null
   */
  public function __construct(ChaCMS_Meta_DomainManager $domainmanager, ChaCMS_Meta_LinkManager $linkmanager)
  {
    $this->domainmanager($domainmanager);

    if ($linkmanager instanceof ChaCMS_Meta_LinkManager)
    {
      $this->linkmanager($linkmanager);
    }
  }


  /**
   * Gets or sets meta domain manager aggregate
   *
   * @param ChaCMS_Meta_DomainManager $domainmanager optional domain manager aggregate (in set mode)
   *
   * @return ChaCMS_Meta_DomainManager|null aggregate (in get mode)
   *
   * @throws ChaCMS_Exception Can't find meta domain manager aggregate: aggregate hasn\'t been set before use.
   */
  public function domainmanager(ChaCMS_Meta_DomainManager $domainmanager = NULL)
  {
    if ($domainmanager == NULL)
    {
      // get mode
      if ($this->_domainmanager == NULL)
      {
        throw new ChaCMS_Exception(
          'Can\'t find domain manager aggregate: aggregate hasn\'t been set before use.'
        );
      }

      return $this->_domainmanager;
    }

    // set mode
    $this->_domainmanager = $domainmanager;
  }


  /**
   * Gets or sets meta linkmanager aggregate
   *
   * @param ChaCMS_Meta_LinkManager $linkmanager optional agregate (in set mode)
   *
   * @return ChaCMS_Meta_LinkManager|null agregate (in get mode)
   *
   * @throws ChaCMS_Exception Can't find meta link manager aggregate: aggregate hasn\'t been set before use.
   */
  public function linkmanager(ChaCMS_Meta_LinkManager $linkmanager = NULL)
  {
    if ($linkmanager == NULL)
    {
      // get mode
      if ($this->_linkmanager == NULL)
      {
        throw new ChaCMS_Exception(
          'Can\'t find link manager aggregate: aggregate hasn\'t been set before use.'
        );
      }

      return $this->_linkmanager;
    }

    // set mode
    $this->_linkmanager = $linkmanager;
  }


  /**
   * Global setter
   *
   * only treats "container" setter (passes on to the domain and link managers)
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
        if ($this->_linkmanager instanceof ChaCMS_Meta_LinkManager)
        {
          $this->_linkmanager->container = $value;
        }
        if ($this->_domainmanager instanceof ChaCMS_Meta_DomainManager)
        {
          $this->_domainmanager->container = $value;
        }
      break;

      default :
        parent::$attr = $value;
      break;
    }
  }

} // End class ChaCMS_Core_Meta_Model