<?php
/**
 * Project:     Colkey: column of key generate association array.
 * File:        Colkey.php
 *
 * @link http://www.evol-ni.com/
 * @copyright 2005 evol-ni Co.,Ltd.
 * @author Kawamoto Koo <kwmt@evol-ni.com>
 * @package Colkey
 * @version 0.1
 */

function debug($name, $value = null) {
	print("<pre>");
	if ($value) {
		print("'$name' : '$value'\n");
	}
	else {
		if (is_array($name) || is_object($name)) {
			print_r($name);
		}
		else {
			var_dump($name);
		}
	}
	print("</pre>");
}

define('COLKEY_DIR', dirname(__FILE__) . '/');

//Mode
define('CK_MODE_NORMAL', 'normal');
define('CK_MODE_SAFE', 'safe');
define('CK_MODE_DEBUG', 'debug');
define('CK_MODE_DUMP', 'dump');
//Database Type
define('CK_DB_PGSQL', 'pgsql');
define('CK_DB_MYSQL', 'mysql');	
//Reccord Key
define('CK_KEY_TYPE', 'type');
define('CK_KEY_NAME', 'name');
define('CK_KEY_VALUE', 'value');
//Column Type
define('CK_TYPE_ANY', 0);
define('CK_TYPE_INT', 1);
define('CK_TYPE_STRING', 2);
define('CK_TYPE_DATE', 3);

require_once(COLKEY_DIR . 'AbstractDatabase.php');
require_once(COLKEY_DIR . 'DatabaseWrapper.php');
require_once(COLKEY_DIR . 'Record.php');
require_once(COLKEY_DIR . 'Statement.php');
//require_once(COLKEY_DIR . 'Util.php');
?>