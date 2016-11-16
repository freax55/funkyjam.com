<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/google/MobileAnalytics.php');

/**
 * Smarty mobile outputfilter plugin
 *
 * File:     outputfilter.mobile.php<br>
 * Type:     outputfilter<br>
 * Name:     sjis2euc<br>
 * Install:  Drop into the plugin directory, call
 *           <code>$smarty->load_filter('output','mobile');</code>
 *           from application.
 * @author   Kawamoto Koo
 * @param string
 * @param Smarty
 */
function smarty_outputfilter_mobile($source, &$smarty) {
//	$source = mb_convert_kana($source, 'ak');
	
	$googleAnalyticsImageUrl = googleAnalyticsGetImageUrl();
	$tag = sprintf('<img src="%s" width="1" height="1" />', $googleAnalyticsImageUrl);

//	mb_internal_encoding('SJIS');
	mb_regex_encoding('EUC-JP');
	$source = mb_ereg_replace('(<body[^>]*>\n)', ("\\1" . $tag), $source);
	return $source;
}

?>