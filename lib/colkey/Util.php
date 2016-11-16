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
	 * �ե����ޥåȺѤ����դ��������
	 *
	 * @param stamp ����
	 * @param delimiter ���ڤ�ʸ��
	 * @retunr �ե����ޥåȺѤ�����
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
			$format = '%04dǯ%02d��%02d��';
		}

		$formated_stamp = sprintf($format,
			$date['year'],
			$date['mon'],
			$date['mday']
		);
		
		return $formated_stamp;
	}

	/**
	 * �ꥹ�Ȥ˥ե����ޥåȺѤ����դ��ɲä���
	 *
	 * @param list �ꥹ��
	 * @param stamp_field_name ���դΥե������̾
	 * @param formated_field_name �ե����ޥåȺѤ����դΥե������̾
	 * @param delimiter ���ڤ�ʸ��
	 */
	function addFormatedDate(&$list, $stamp_field_name, $formated_field_name, $delimiter='') {
		if (is_array($list)) {
			foreach ($list as $no => $obj) {
				$list[$no][$formated_field_name] = get_formated_date($obj[$stamp_field_name], $delimiter);
			}
		}
	}

	/**
	 * �ե����ޥåȺѤ��������������
	 *
	 * @param stamp ����
	 * @param delimiter ���ڤ�ʸ��
	 * @retunr �ե����ޥåȺѤ�����
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
			$format = '%04dǯ%02d��%02d�� %02d:%02d';
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
	 * �ꥹ�Ȥ˥ե����ޥåȺѤ��������ɲä���
	 *
	 * @param list �ꥹ��
	 * @param stamp_field_name �����Υե������̾
	 * @param formated_field_name �ե����ޥåȺѤ������Υե������̾
	 */
	function addFormatedStamp(&$list, $stamp_field_name, $formated_field_name, $delimiter='') {
		if (is_array($list)) {
			foreach ($list as $no => $obj) {
				$list[$no][$formated_field_name] = get_formated_stamp($obj[$stamp_field_name], $delimiter);
			}
		}
	}

	/**
	 * �Ź沽����
	 *
	 * @param input ����ʸ����
	 * @retunr �Ź沽�Ѥ�ʸ����
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
	 * �ꥹ�Ȥλ��ꤵ�줿�ե�����ɤ�Ź沽����
	 *
	 * @param list �ꥹ��
	 * @param field_name �Ź沽����ե������̾
	 * @param encrypted_field_name �Ź沽�Ѥߥǡ������Ǽ����ե������̾
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
	 * ���沽����
	 *
	 * @param input ����ʸ����
	 * @retunr ���沽�Ѥ�ʸ����
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
	 * �ꥹ�Ȥλ��ꤵ�줿�ե�����ɤ����沽����
	 *
	 * @param list �ꥹ��
	 * @param field_name ���沽����ե������̾
	 * @param decrypted_field_name ���沽�Ѥߥǡ������Ǽ����ե������̾
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