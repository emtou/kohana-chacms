<?php
/**
 * Declares ChaCMS_Core_Model_MenuItem model
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/menuitem.php
 * @since     2011-06-20
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Model_MenuItem model
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/menuitem.php
 */
class ChaCMS_Core_Model_MenuItem extends ChaCMS_Base_Model_Jelly implements ChaCMS_Interface_MonoLinker
{

  /**
   * Fields declaration
   *
   * @param Jelly_Meta $meta Access to Jelly framework
   *
   * @return null
   *
   * @todo create validation rule for positive integer in order field
   */
  public static function initialize(Jelly_Meta $meta)
  {
    $meta->table(ChaCMS::db_table_prefix().'menuitems')
         ->fields(
             array(
              'id' =>    new Jelly_Field_Primary,
              'menu' =>  new Jelly_Field_BelongsTo(array(
                            'column' => 'menu_id',
                            'foreign' => 'ChaCMS_Menu.id',
                            'rules' => array(
                                array('not_empty'),
                            ),
                          )),
              'order' =>  new Jelly_Field_Integer (array(
                            'default' => 1,
                            'label' => 'Order inside the menu',
                            'name' => 'Order inside the menu',
                            'rules' => array(
                                array('not_empty'),
                            ),
                          )),
              'code' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                                array('UTF8::strtolower'),
                            ),
                            'label' => 'Item code',
                            'name' => 'Item code',
                            'rules' => array(
                                array('max_length', array(':value', 64)),
                                array('mb_check_encoding', array(':value', 'UTF-8')),
                            ),
                          )),
              'label' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                            ),
                            'label' => 'Item label',
                            'name' => 'Item label',
                            'rules' => array(
                                array('max_length', array(':value', 128)),
                                array('mb_check_encoding', array(':value', 'UTF-8')),
                                array('not_empty'),
                            ),
                          )),
              'published' => new Jelly_Field_Boolean(array(
                            'label' => 'Is the item published ?',
                            'name' => 'Is the item published ?',
                          )),
             )
         );
  }

} // End class ChaCMS_Core_Model_MenuItem