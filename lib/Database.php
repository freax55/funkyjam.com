<?php
require_once(dirname(__FILE__) . '/colkey/Colkey.php');

class Database extends AbstractDatabase
{
	var $dbtype = CK_DB_PGSQL;
	var $host = 'localhost';
	var $port = 5432;
	var $dbname = 'fj_db';
	var $user = 'funkyjam';
	var $password = 'Wi2Mi9gm';
	
	var $mode = CK_MODE_NORMAL;

	function encrypt($input) {
		if ($input) {
			$key = 'FunkyjamEncryptKey';

			$td = mcrypt_module_open(MCRYPT_TripleDES, "", MCRYPT_MODE_ECB, "");
			$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
			mcrypt_generic_init($td, $key, $iv);
			$encrypted_data = mcrypt_generic($td, $input);
			mcrypt_generic_end ($td);
			
			$encrypted_data = urlencode($encrypted_data);

			return $encrypted_data;
		}
		else {
			return '';
		}
	}
}
?>