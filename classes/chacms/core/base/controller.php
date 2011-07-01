<?php
/**
 * Declares ChaCMS_Core_Base_Controller controller
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/base/controller.php
 * @since     2011-06-28
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Base_Controller controller
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/base/controller.php
 */
abstract class ChaCMS_Core_Base_Controller extends Controller_Dispatcher implements ChaCMS_Core_Interface_Injector
{
  protected $_injector        = NULL;


  /**
   * Gets or sets this object's injector
   *
   * in «get» mode, injector is created if it does not exist
   *
   * @param Dependency_Container &$injector optional dependency injector
   *
   * @return Dependency_Container|null returns injector object in "get" mode
   *
   * @see Interface_ChaCMS_Core_Injector::injector()
   */
  public function injector(Dependency_Container & $injector = NULL)
  {
    if ($injector == NULL)
    {
      // get mode
      if ($this->_injector == NULL)
      {
        $definitions     = Dependency_Definition_List::factory()
                              ->from_array(Kohana::config('dependencies')->as_array());
        $this->_injector = new Dependency_Container($definitions);
      }

      return $this->_injector;
    }

    // set mode
    $this->_injector = $injector;
  }

} // End class ChaCMS_Core_Base_Controller