<?php
/**
 * Declares ChaCMS_Core_Interface_Injector interface
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/interface/injector.php
 * @since     2011-06-20
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Interface_Injector interface
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/interface/injector.php
 */
interface ChaCMS_Core_Interface_Injector
{

  /**
   * Gets or sets this object's injector
   *
   * in «get» mode, injector is created if it does not exist
   *
   * @param Dependency_Container &$injector optional dependency injector
   *
   * @return Dependency_Container|null returns injector object in "get" mode
   */
  public function injector(Dependency_Container & $injector = NULL);

} // End interface ChaCMS_Core_Interface_Injector