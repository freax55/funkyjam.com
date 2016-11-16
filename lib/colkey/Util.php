<?php
/**
 * Project:     Colkey: column of key generate association array.
 * File:        Util.php
 *
 * @link http://www.evol-ni.com/
 * @copyright 2005 evol-ni Co.,Ltd.
 * @author Kawamoto Koo <kwmt@evol-ni.com>
 * @package Colkey
 * @version 0.1
 */

class Util
{
	/**
	 * フォーマット済み日付を取得する
	 *
	 * @param stamp 日付
	 * @param delimiter 区切り文字
	 * @retunr フォーマット済み日付
	 */
	function getFormatedDate($stamp, $delimiter='') {
		if (!$stamp) {
			return NULL;
		}
	
		$stamp = ereg_replace("\.[0-9]+", "", $stamp);
		$date = getdate(strtotime($stamp));
		
		if ($delimiter == '.') {
			$format = '%04d.%02d.%02d';
		}
		else if ($delimiter == '-') {
			$format = '%04d-%02d-%02d';
		}
		else if ($delimiter == '/') {
			$format = '%04d/%02d/%02d';
		}
		else {
			$format = '%04d年%02d月%02d日';
		}

		$formated_stamp = sprintf($format,
			$date['year'],
			$date['mon'],
			$date['mday']
		);
		
		return $formated_stamp;
	}

	/**
	 * リストにフォーマット済み日付を追加する
	 *
	 * @param list リスト
	 * @param stamp_field_name 日付のフィールド名
	 * @param formated_field_name フォーマット済み日付のフィールド名
	 * @param delimiter 区切り文字
	 */
	function addFormatedDate(&$list, $stamp_field_name, $formated_field_name, $delimiter='') {
		if (is_array($list)) {
			foreach ($list as $no => $obj) {
				$list[$no][$formated_field_name] = get_formated_date($obj[$stamp_field_name], $delimiter);
			}
		}
	}

	/**
	 * フォーマット済み日時を取得する
	 *
	 * @param stamp 日時
	 * @param delimiter 区切り文字
	 * @retunr フォーマット済み日時
	 */
	function getFormatedStamp($stamp, $delimiter='') {
		if (!$stamp) {
			return NULL;
		}
	
		$stamp = ereg_replace("\.[0-9]+", "", $stamp);
		$date = getdate(strtotime($stamp));
		
		if ($delimiter == '.') {
			$format = '%04d.%02d.%02d %02d:%02d';
		}
		else if ($delimiter == '-') {
			$format = '%04d-%02d-%02d %02d:%02d';
		}
		else if ($delimiter == '/') {
			$format = '%04d/%02d/%02d %02d:%02d';
		}
		else {
			$format = '%04d年%02d月%02d日 %02d:%02d';
		}

		$formated_stamp = sprintf($format,
			$date['year'],
			$date['mon'],
			$date['mday'],
			$date['hours'],
			$date['minutes']
		);
		
		return $formated_stamp;
	}

	/**
	 * リストにフォーマット済み日時を追加する
	 *
	 * @param list リスト
	 * @param stamp_field_name 日時のフィールド名
	 * @param formated_field_name フォーマット済み日時のフィールド名
	 */
	function addFormatedStamp(&$list, $stamp_field_name, $formated_field_name, $delimiter='') {
		if (is_array($list)) {
			foreach ($list as $no => $obj) {
				$list[$no][$formated_field_name] = get_formated_stamp($obj[$stamp_field_name], $delimiter);
			}
		}
	}

	/**
	 * 暗号化する
	 *
	 * @param input 入力文字列
	 * @retunr 暗号化済み文字列
	 */
	function encrypt($input) {
		if ($input) {
			$key = 'IkejiriSeiyakuEncryptKey';

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

	/**
	 * リストの指定されたフィールドを暗号化する
	 *
	 * @param list リスト
	 * @param field_name 暗号化するフィールド名
	 * @param encrypted_field_name 暗号化済みデータを格納するフィールド名
	 */
	function encryptList(&$list, $field_name) {
		$args = func_get_args();
		$encrypted_field_name = $args[2];

		if (is_array($list)) {
			foreach ($list as $no => $obj) {
				if ($encrypted_field_name) {
					$list[$no][$encrypted_field_name] = encrypt($obj[$field_name]);
				}
				else {
					$list[$no][$field_name] = encrypt($obj[$field_name]);
				}
			}
		}
	}
	
	/**
	 * 復号化する
	 *
	 * @param input 入力文字列
	 * @retunr 復号化済み文字列
	 */
	function decrypt($input) {
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

	/**
	 * リストの指定されたフィールドを復号化する
	 *
	 * @param list リスト
	 * @param field_name 復号化するフィールド名
	 * @param decrypted_field_name 復号化済みデータを格納するフィールド名
	 */
	function decryptList(&$list, $field_name) {
		$args = func_get_args();
		$decrypted_field_name = $args[2];

		if (is_array($list)) {
			foreach ($list as $no => $obj) {
				if ($decrypted_field_name) {
					$list[$no][$decrypted_field_name] = decrypt($obj[$field_name]);
				}
				else {
					$list[$no][$field_name] = decrypt($obj[$field_name]);
				}
			}
		}
	}
}
?>