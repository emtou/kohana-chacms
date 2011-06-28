<?php
/**
 * Declares default view for ChaCMS menus
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/chacms/views/chacms/menu/default.php
 * @since     2011-06-20
 */

defined('SYSPATH') OR die('No direct access allowed.');

echo '<ul>';

foreach ($menu->items as $item)
{
  echo '<li>';
  echo $item->label;
  echo '</li>';
}
echo '</ul>';