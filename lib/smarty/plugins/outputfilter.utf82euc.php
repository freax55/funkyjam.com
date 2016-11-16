<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */

/**
 * Smarty euc2utf8 outputfilter plugin
 *
 * File:     outputfilter.utf82euc.php<br>
 * Type:     outputfilter<br>
 * Name:     utf82euc<br>
 * Install:  Drop into the plugin directory, call
 *           <code>$smarty->load_filter('output','utf82euc');</code>
 *           from application.
 * @author   Kawamoto Koo
 * @param string
 * @param Smarty
 */
function smarty_outputfilter_utf82euc($source, &$smarty) {
        return mb_convert_encoding($source, 'EUC-JP', 'UTF-8');
}

?>
