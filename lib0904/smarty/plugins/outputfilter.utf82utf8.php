<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */

/**
 * Smarty utf82utf8 outputfilter plugin
 *
 * File:     outputfilter.utf82utf8.php<br>
 * Type:     outputfilter<br>
 * Name:     utf82utf8<br>
 * Install:  Drop into the plugin directory, call
 *           <code>$smarty->load_filter('output','utf82utf8');</code>
 *           from application.
 * @author   Kawamoto Koo
 * @param string
 * @param Smarty
 */
function smarty_outputfilter_utf82utf8($source, &$smarty) {
	return mb_convert_encoding($source, 'UTF-8', 'UTF-8');
}

?>
