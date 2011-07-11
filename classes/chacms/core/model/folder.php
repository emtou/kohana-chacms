<?php
/**
 * Declares ChaCMS_Core_Model_Folder model
 *
 * PHP version 5
 *
 * @group ChaCMS
 *
 * @category  ChaCMS
 * @package   ChaCMS.Folder
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/folder.php
 * @since     2011-06-20
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Model_Folder model
 *
 * PHP version 5
 *
 * @group ChaCMS
 *
 * @category  ChaCMS
 * @package   ChaCMS.Folder
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/folder.php
 */
class ChaCMS_Core_Model_Folder extends ChaCMS_Base_Model_Jelly
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
    $meta->table(ChaCMS::db_table_prefix().'folders')
         ->fields(
             array(
              'id' =>    new Jelly_Field_Primary,
              'code' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                                array('UTF8::strtolower'),
                            ),
                            'label' => 'Folder code',
                            'name' => 'Folder code',
                            'rules' => array(
                                array('max_length', array(':value', 64)),
                                array('mb_check_encoding', array(':value', 'UTF-8')),
                            ),
                            'unique' => TRUE,
                          )),
              'name' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                            ),
                            'label' => 'Folder name',
                            'name' => 'Folder name',
                            'rules' => array(
                                array('max_length', array(':value', 128)),
                                array('mb_check_encoding', array(':value', 'UTF-8')),
                            ),
                          )),
              'domain' =>  new Jelly_Field_BelongsTo(array(
                            'column'  => 'domain_id',
                            'foreign' => 'ChaCMS_Domain.id',
                            'label'   => 'Domain attached',
                            'name'    => 'Domain attached',
                          )),
              'parent' =>  new Jelly_Field_BelongsTo(array(
                            'column'  => 'parent_id',
                            'foreign' => 'ChaCMS_Folder.id',
                            'label'   => 'Parent item',
                            'name'    => 'Parent item',
                          )),
              'children' =>  new Jelly_Field_HasMany(array(
                            'foreign' => 'ChaCMS_Folder.parent_id',
                            'label'   => 'Children items',
                            'name'    => 'Children items',
                          )),
             )
         );
  }


  /**
   * Deletes this folder and all its children
   *
   * @return  boolean
   */
  public function delete()
  {
    $db = Database::instance($this->meta()->db());

    $db->begin();

    try
    {
      foreach ($this->children as $item)
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

} // End class ChaCMS_Core_Model_Folder