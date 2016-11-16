<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */

/**
 * Smarty euc2euc outputfilter plugin
 *
 * File:     outputfilter.euc2euc.php<br>
 * Type:     outputfilter<br>
 * Name:     euc2euc<br>
 * Install:  Drop into the plugin directory, call
 *           <code>$smarty->load_filter('output','euc2euc');</code>
 *           from application.
 * @author   Kawamoto Koo
 * @param string
 * @param Smarty
 */
function smarty_outputfilter_euc2euc($source, &$smarty) {
	return mb_convert_encoding($source, 'EUC-JP', 'EUC-JP');
}

?>
