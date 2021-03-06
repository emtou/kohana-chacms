<?php
/**
 * Declares ChaCMS_Core_Model_Menu model
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/menu.php
 * @since     2011-06-20
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Model_Menu model
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/menu.php
 */
class ChaCMS_Core_Model_Menu extends ChaCMS_Model_Jelly
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
                                array('mb_check_encoding', array(':value', 'UTF-8')),
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
                                array('mb_check_encoding', array(':value', 'UTF-8')),
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


  /**
   * Deletes this menu and all its elements
   *
   * @return  boolean
   */
  public function delete()
  {
    $db = Database::instance($this->meta()->db());

    $db->begin();

    try
    {
      foreach ($this->items as $item)
      {
        $item->delete();
      }
      parent::delete();

      $db->commit();
    }
    catch (Database_Exception $e)
    {
      $db->rollback();
      return FALSE;
    }

    return TRUE;
  }

} // End class ChaCMS_Core_Model_Menu