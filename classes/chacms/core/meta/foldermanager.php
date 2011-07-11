<?php
/**
 * Declares ChaCMS_Core_Meta_FolderManager
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/meta/foldermanager.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Meta_FolderManager
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/meta/foldermanager.php
 */
abstract class ChaCMS_Core_Meta_FolderManager
{
  protected $_folders      = array();
  protected $_folder_codes = array();


  /**
   * Creates this instance
   *
   * @return null
   */
  public function __construct()
  {

  }


  /**
   * Returns internal container
   *
   * @return array() all loaded folders
   */
  public function all()
  {
    return $this->_folders;
  }


  /**
   * Deletes all folders in database
   *
   * @return null
   */
  public function delete_all()
  {
    $this->register_all();

    foreach ($this->all() as $folder)
    {
      $folder->delete();
    }

    $this->unregister_all();
  }


  /**
   * Finds a folder instance by code or ID
   *
   * First looks for a registered instance, then tries to load it from database
   *
   * @param int|string $folder Code or ID of the folder to find
   *
   * @return Model_ChaCMS_Folder|NULL
   *
   * @throws ChaCMS_Exception Can't get folder: parameter should be an ID or a code.
   */
  public function get($folder)
  {
    if ($this->is_registered($folder))
    {
      switch (TRUE) {
        case (is_int($folder)):
          return $this->_folders[ (string) $folder];

        case (is_string($folder)):
          return $this->get($this->_folder_codes[$folder]);

        default :
          throw new ChaCMS_Exception('Can\'t get folder: parameter should be a code or an code.');
      }
    }

    return $this->load($folder);
  }


  /**
   * Checks if a folder instance is registered by the manager
   *
   * @param int|string $folder Code or ID of the folder to check
   *
   * @return bool
   */
  public function is_registered($folder)
  {
    switch (TRUE) {
      case (is_int($folder)):
        return isset($this->_folders[ (string) $folder]);

      case (is_string($folder)):
        return isset($this->_folders[$this->_folder_codes[$folder]]);

      default :
        return FALSE;
    }
  }


  /**
   * Load a folder from database by its code or ID
   *
   * @param int|string $folder Folder code or ID to load
   * @param bool       $force  Impose reload if Folder already in internal container
   *
   * @return Model_ChaCMS_Folder|NULL model if loaded
   */
  public function load($folder, $force = FALSE)
  {
    switch (TRUE)
    {
      case (is_int($folder)):
        return $this->_load_by_id($folder, $force);

      case (is_string($folder)):
        return $this->_load_by_code($folder, $force);

      default :
        return NULL;
    }
  }


  /**
   * Load a folder from database by its code
   *
   * @param string $folder_code Folder code to load in internal container
   * @param bool   $force       Impose reload if Folder already in internal container
   *
   * @return Model_ChaCMS_Folder|NULL model if loaded
   */
  public function load_by_code($folder_code, $force = FALSE)
  {
    if ( ! isset($this->_folder_codes[$folder_code])
         or $force)
    {
      $folder = $this->container
                        ->get('jelly.request')
                        ->query('chacms.model.folder')
                        ->where('code', '=', $folder_code)
                        ->limit(1)
                        ->select();

      if ( ! $folder->loaded())
      {
        return NULL;
      }

      $this->register($folder);
    }

    return $this->_folder_codes[$folder_code];
  }


  /**
   * Load a folder from database by its id
   *
   * @param int  $folder_id Folder ID to load in internal container
   * @param bool $force     Impose reload if Folder already in internal container
   *
   * @return Model_ChaCMS_Folder|NULL model if loaded
   */
  public function load_by_id($folder_id, $force = FALSE)
  {
    if ( ! isset($this->_folders[ (string) $folder_id])
        or $force)
    {
      $folder = $this->container
                        ->get('chacms.model.folder', $folder_id);

      if ( ! $folder->loaded())
      {
        return NULL;
      }

      $this->register($folder);
    }

    return $this->_folders[ (string) $folder_id];
  }


  /**
   * Registers a folder in the internal container
   *
   * @param Model_ChaCMS_Folder $folder Folder instance to register in internal container
   *
   * @return null
   */
  public function register(Model_ChaCMS_Folder $folder)
  {
    $this->_folders[ (string) $folder->id] = $folder;
    $this->_folder_codes[$folder->code]    = $folder->id;
  }


  /**
   * Registers all folders from database in internal container
   *
   * @return null
   */
  public function register_all()
  {
    $this->unregister_all();

    $all_folders = $this->container
                        ->get('jelly.request')
                        ->query('chacms.model.folder')
                        ->select();

    foreach ($all_folders as $folder)
    {
      $this->register($folder);
    }
  }


  /**
   * Unregisters all folders in internal container
   *
   * @return null
   */
  public function unregister_all()
  {
    $this->_folders      = array();
    $this->_folder_codes = array();
  }

} // End class ChaCMS_Core_Meta_FolderManager