<?php
/**
 * Declares «ChaCMS» dependency injection configuration
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/config/injection/chacms.php
 * @since     2011-06-20
 */

defined('SYSPATH') OR die('No direct access allowed.');

return array(
  'chacms' => array(
    '_settings' => array(
      'arguments' => array(),
      'constructor' => '',
    ),

    'link_manager' => array(
      '_settings' => array(
        'class'  => 'ChaCMS_Link_Manager',
        'shared' => TRUE,
      ),
    ),

    'model' => array(
      'dummylinkee' => array(
        '_settings' => array(
          'arguments' => array('chacms_dummylinkee'),
          'class'     => 'Model',
          'constructor' => 'factory',
        ),
      ),
    ),
  ),

  // @todo refactor Menu and MenuItem models to chacms prefix
  'model' => array(
    '_settings' => array(
      'class'       => 'Jelly',
      'constructor' => 'factory',
    ),

    'chacms_menu' => array(
      '_settings' => array(
        'arguments' => array('chacms_menu'),
      ),
    ),

    'chacms_menuitem' => array(
      '_settings' => array(
        'arguments' => array('chacms_menuitem'),
      ),
    ),
  ),
);