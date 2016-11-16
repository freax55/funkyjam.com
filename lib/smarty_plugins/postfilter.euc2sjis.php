<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */

/**
 * Smarty euc2sjis postfilter plugin
 *
 * File:     postfilter.euc2sjis.php<br>
 * Type:     postfilter<br>
 * Name:     sjis2euc<br>
 * Install:  Drop into the plugin directory, call
 *           <code>$smarty->load_filter('post','euc2sjis');</code>
 *           from application.
 * @author   Kawamoto Koo
 * @param string
 * @param Smarty
 */
function smarty_postfilter_euc2sjis($source, &$smarty) {
	return mb_convert_encoding($buff, 'SJIS', 'EUC-JP');
}

?>