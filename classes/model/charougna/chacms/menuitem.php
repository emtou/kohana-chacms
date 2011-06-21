<?php
/**
 * Declares Charougna_ChaCMS_MenuItem model
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/model/charougna/chacms/menuitem.php
 * @since     2011-06-20
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides Charougna_ChaCMS_MenuItem model
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/model/charougna/chacms/menuitem.php
 */
class Model_Charougna_ChaCMS_MenuItem extends Sprig
{

  /**
   * Fields declaration
   *
   * @return null
   */
  protected function _init()
  {
    $this->_table = ChaCMS::db_table_prefix().'menuitems';

    $this->_fields += array(
      'id' =>        new Sprig_Field_Auto,
      'menu' =>      new Sprig_Field_BelongsTo(array(
                      'column' => 'menu_id',
                      'empty'  => FALSE,
                      'label'  => 'Menu the item is attached to',
                      'model'  => 'ChaCMS_Menu',
                      'null'   => FALSE,
                     )),
      'order' =>     new Sprig_Field_Integer(array(
                      'default' => 1,
                      'empty'   => FALSE,
                      'label'   => 'Order inside the menu',
                     )),
      'code' =>      new Sprig_Field_Char(array(
                      'empty'  => TRUE,
                      'label' => 'Item code',
                      'max_length' => 64,
                     )),
      'label' =>    new Sprig_Field_Char(array(
                      'label' => "Item label",
                      'max_length' => 128,
                      'empty' => FALSE,
                     )),
      'published' => new Sprig_Field_Boolean(array(
                      'label' => "Is the item published ?",
                     )),
    );
  }

} // End class Model_Charougna_ChaCMS_MenuItem