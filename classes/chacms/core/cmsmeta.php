<?php
/**
 * Declares ChaCMS_Core_CMSMeta
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/cmsmeta.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_CMSMeta
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/cmsmeta.php
 */
abstract class ChaCMS_Core_CMSMeta
{
  protected $_domainmanager = NULL;
  protected $_foldermanager = NULL;
  protected $_linkmanager   = NULL;


  /**
   * Creates this occurence with optional link manager aggregate
   *
   * @param ChaCMS_DomainManager $domainmanager mandatory domain manager aggregate
   * @param ChaCMS_FolderManager $foldermanager mandatory folder manager aggregate
   * @param ChaCMS_LinkManager   $linkmanager   mandatory link manager agregate
   *
   * @return null
   */
  public function __construct(ChaCMS_DomainManager $domainmanager, ChaCMS_FolderManager $foldermanager, ChaCMS_LinkManager $linkmanager)
  {
    $this->domainmanager($domainmanager);

    $this->foldermanager($foldermanager);

    $this->linkmanager($linkmanager);
  }


  /**
   * Gets or sets domain manager aggregate
   *
   * @param ChaCMS_DomainManager $domainmanager optional domain manager aggregate (in set mode)
   *
   * @return ChaCMS_DomainManager|null aggregate (in get mode)
   *
   * @throws ChaCMS_Exception Can't find domain manager aggregate: aggregate hasn\'t been set before use.
   */
  public function domainmanager(ChaCMS_DomainManager $domainmanager = NULL)
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

    $this->_domainmanager->cmsmeta($this);
  }


  /**
   * Gets or sets folder manager aggregate
   *
   * @param ChaCMS_FolderManager $foldermanager optional folder manager aggregate (in set mode)
   *
   * @return ChaCMS_FolderManager|null aggregate (in get mode)
   *
   * @throws ChaCMS_Exception Can't find folder manager aggregate: aggregate hasn\'t been set before use.
   */
  public function foldermanager(ChaCMS_FolderManager $foldermanager = NULL)
  {
    if ($foldermanager == NULL)
    {
      // get mode
      if ($this->_foldermanager == NULL)
      {
        throw new ChaCMS_Exception(
          'Can\'t folder manager aggregate: aggregate hasn\'t been set before use.'
        );
      }

      return $this->_foldermanager;
    }

    // set mode
    $this->_foldermanager = $foldermanager;

    $this->_foldermanager->cmsmeta($this);
  }


  /**
   * Gets or sets linkmanager aggregate
   *
   * @param ChaCMS_LinkManager $linkmanager link manager optional agregate (in set mode)
   *
   * @return ChaCMS_LinkManager|null agregate (in get mode)
   *
   * @throws ChaCMS_Exception Can't find link manager aggregate: aggregate hasn\'t been set before use.
   */
  public function linkmanager(ChaCMS_LinkManager $linkmanager = NULL)
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

    $this->_linkmanager->cmsmeta($this);
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
        $this->container                 = $value;
        $this->_domainmanager->container = $value;
        $this->_foldermanager->container = $value;
        $this->_linkmanager->container   = $value;
      break;

      default :
        parent::$attr = $value;
      break;
    }
  }

} // End class ChaCMS_Core_CMSMeta