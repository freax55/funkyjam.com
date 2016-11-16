<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */

/**
 * Smarty premium docomo outputfilter plugin
 *
 * File:     outputfilter.premium_docomo.php<br>
 * Type:     outputfilter<br>
 * Name:     premium_docomo<br>
 * Install:  Drop into the plugin directory, call
 *           <code>$smarty->load_filter('output','premium_mobile');</code>
 *           from application.
 * @author   Deguchi Tatsuya
 * @param string
 * @param Smarty
 */
function smarty_outputfilter_premium_docomo($source, &$smarty) {
	mb_regex_encoding('EUC-JP');

	// premium配下のリンクへ、UID取得用のパラメーターを付加
	$source = mb_ereg_replace('href="([^"?]+)\?([^"#]+)"', 'href="\1?\2&uid=NULLGWDOCOMO"', $source);
	$source = mb_ereg_replace('href="([^"?#]+)"', 'href="\1?uid=NULLGWDOCOMO"', $source);
	
	return $source;
}

?>