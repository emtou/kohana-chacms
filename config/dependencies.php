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

    'cmsmeta' => array(
      '_settings' => array(
        'arguments'   => array(
                            '%chacms.domainmanager%',
                            '%chacms.foldermanager%',
                            '%chacms.linkmanager%'
                         ),
        'constructor' => '',
        'class'       => 'ChaCMS_CMSMeta',
        'shared'      => TRUE,
      ),
    ),

    'domainmanager' => array(
      '_settings' => array(
        'class'  => 'ChaCMS_DomainManager',
        'shared' => TRUE,
      ),
    ),

    'foldermanager' => array(
      '_settings' => array(
        'class'  => 'ChaCMS_FolderManager',
        'shared' => TRUE,
      ),
    ),

    'linkmanager' => array(
      '_settings' => array(
        'class'  => 'ChaCMS_LinkManager',
        'shared' => TRUE,
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

      'folder' => array(
        '_settings' => array(
          'arguments'   => array('chacms_folder'),
          'class'       => 'Jelly',
          'constructor' => 'factory',
          'methods'     => array(
            array('cmsmeta', array('%chacms.cmsmeta%')),
          ),
        ),
      ),

      'menu' => array(
        '_settings' => array(
          'arguments'   => array('chacms_menu'),
          'class'       => 'Jelly',
          'constructor' => 'factory',
          'methods'     => array(
            array('cmsmeta', array('%chacms.cmsmeta%')),
          ),
        ),
      ),

      'menuitem' => array(
        '_settings' => array(
          'arguments'   => array('chacms_menuitem'),
          'class'       => 'Jelly',
          'constructor' => 'factory',
          'methods'     => array(
            array('cmsmeta', array('%chacms.cmsmeta%')),
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