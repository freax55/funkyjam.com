<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage project_plugins
 */

/**
 * Smarty decrypt modifier plugin
 *
 * Type:     modifier<br>
 * Name:     decrypt<br>
 * @param string
 * @return string
 */
function smarty_modifier_decrypt($input) {
	if ($input) {
		$input = urldecode($input);
	
		$key = 'IkejiriSeiyakuEncryptKey';
		
		$td = mcrypt_module_open(MCRYPT_TripleDES, "", MCRYPT_MODE_ECB, "");
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		$decrypted_data = mdecrypt_generic($td, $input);
		mcrypt_generic_end ($td);
		
		$decrypted_data = trim($decrypted_data);
		
		return $decrypted_data;
	}
	else {
		return '';
	}
}

/* vim: set expandtab: */
?>