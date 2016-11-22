<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */

/**
 * Smarty utf82euc postfilter plugin
 *
 * File:     postfilter.utf82euc.php<br>
 * Type:     postfilter<br>
 * Name:     utf82euc<br>
 * Install:  Drop into the plugin directory, call
 *           <code>$smarty->load_filter('post','utf82euc');</code>
 *           from application.
 * @author   Kawamoto Koo
 * @param string
 * @param Smarty
 */
function smarty_postfilter_utf82euc($source, &$smarty) {
	return mb_convert_encoding($buff, 'EUC-JP', 'UTF-8');
}

?>