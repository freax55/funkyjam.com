<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */

/**
 * Smarty pg_date_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     pg_date_format<br>
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_pg_date_format($string, $format = '%b %e, %Y') {
	if (!$string) {
		return null;
	}

	if (false !== strrpos($string, '.')) {
		$string = substr($string, 0, strrpos($string, '.'));
	}
	if (false !== strrpos($string, '+')) {
		$string = substr($string, 0, strrpos($string, '+'));
	}

	$string = strftime($format, strtotime($string));

	$weekList = array('Sun'=>'��', 'Mon'=>'��', 'Tue'=>'��', 'Wed'=>'��', 'Thu'=>'��', 'Fri'=>'��', 'Sat'=>'��');
	foreach ($weekList as $en => $jp) {
		$string = str_replace($en, $jp, $string);
	}
	return $string;
}

/* vim: set expandtab: */

?>