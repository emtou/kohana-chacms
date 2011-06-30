<?php
/**
 * Declares ChaCMS_Core_Model_Jelly
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/jelly.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides ChaCMS_Core_Model_Jelly
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/core/model/jelly.php
 */
abstract class ChaCMS_Core_Model_Jelly extends Jelly_Model
{
  protected $_chacms_model = NULL;


  /**
   * Gets or sets ChaCMS_Model aggregate
   *
   * @param ChaCMS_Model &$chacms_model optional agregate (in set mode)
   *
   * @return ChaCMS_Model|null agregate (in get mode)
   *
   * @see ChaCMS_Core_Interface_Linker::chacms_model()
   *
   * @throws ChaCMS_Exception Can't find ChaCMS_Model aggregate: aggregate hasn\'t been set before use.
   */
  public function chacms_model(ChaCMS_Model & $chacms_model = NULL)
  {
    if ($chacms_model == NULL)
    {
      // get mode
      if ($this->_chacms_model == NULL)
      {
        throw new ChaCMS_Exception(
          'Can\'t find ChaCMS_Model aggregate: aggregate hasn\'t been set before use.'
        );
      }

      return $this->_chacms_model;
    }

    // set mode
    $this->_chacms_model = $chacms_model;
  }

} // End class ChaCMS_Core_Model_Jelly