<?php
/**
 * Declares ChaCMS_Core_Controller_Menu controller
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/controller/menu.php
 * @since     2011-06-28
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Controller_Menu controller
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/controller/menu.php
 */
abstract class ChaCMS_Core_Controller_Menu extends ChaCMS_Base_Controller
{

  /**
   * Configures actions managed by the Dispatcher
   *
   * @return null
   */
  protected function _configure_actions()
  {
    $this->_configure_action(
        'render',
         array(
          Controller_Dispatcher::METHOD_GET,
        )
    );
  }


  /**
   * Call Dispatcher's configuration
   *
   * @return null
   */
  public function before()
  {
    parent::before();

    $this->_configure_actions();
  }


  /**
   * Renders a menu
   *
   * @param string $code code of the menu
   *
   * @return null
   */
  public function action_render($code)
  {
    $params         = array();
    $params['code'] = $code;

    $this->_do_action($params);
  }


  /**
   * Fetches the menu and its items
   *
   * @param array &$params additional parameters
   *
   * @return null
   *
   * @throws ChaCMS_Exception Can't load ChaCMS Menu with code «CODE».
   */
  protected function _action_render_init(array & $params)
  {

  }


  /**
   * Renders the menu
   *
   * @param array &$params additional parameters
   *
   * @return null
   */
  protected function _action_render_get(array & $params)
  {
    $this->response->body("TODO");
  }


} // End class ChaCMS_Core_Controller_Menu