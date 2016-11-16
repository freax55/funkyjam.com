<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */

/**
 * Smarty sjis2euc prefilter plugin
 *
 * File:     prefilter.sjis2euc.php<br>
 * Type:     prefilter<br>
 * Name:     sjis2euc<br>
 * Install:  Drop into the plugin directory, call
 *           <code>$smarty->load_filter('pre','sjis2euc');</code>
 *           from application.
 * @author   Kawamoto Koo
 * @param string
 * @param Smarty
 */
function smarty_prefilter_sjis2euc($source, &$smarty) {
	return mb_convert_encoding($source, 'EUC-JP', 'SJIS');
}

?>