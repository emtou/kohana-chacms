<?php
/**
 * Declares ChaCMS_Core_Model_Domain model
 *
 * PHP version 5
 *
 * @group ChaCMS
 *
 * @category  ChaCMS
 * @package   ChaCMS.Domain
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/domain.php
 * @since     2011-06-20
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Model_Domain model
 *
 * PHP version 5
 *
 * @group ChaCMS
 *
 * @category  ChaCMS
 * @package   ChaCMS.Domain
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/domain.php
 */
class ChaCMS_Core_Model_Domain extends ChaCMS_Base_Model_Jelly
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
    $meta->table(ChaCMS::db_table_prefix().'domains')
         ->fields(
             array(
              'id' =>    new Jelly_Field_Primary,
              'code' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                                array('UTF8::strtolower'),
                            ),
                            'label' => 'Domain code',
                            'name' => 'Domain code',
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
                            'label' => 'Domain name',
                            'name' => 'Domain name',
                            'rules' => array(
                                array('max_length', array(':value', 128)),
                                array('mb_check_encoding', array(':value', 'UTF-8')),
                                array('not_empty'),
                            ),
                          )),
              'rootfolder' =>  new Jelly_Field_BelongsTo(array(
                            'column'  => 'rootfolder_id',
                            'foreign' => 'ChaCMS_Folder.id',
                            'label'   => 'Root folder',
                            'name'    => 'Root folder',
                          )),
             )
         );
  }

} // End class ChaCMS_Core_Model_Domain