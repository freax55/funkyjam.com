<?php
/**
 * PAYGENT B2B MODULE
 * PaygentB2BModuleResources.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

/*
 * �ץ�ѥƥ��ե������ɹ������ݻ����饹
 * 
 * @version $Revision: 1.7 $
 * @author $Author: yoseeme $
 */

include_once("jp/co/ks/merchanttool/connectmodule/util/StringUtil.php");
include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleConnectException.php");
include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleException.php");

	/**
	 * �ץ�ѥƥ��ե�����̾
	 */
	define("PaygentB2BModuleResources__PROPERTIES_FILE_NAME", "modenv_properties.php");

	/**
	 * �Ȳ����ʸ���̤ζ��ڤ�ʸ��
	 */
	define("PaygentB2BModuleResources__TELEGRAM_KIND_SEPARATOR", ",");
	
	/**
	 * ��ʸ���̤���Ƭ�������³��URL������
	 */
	define("PaygentB2BModuleResources__TELEGRAM_KIND_FIRST_CHARS", 2);

	/**
	 * ���饤����Ⱦ�����ե�����ѥ�
	 */
	define("PaygentB2BModuleResources__CLIENT_FILE_PATH", "paygentB2Bmodule.client_file_path");

	/**
	 * CA������ե�����ѥ�
	 */
	define("PaygentB2BModuleResources__CA_FILE_PATH", "paygentB2Bmodule.ca_file_path");

	/**
	 * Proxy������̾
	 */
	define("PaygentB2BModuleResources__PROXY_SERVER_NAME", "paygentB2Bmodule.proxy_server_name");

	/**
	 * ProxyIP���ɥ쥹
	 */
	define("PaygentB2BModuleResources__PROXY_SERVER_IP", "paygentB2Bmodule.proxy_server_ip");

	/**
	 * Proxy�ݡ����ֹ�
	 */
	define("PaygentB2BModuleResources__PROXY_SERVER_PORT", "paygentB2Bmodule.proxy_server_port");

	/**
	 * �ǥե����ID
	 */
	define("PaygentB2BModuleResources__DEFAULT_ID", "paygentB2Bmodule.default_id");

	/**
	 * �ǥե���ȥѥ����
	 */
	define("PaygentB2BModuleResources__DEFAULT_PASSWORD", "paygentB2Bmodule.default_password");

	/**
	 * �����ॢ������
	 */
	define("PaygentB2BModuleResources__TIMEOUT_VALUE", "paygentB2Bmodule.timeout_value");

	/**
	 * ��������
	 */
	define("PaygentB2BModuleResources__LOG_OUTPUT_PATH", "paygentB2Bmodule.log_output_path");

	/**
	 * �Ȳ�MAX���
	 */
	define("PaygentB2BModuleResources__SELECT_MAX_CNT", "paygentB2Bmodule.select_max_cnt");

	/**
	 * �Ȳ����ʸ����ID
	 */
	define("PaygentB2BModuleResources__TELEGRAM_KIND_REFS", "paygentB2Bmodule.telegram_kind.ref");

	/**
	 * ��³��URL�ʶ��̡�
	 */
	define("PaygentB2BModuleResources__URL_COMM", "paygentB2Bmodule.url.");


 class PaygentB2BModuleResources {
 	
	/** ���饤����Ⱦ�����ե�����ѥ� */
	var $clientFilePath = "";

	/** CA������ե�����ѥ� */
	var $caFilePath = "";

	/** Proxy������̾ */
	var $proxyServerName = "";

	/** ProxyIP���ɥ쥹 */
	var $proxyServerIp = "";

	/** Proxy�ݡ����ֹ� */
	var $proxyServerPort = 0;

	/** �ǥե����ID */
	var $defaultId = "";

	/** �ǥե���ȥѥ���� */
	var $defaultPassword = "";

	/** �����ॢ������ */
	var $timeout = 0;

	/** �������� */
	var $logOutputPath = "";

	/** �Ȳ�MAX��� */
	var $selectMaxCnt = 0;
	
	/** ����ե�����ʥץ�ѥƥ��� */
	var $propConnect = null;

	/** �Ȳ����ʸ���̥ꥹ�� */
	var $telegramKindRefs = null;

	/**
	 * ���󥹥ȥ饯��
	 */
	function PaygentB2BModuleResources() {
	}

	/**
	 * PaygentB2BModuleResources �����
	 * 
	 * @return PaygentB2BModuleResources�����Ԥξ�硢���顼������
	 */
	function &getInstance() {
		static $resourceInstance = null;
		
		if (isset($resourceInstance) == false 
			|| $resourceInstance == null
			|| is_object($resourceInstance) != true) {
			
			$resourceInstance = new PaygentB2BModuleResources();
			$rslt = $resourceInstance->readProperties();
			if ($rslt === true) {
			} else {
				$resourceInstance = $rslt;
			} 
		}

		return $resourceInstance;
	}

	/**
	 * ���饤����Ⱦ�����ե�����ѥ��������
	 * 
	 * @return clientFilePath
	 */
	function getClientFilePath() {
		return $this->clientFilePath;
	}

	/**
	 * CA������ե�����ѥ��������
	 * 
	 * @return caFilePath
	 */
	function getCaFilePath() {
		return $this->caFilePath;
	}

	/**
	 * Proxy������̾�������
	 * 
	 * @return proxyServerName
	 */
	function getProxyServerName() {
		return $this->proxyServerName;
	}

	/**
	 * ProxyIP���ɥ쥹�������
	 * 
	 * @return proxyServerIp
	 */
	function getProxyServerIp() {
		return $this->proxyServerIp;
	}

	/**
	 * Proxy�ݡ����ֹ�������
	 * 
	 * @return proxyServerPort
	 */
	function getProxyServerPort() {
		return $this->proxyServerPort;
	}

	/**
	 * �ǥե����ID�������
	 * 
	 * @return defaultId
	 */
	function getDefaultId() {
		return $this->defaultId;
	}

	/**
	 * �ǥե���ȥѥ���ɤ������
	 * 
	 * @return defaultPassword
	 */
	function getDefaultPassword() {
		return $this->defaultPassword;
	}

	/**
	 * �����ॢ�����ͤ������
	 * 
	 * @return timeout
	 */
	function getTimeout() {
		return $this->timeout;
	}

	/**
	 * ��������������
	 * 
	 * @return logOutputPath
	 */
	function getLogOutputPath() {
		return $this->logOutputPath;
	}

	/**
	 * �Ȳ�MAX����������
	 * 
	 * @return selectMaxCnt
	 */
	function getSelectMaxCnt() {
		return $this->selectMaxCnt;
	}

	/**
	 * ��³��URL�������
	 * 
	 * @param telegramKind
	 * @return FALSE: ����(PaygentB2BModuleConnectException::TEREGRAM_PARAM_OUTSIDE_ERROR)������:�������� URL
	 */
	function getUrl($telegramKind) {
		$rs = null;
		$sKey = null;

		// �ץ�ѥƥ������å�
		if ($this->propConnect == null) {
			trigger_error(PaygentB2BModuleConnectException__TEREGRAM_PARAM_OUTSIDE_ERROR 
				. ": HTTP request contains unexpected value.", E_USER_WARNING);
			return false;
		}
		
		// ���������å�
		if (StringUtil::isEmpty($telegramKind)) {
			trigger_error(PaygentB2BModuleConnectException__TEREGRAM_PARAM_OUTSIDE_ERROR 
				. ": HTTP request contains unexpected value.", E_USER_WARNING);
			return false;
		}

		// ������ǥץ�ѥƥ�����URL�����
		$sKey = PaygentB2BModuleResources__URL_COMM . $telegramKind;
		if (array_key_exists($sKey, $this->propConnect)) {
			$rs = $this->propConnect[$sKey];
		}
		
		// ������Ǽ����Ǥ�����硢�����ͤ��᤹
		if (!StringUtil::isEmpty($rs)) {
			return $rs;
		}
		
		// ��Ƭ����ǥץ�ѥƥ�����URL�����
		if (strlen($telegramKind) > PaygentB2BModuleResources__TELEGRAM_KIND_FIRST_CHARS) {
			$sKey = PaygentB2BModuleResources__URL_COMM 
				. substr($telegramKind, 0, PaygentB2BModuleResources__TELEGRAM_KIND_FIRST_CHARS);
		} else {
			// ������Ȥʤꡢ���顼�Ȥ���
			trigger_error(PaygentB2BModuleConnectException__TEREGRAM_PARAM_OUTSIDE_ERROR 
				. ": HTTP request contains unexpected value.", E_USER_WARNING);
			return false;
		}
		if (array_key_exists($sKey, $this->propConnect)) {
			$rs = $this->propConnect[$sKey];
		}
		
		// ���������Ƭ����Ǽ����Ǥ��ʤ��ä���硢���顼���᤹
		if (StringUtil::isEmpty($rs)) {
			trigger_error(PaygentB2BModuleConnectException__TEREGRAM_PARAM_OUTSIDE_ERROR 
				. ": HTTP request contains unexpected value.", E_USER_WARNING);
			return false;
		}
		
		return $rs;
	}

	/**
	 * PropertiesFile ���ͤ�����������ꡣ
	 *
	 * @return mixed ������TRUE��¾�����顼������ 
	 */
	function readProperties() {

		// Properties File Read
		$prop = null;

		$prop = PaygentB2BModuleResources::parseJavaProperty(PaygentB2BModuleResources__PROPERTIES_FILE_NAME);
		if ($prop === false) {
			// Properties File �ɹ����顼
			trigger_error(PaygentB2BModuleException__RESOURCE_FILE_NOT_FOUND_ERROR
				. ": Properties file doesn't exist.", E_USER_WARNING);
			return PaygentB2BModuleException__RESOURCE_FILE_NOT_FOUND_ERROR; 
		}

		// ɬ�ܹ��ܥ��顼�����å�
		if (!($this->isPropertiesIndispensableItem($prop) 
			&& $this->isPropertiesSetData($prop) 
			&& $this->isPropertieSetInt($prop))
			|| $this->isURLNull($prop)) {
			// ɬ�ܹ��ܥ��顼
			$propConnect = null;
			trigger_error(PaygentB2BModuleException__RESOURCE_FILE_REQUIRED_ERROR
				. ": Properties file contains inappropriate value.", E_USER_WARNING);
			return PaygentB2BModuleException__RESOURCE_FILE_REQUIRED_ERROR; 
		}
		$this->propConnect = $prop;
		
		// ���饤����Ⱦ�����ե�����ѥ�
		if (array_key_exists(PaygentB2BModuleResources__CLIENT_FILE_PATH, $prop)
				&& !(StringUtil::isEmpty($prop[PaygentB2BModuleResources__CLIENT_FILE_PATH]))) {
			$this->clientFilePath = $prop[PaygentB2BModuleResources__CLIENT_FILE_PATH];
		}

		// CA������ե�����ѥ�
		if (array_key_exists(PaygentB2BModuleResources__CA_FILE_PATH, $prop)
				&& !(StringUtil::isEmpty($prop[PaygentB2BModuleResources__CA_FILE_PATH]))) {
			$this->caFilePath = $prop[PaygentB2BModuleResources__CA_FILE_PATH];
		}

		// Proxy������̾
		if (array_key_exists(PaygentB2BModuleResources__PROXY_SERVER_NAME, $prop)
				&& !(StringUtil::isEmpty($prop[PaygentB2BModuleResources__PROXY_SERVER_NAME]))) {
			$this->proxyServerName = $prop[PaygentB2BModuleResources__PROXY_SERVER_NAME];
		}

		// ProxyIP���ɥ쥹
		if (array_key_exists(PaygentB2BModuleResources__PROXY_SERVER_IP, $prop)
				&& !(StringUtil::isEmpty($prop[PaygentB2BModuleResources__PROXY_SERVER_IP]))) {
			$this->proxyServerIp = $prop[PaygentB2BModuleResources__PROXY_SERVER_IP];
		}

		// Proxy�ݡ����ֹ�
		if (array_key_exists(PaygentB2BModuleResources__PROXY_SERVER_PORT, $prop)
				&& !(StringUtil::isEmpty($prop[PaygentB2BModuleResources__PROXY_SERVER_PORT]))) {
			if (StringUtil::isNumeric($prop[PaygentB2BModuleResources__PROXY_SERVER_PORT])) {
				$this->proxyServerPort = $prop[PaygentB2BModuleResources__PROXY_SERVER_PORT];
			} else {
				// �����ͥ��顼
				trigger_error(PaygentB2BModuleException__RESOURCE_FILE_REQUIRED_ERROR
					. ": Properties file contains inappropriate value.", E_USER_WARNING);
				return PaygentB2BModuleException__RESOURCE_FILE_REQUIRED_ERROR; 
			}
		}

		// �ǥե����ID
		if (array_key_exists(PaygentB2BModuleResources__DEFAULT_ID, $prop)
				&& !(StringUtil::isEmpty($prop[PaygentB2BModuleResources__DEFAULT_ID]))) {
			$this->defaultId = $prop[PaygentB2BModuleResources__DEFAULT_ID];
		}

		// �ǥե���ȥѥ����
		if (array_key_exists(PaygentB2BModuleResources__DEFAULT_PASSWORD, $prop)
				&& !(StringUtil::isEmpty($prop[PaygentB2BModuleResources__DEFAULT_PASSWORD]))) {
			$this->defaultPassword = $prop[PaygentB2BModuleResources__DEFAULT_PASSWORD];
		}

		// �����ॢ������
		if (array_key_exists(PaygentB2BModuleResources__TIMEOUT_VALUE, $prop)
				&& !(StringUtil::isEmpty($prop[PaygentB2BModuleResources__TIMEOUT_VALUE]))) {
			$this->timeout = $prop[PaygentB2BModuleResources__TIMEOUT_VALUE];
		}

		// ��������
		if (array_key_exists(PaygentB2BModuleResources__LOG_OUTPUT_PATH, $prop)
				&& !(StringUtil::isEmpty($prop[PaygentB2BModuleResources__LOG_OUTPUT_PATH]))) {
			$this->logOutputPath = $prop[PaygentB2BModuleResources__LOG_OUTPUT_PATH];
		}

		// �Ȳ�MAX���
		if (array_key_exists(PaygentB2BModuleResources__SELECT_MAX_CNT, $prop)
				&& !(StringUtil::isEmpty($prop[PaygentB2BModuleResources__SELECT_MAX_CNT]))) {
			$this->selectMaxCnt = $prop[PaygentB2BModuleResources__SELECT_MAX_CNT];
		}

		// �Ȳ���ʸ���̥ꥹ��
		if (array_key_exists(PaygentB2BModuleResources__TELEGRAM_KIND_REFS, $prop)
				&& !(StringUtil::isEmpty($prop[PaygentB2BModuleResources__TELEGRAM_KIND_REFS]))) {
			$telegramKindRef = $prop[PaygentB2BModuleResources__TELEGRAM_KIND_REFS];
			$this->telegramKindRefs = $this->split($telegramKindRef, PaygentB2BModuleResources__TELEGRAM_KIND_SEPARATOR);
		}
		if ($this->telegramKindRefs == null) {
			$this->telegramKindRefs = array();
		}
		
		return true;
	}

	/**
	 * Properties ɬ�ܹ��ܥ����å�
	 * 
	 * @param Properties
	 * @return boolean true=ɬ�ܹ���ͭ�� false=ɬ�ܹ���̵��
	 */
	function isPropertiesIndispensableItem($prop) {
		$rb = false;

		if ((array_key_exists(PaygentB2BModuleResources__CLIENT_FILE_PATH, $prop)
				&& array_key_exists(PaygentB2BModuleResources__CA_FILE_PATH, $prop)
				&& array_key_exists(PaygentB2BModuleResources__TIMEOUT_VALUE, $prop)
				&& array_key_exists(PaygentB2BModuleResources__LOG_OUTPUT_PATH, $prop)
				&& array_key_exists(PaygentB2BModuleResources__SELECT_MAX_CNT, $prop))) {
			// ɬ�ܹ���ͭ��
			$rb = true;
		}

		return $rb;
	}

	/**
	 * Properties �ǡ�����������å�
	 * 
	 * @param prop Properties
	 * @return boolean true=�ǡ���̤�������̵�� false=�ǡ���̤�������ͭ��
	 */
	function isPropertiesSetData($prop) {
		$rb = true;

		if (StringUtil::isEmpty($prop[PaygentB2BModuleResources__CLIENT_FILE_PATH])
				|| StringUtil::isEmpty($prop[PaygentB2BModuleResources__CA_FILE_PATH])
				|| StringUtil::isEmpty($prop[PaygentB2BModuleResources__TIMEOUT_VALUE])
				|| StringUtil::isEmpty($prop[PaygentB2BModuleResources__SELECT_MAX_CNT])) {
			// ɬ�ܹ���̤���ꥨ�顼
			$rb = false;
		}

		return $rb;
	}

	/**
	 * Properties ���ͥ����å�
	 * 
	 * @param prop Properties
	 * @return boolean true=�������� false=����̤����
	 */
	function isPropertieSetInt($prop) {
		$rb = false;

		if (StringUtil::isNumeric($prop[PaygentB2BModuleResources__TIMEOUT_VALUE])
				&& StringUtil::isNumeric($prop[PaygentB2BModuleResources__SELECT_MAX_CNT])) {
			// ��������
			$rb = true;
		}

		return $rb;
	}
	
	/**
	 * ��³��URL�ϥ̥뤫�ɤ����Υ����å�
	 * 
	 */
	function isURLNull($prop) {
		$rb = false;
		if (!is_array($prop)) {
			return true;
		}
		
		foreach($prop as $key => $value) {
			
			if (strpos($key, PaygentB2BModuleResources__URL_COMM) === 0) {
				if (isset($value) == false 
					|| strlen(trim($value)) == 0) {
					$rb = true;
					break;
				}
			}
		}
		return $rb;
	}
	
	/**
	 * ���ꤵ�줿���ڤ�ʸ����ʸ�����ʬ�䤷���ȥ�ह��
	 * 
	 * @param str ʸ����
	 * @param separator ���ڤ�ʸ��
	 * @return �ꥹ��
	 */
	function split($str, $separator) {
		$list = array();
		
		if ($str == null) {
			return $list;
		}
		
		if ($separator == null || strlen($separator) == 0) {
			if (!StringUtil::isEmpty(trim($str))) {
				$list[] = trim($str);
			}
			return $list;
		}
		
		$arr = explode($separator, $str);
		for ($i=0; $arr && $i < sizeof($arr); $i++) {
			if (!StringUtil::isEmpty(trim($arr[$i]))) {
				$list[] = trim($arr[$i]);
			}
		}
		
		return $list;
	}
	
	/**
	 * �Ȳ���ʸ�����å�
	 * @param telegramKind ��ʸ����
	 * @return true=�Ȳ���ʸ false=�Ȳ���ʸ�ʳ�
	 */
	function isTelegramKindRef($telegramKind) {
		$bRet = false;
		
		if ($this->telegramKindRefs == null) {
			return $bRet;
		}
		$bRet = in_array($telegramKind, $this->telegramKindRefs);
		return $bRet;
	}
 	
 	/**
 	 * Java�ե����ޥåȤΥץ�ѥƥ��ե����뤫���ͤ��������
 	 * �����������֤�
 	 * 
 	 * @param fileName �ץ�ѥƥ��ե�����̾
 	 * @param commentChar ��������ʸ��
 	 * @return FALSE: ���ԡ�¾:KEY=VALUE����������,
 	 */
 	function parseJavaProperty($fileName, $commentChar = "#") {

		$properties = array();
		
		$lines = @file($fileName, FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES);
 		if ($lines === false) {
			// Properties File �ɹ����顼
			return $lines;
 		}
 		
 		foreach ($lines as $i => $line) {
 			$lineData = trim($line);
 			
 			$index = strpos($lineData, '\r');
 			if (!($index === false)) {
 				$lineData = trim(substr($lineData, 0, $index));
 			}
 			$index = strpos($lineData, '\n');
 			if (!($index === false)) {
 				$lineData = trim(substr($lineData, 0, $index));
 			}

 			if (strlen($lineData) <= 0) {
 				continue;
 			}
 			$firstChar = substr($lineData, 0, strlen($commentChar));
 			
 			if ($firstChar == $commentChar) {
 				continue;
 			}
 			
			$quotationIndex = strpos($lineData, '=');
			if ($quotationIndex <= 0) {
				continue;
			}
			
			$key = trim(substr($lineData, 0, $quotationIndex));
			$value = null;
			if (strlen($lineData) > $quotationIndex) {
				$value = trim(substr($lineData, $quotationIndex + 1));
			}
			$properties[$key] = $value;
 		}
 		
 		return $properties;
 	}
	
 }
?>
