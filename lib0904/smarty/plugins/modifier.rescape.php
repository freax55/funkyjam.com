<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */

/**
 * Smarty rescape modifier plugin
 *
 * Type:     modifier<br>
 * Name:     rescape<br>
 * @param string
 * @param integer
 * @param string
 * @return string
 */
function smarty_modifier_rescape($string) {
	$string = str_replace("&amp;eacute;", "&eacute;", $string);
	$string = str_replace("&amp;ccedil;", "&ccedil;", $string);
	$string = str_replace("&amp;cent;", "&cent;", $string);
	return $string;
}

/* vim: set expandtab: */

?>