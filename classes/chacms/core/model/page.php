<?php
/**
 * Declares ChaCMS_Core_Model_Page model
 *
 * PHP version 5
 *
 * @group ChaCMS
 *
 * @category  ChaCMS
 * @package   ChaCMS.Page
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/page.php
 * @since     2011-06-20
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Model_Page model
 *
 * PHP version 5
 *
 * @group ChaCMS
 *
 * @category  ChaCMS
 * @package   ChaCMS.Page
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/page.php
 */
class ChaCMS_Core_Model_Page extends ChaCMS_Base_Model_Jelly
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
    $meta->table(ChaCMS::db_table_prefix().'pages')
         ->fields(
             array(
              'id' =>    new Jelly_Field_Primary,
              'code' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                                array('UTF8::strtolower'),
                            ),
                            'label' => 'Page code',
                            'name' => 'Page code',
                            'rules' => array(
                                array('max_length', array(':value', 64)),
                                array('mb_check_encoding', array(':value', 'UTF-8')),
                            ),
                            'unique' => TRUE,
                          )),
              'domain' =>  new Jelly_Field_BelongsTo(array(
                            'foreign' => 'ChaCMS_Domain.id',
                            'label' => 'Domain this page is hosted on',
                            'name' => 'Domain this page is hosted on',
                          )),
              'uri' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                            ),
                            'label' => 'Page URI',
                            'name' => 'Page URI',
                            'rules' => array(
                                array('max_length', array(':value', 256)),
                                array('mb_check_encoding', array(':value', 'UTF-8')),
                            ),
                          )),
              'title' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                            ),
                            'label' => 'Page title',
                            'name' => 'Page title',
                            'rules' => array(
                                array('max_length', array(':value', 256)),
                                array('mb_check_encoding', array(':value', 'UTF-8')),
                            ),
                          )),
              'description' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                            ),
                            'label' => 'Page meta description',
                            'name' => 'Page meta description',
                            'rules' => array(
                                array('max_length', array(':value', 1024)),
                                array('mb_check_encoding', array(':value', 'UTF-8')),
                            ),
                          )),
              'keywords' =>  new Jelly_Field_String(array(
                            'filters' => array(
                                array('trim'),
                            ),
                            'label' => 'Page meta keywords',
                            'name' => 'Page meta keywords',
                            'rules' => array(
                                array('max_length', array(':value', 1024)),
                                array('mb_check_encoding', array(':value', 'UTF-8')),
                            ),
                          )),
             )
         );
  }

} // End class ChaCMS_Core_Model_Page