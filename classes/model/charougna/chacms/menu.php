<?php
/**
 * Declares Charougna_ChaCMS_Menu model
 *
 * PHP version 5
 *
 * @group ChaCMS
 *
 * @category  ChaCMS
 * @package   ChaCMS.Menu
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/model/charougna/menu.php
 * @since     2011-06-20
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides Charougna_ChaCMS_Menu model
 *
 * PHP version 5
 *
 * @group ChaCMS
 *
 * @category  ChaCMS
 * @package   ChaCMS.Menu
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/model/charougna/menu.php
 */
class Model_Charougna_ChaCMS_Menu extends Jelly_Model
{

  /**
   * Fields declaration
   *
   * @param Jelly_Meta $meta Access to Jelly framework
   *
   * @return null
   */
  public static function initialize(Jelly_Meta $meta)
  {
    $meta->table(ChaCMS::db_table_prefix().'menus')
         ->fields(
             array(
              'id' =>    new Jelly_Field_Primary,
              'code' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                                array('UTF8::strtolower'),
                            ),
                            'label' => 'Menu code',
                            'name' => 'Menu code',
                            'rules' => array(
                                array('max_length', array(':value', 64)),
                                array('mb-check-encoding', array(':value', 'UTF-8')),
                            ),
                            'unique' => TRUE,
                          )),
              'label' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                            ),
                            'label' => 'Menu label',
                            'name' => 'Menu label',
                            'rules' => array(
                                array('max_length', array(':value', 128)),
                                array('mb-check-encoding', array(':value', 'UTF-8')),
                                array('not_empty'),
                            ),
                          )),
              'items' =>  new Jelly_Field_HasMany(array(
                            'foreign' => 'ChaCMS_MenuItem.menu_id',
                            'label' => 'Items attached to this menu',
                            'name' => 'Items attached to this menu',
                          )),
             )
         );
  }

} // End class Model_Charougna_ChaCMS_Menu