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
class Model_Charougna_ChaCMS_Menu extends Sprig
{

  /**
   * Fields declaration
   *
   * @return null
   */
  protected function _init()
  {
    $this->_table = ChaCMS::db_table_prefix().'menus';

    $this->_fields += array(
      'id'    => new Sprig_Field_Auto,
      'code'  => new Sprig_Field_Char(array(
                  'empty'  => TRUE,
                  'label' => 'Menu code',
                  'max_length' => 64,
                  'unique' => TRUE,
                 )),
      'label' => new Sprig_Field_Char(array(
                  'label' => 'Menu label',
                  'max_length' => 128,
                  'empty' => FALSE,
                 )),
      'items' => new Sprig_Field_HasMany(array(
                  'label'       => 'Items attached to this menu',
                  'model'       => 'ChaCMS_MenuItem',
                  'foreign_key' => 'menu_id',
                 )),
    );
  }

} // End class Model_Charougna_ChaCMS_Menu