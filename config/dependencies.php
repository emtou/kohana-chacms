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

    'meta' => array(
      'model' => array(
        '_settings' => array(
          'arguments'   => array('%chacms.link_manager%'),
          'constructor' => '',
          'class'       => 'ChaCMS_Meta_Model',
          'shared'      => TRUE,
        ),
      ),
    ),

    'model' => array(
      'domain' => array(
        '_settings' => array(
          'arguments'   => array('chacms_domain'),
          'class'       => 'Model',
          'constructor' => 'factory',
        ),
      ),

      'dummylinkee' => array(
        '_settings' => array(
          'arguments'   => array('chacms_dummylinkee'),
          'class'       => 'Model',
          'constructor' => 'factory',
        ),
      ),

      'menu' => array(
        '_settings' => array(
          'arguments'   => array('chacms_menu'),
          'class'       => 'Jelly',
          'constructor' => 'factory',
        ),
      ),

      'menuitem' => array(
        '_settings' => array(
          'arguments'   => array('chacms_menuitem'),
          'class'       => 'Jelly',
          'constructor' => 'factory',
          'methods'     => array(
            array('meta_model', array('%chacms.meta.model%')),
          ),
        ),
      ),

      'page' => array(
        '_settings' => array(
          'arguments' => array('chacms_page'),
          'class'     => 'Model',
          'constructor' => 'factory',
        ),
      ),
    ),
  ),
);