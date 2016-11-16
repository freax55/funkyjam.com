<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */

/**
 * Smarty euc2sjis outputfilter plugin
 *
 * File:     outputfilter.euc2sjis.php<br>
 * Type:     outputfilter<br>
 * Name:     euc2sjis<br>
 * Install:  Drop into the plugin directory, call
 *           <code>$smarty->load_filter('output','euc2sjis');</code>
 *           from application.
 * @author   Kawamoto Koo
 * @param string
 * @param Smarty
 */
function smarty_outputfilter_euc2sjis($source, &$smarty) {
	$host = '/';
	$script = $_SERVER['SCRIPT_NAME'];
	$prefix = NULL;
	if ($script == '/contact/index.php') {
		$prefix = $host . dirname($script) . '/';
	}
	elseif ($script == '/artist/fanletter/index.php') {
		$prefix = $host . dirname($script) . '/';
	}
	elseif ($script == '/artist/kubota/fanclub/index.php') {
		$prefix = $host . dirname($script) . '/';
	}
	elseif ($script == '/artist/kubota/fanclubtest/index.php') {
		$prefix = $host . dirname($script) . '/';
	}
	elseif ($script == '/shop/index.php') {
		$prefix = $host . dirname($script) . '/';
	}

	if ($prefix) {
		$source = mb_ereg_replace('<a href="../', '<a href="' . $prefix . '../', $source);
		$source = mb_ereg_replace('<a href="/', '<a href="' . $host . '/', $source);
	}

	return mb_convert_encoding($source, 'SJIS', 'EUC-JP');
}

?>