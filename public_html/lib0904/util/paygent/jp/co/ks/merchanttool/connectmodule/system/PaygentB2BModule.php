<?php
/**
 * PAYGENT B2B MODULE
 * PaygentB2BModule.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

include_once("jp/co/ks/merchanttool/connectmodule/util/HttpsRequestSender.php");
include_once("jp/co/ks/merchanttool/connectmodule/entity/ReferenceResponseDataImpl.php");
include_once("jp/co/ks/merchanttool/connectmodule/entity/ResponseData.php");
include_once("jp/co/ks/merchanttool/connectmodule/util/PaygentB2BModuleLogger.php");
include_once("jp/co/ks/merchanttool/connectmodule/entity/ResponseDataFactory.php");
include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleConnectException.php");
include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleException.php");
include_once("jp/co/ks/merchanttool/connectmodule/util/StringUtil.php");

/**
 * ��³�⥸�塼�� �ᥤ������ѥ��饹
 * 
 * @version $Revision: 1.4 $
 * @author $Author: t-mori $
 */


	/**
	 * ��ʸ�ѥ�᡼�� Key Length
	 */
	define("PaygentB2BModule__TELEGRAM_KEY_LENGTH", 30);

	/**
	 * ��ʸ�ѥ�᡼�� Valeu Length
	 */
	define("PaygentB2BModule__TELEGRAM_VALUE_LENGTH", 10240);

	/**
	 * ��ʸ�ѥ�᡼�� ���ܿ�
	 */
	define("PaygentB2BModule__TELEGRAM_ITEM_COUNT", 50);

	/**
	 * ��³ID
	 */
	define("PaygentB2BModule__CONNECT_ID_KEY", "connect_id");

	/**
	 * ��³�ѥ����
	 */
	define("PaygentB2BModule__CONNECT_PASSWORD_KEY", "connect_password");

	/**
	 * ��ʸ����ID
	 */
	define("PaygentB2BModule__TELEGRAM_KIND_KEY", "telegram_kind");

	/**
	 * ���縡����
	 */
	define("PaygentB2BModule__LIMIT_COUNT_KEY", "limit_count");
	
	/**
	 * ������̡�1
	 */
	define("PaygentB2BModule__RESULT_STATUS_ERROR", "1");
	
	/**
	 * �쥹�ݥ󥹥����ɡ�9003
	 */
	define("PaygentB2BModule__RESPONSE_CODE_9003", "9003");


class PaygentB2BModule {
	/**
	 * �����Ѵ��� �׵���ʸ POST�ѥ�᡼��̾
	 */
	var $REPLACE_KANA_PARAM = array("customer_family_name_kana", "customer_name_kana",
			"payment_detail_kana", "claim_kana", "receipt_name_kana");

	/** ���饤����Ⱦ�����ե�����ѥ� */
	var $clientFilePath;

	/** CA������ե�����ѥ� */
	var $caFilePath;

	/** Proxy������̾ */
	var $proxyServerName;

	/** ProxyIP���ɥ쥹 */
	var $proxyServerIp;

	/** Proxy�ݡ����ֹ� */
	var $proxyServerPort;

	/** �ǥե����ID */
	var $defaultId;

	/** �ǥե���ȥѥ���� */
	var $defaultPassword;

	/** �����ॢ������ */
	var $timeout;

	/** ���CSV�ե�����̾ */
	var $resultCsv;

	/** �Ȳ�MAX��� */
	var $selectMaxCnt;

	/** ��ʸ����ID */
	var $telegramKind;

	/** PropertiesFile ���ݻ� */
	var $masterFile;

	/** �����ݻ� */
	var $telegramParam = array();

	/** �̿����� */
	var $sender;

	/** ������� */
	var $responseData;

	/** Logger */
	var $logger = null;

	/**
	 * ���󥹥ȥ饯��
	 *
	 * @return �ʤ� �������Ƥ��뤫�Υ����å��� 
	 */
	function PaygentB2BModule() {

		// �ѿ������
		$this->telegramParam = array();

	}
	
	/**
	 * ���饹����������
	 * @return mixed true:������¾�����顼������
	 */
	function init() {
		// �����ͤ����
		$this->masterFile = PaygentB2BModuleResources::getInstance();

		// Logger �����
		$this->logger = PaygentB2BModuleLogger::getInstance();
		
		if ($this->masterFile == null
			|| strcasecmp(get_class($this->masterFile), "PaygentB2BModuleResources") != 0) {
			// ���顼������
			return $this->masterFile;
		}

		if ($this->logger == null 
			|| strcasecmp(get_class($this->logger), "PaygentB2BModuleLogger") != 0) {
			// ���顼������
			return $this->logger;
		}
		
		// �����ͤ򥻥å�
		$this->clientFilePath = $this->masterFile->getClientFilePath();
		$this->caFilePath = $this->masterFile->getCaFilePath();
		$this->proxyServerName = $this->masterFile->getProxyServerName();
		$this->proxyServerIp = $this->masterFile->getProxyServerIp();
		$this->proxyServerPort = $this->masterFile->getProxyServerPort();
		$this->defaultId = $this->masterFile->getDefaultId();
		$this->defaultPassword = $this->masterFile->getDefaultPassword();
		$this->timeout = $this->masterFile->getTimeout();
		$this->selectMaxCnt = $this->masterFile->getSelectMaxCnt();

		return true;
	}

	/**
	 * �ǥե����ID������
	 * 
	 * @param defaultId String
	 */
	function setDefaultId($defaultId) {
		$this->defaultId = $defaultId;
	}

	/**
	 * �ǥե����ID�����
	 * 
	 * @return String defaultId
	 */
	function getDefaultId() {
		return $this->defaultId;
	}

	/**
	 * �ǥե���ȥѥ���ɤ�����
	 * 
	 * @param defaultPassword String
	 */
	function setDefaultPassword($defaultPassword) {
		$this->defaultPassword = $defaultPassword;
	}

	/**
	 * �ǥե���ȥѥ���ɤ����
	 * 
	 * @return String defaultPassword
	 */
	function getDefaultPassword() {
		return $this->defaultPassword;
	}

	/**
	 * �����ॢ�����ͤ�����
	 * 
	 * @param timeout int
	 */
	function setTimeout($timeout) {
		$this->timeout = $timeout;
	}

	/**
	 * �����ॢ�����ͤ����
	 * 
	 * @return int timeout
	 */
	function getTimeout() {
		return $this->timeout;
	}

	/**
	 * ���CSV�ե�����̾������
	 * 
	 * @param resultCsv String
	 */
	function setResultCsv($resultCsv) {
		$this->resultCsv = $resultCsv;
	}

	/**
	 * ���CSV�ե�����̾�����
	 * 
	 * @return String resultCsv
	 */
	function getResultCsv() {
		return $this->resultCsv;
	}

	/**
	 * �Ȳ�MAX���������
	 * 
	 * @param selectMaxCnt int
	 */
	function setSelectMaxCnt($selectMaxCnt) {
		$this->selectMaxCnt = $selectMaxCnt;
	}

	/**
	 * �Ȳ�MAX��������
	 * 
	 * @return String selectMaxCnt
	 */
	function getSelectMaxCnt() {
		return $this->selectMaxCnt;
	}

	/**
	 * ����������
	 * 
	 * @param key String
	 * @param valuet String
	 */
	function reqPut($key, $value) {
		$tempVal = $value;
		
		if ($tempVal == null) {
			// Value �ͤ� null �����ǧ��ʤ�
			$tempVal = "";
		}
		$this->telegramParam[$key] = $tempVal;
	}

	/**
	 * ���������
	 * 
	 * @param key Stirng
	 * @return String value
	 */
	function reqGet($key) {
		return $this->telegramParam[$key];
	}

	/**
	 * �Ȳ������¹�
	 * 
	 * @return String true��������¾:���顼�����ɡ�
	 */
	function post() {

		$rslt = "";
		
		// ��ʸ����ID �����
		$this->telegramKind = "";
		
		if (array_key_exists(PaygentB2BModule__TELEGRAM_KIND_KEY, $this->telegramParam)) {
			$this->telegramKind = $this->telegramParam[PaygentB2BModule__TELEGRAM_KIND_KEY];
		}

		// �׵���ʸ�ѥ�᡼��̤�����ͤ�����
		$this->setTelegramParamUnsetting();

		// Post�����顼�����å�
		$rslt = $this->postErrorCheck();
		if (!($rslt === true)) {
			// ���顼������
			return 	$rslt;
		}

		// URL����
		$url = $this->masterFile->getUrl($this->telegramKind);
		if ($url === false) {
			return PaygentB2BModuleConnectException__TEREGRAM_PARAM_OUTSIDE_ERROR;
		}

		// HttpsRequestSender����
		$this->sender = new HttpsRequestSender($url);

		// ���饤����Ⱦ�����ѥ�����
		$this->sender->setClientCertificatePath($this->clientFilePath);

		// CA������ѥ�����
		$this->sender->setCaCertificatePath($this->caFilePath);

		// �����ॢ��������
		$this->sender->setTimeout($this->timeout);

		// Proxy��³�����ॢ��������
		$this->sender->setProxyConnectTimeout($this->timeout);

		// Proxy���������ॢ��������
		$this->sender->setProxyCommunicateTimeout($this->timeout);

		if ($this->isProxyDataSet()) {
			if (!StringUtil::isEmpty($this->proxyServerIp)) {
				$this->sender->setProxyInfo($this->proxyServerIp, $this->proxyServerPort);
			} else if (!StringUtil::isEmpty($this->proxyServerName)) {
				$this->sender->setProxyInfo($this->proxyServerName, $this->proxyServerPort);
			}
		}

		// �����Ѵ�����
		$this->replaceTelegramKana();

		// ��ʸĹ�����å�
		if (!$this->sender->isTelegramLength($this->telegramParam)) {
			// ��ʸĹ���顼
			return PaygentB2BModuleConnectException__TEREGRAM_PARAM_REQUIRED_ERROR;
		}

		// Post
		$rslt =	$this->sender->postRequestBody($this->telegramParam);
		if (!($rslt === true)) {
			// ���顼������
			return $rslt;
		}

		// Get Response
		$resBody = $this->sender->getResponseBody();

		// Create ResponseData
		$this->responseData = ResponseDataFactory::create($this->telegramKind);

		// Parse Stream
		if ($this->isParseProcess()) {
			$rslt = $this->responseData->parse($resBody);
		} else {
			$rslt = $this->responseData->parseResultOnly($resBody);
		}

		if (!($rslt === true)) {
			return $rslt;
		}

		// CSV File����Ƚ��
		if ($this->isCSVOutput()) {
			// CSV File ����
			if (strcasecmp(get_class($this->responseData), "ReferenceResponseDataImpl") == 0) {
				
				$rslt = $this->responseData->writeCSV($resBody, $this->resultCsv); 
				if (!($rslt === true)) {
					// CSV File Output Error
					return $rslt;
				}
			}
		}
		
		return true;
	}

	/**
	 * ������̤��֤�
	 * 
	 * @return Map���ʤ���硢NULL
	 */
	function resNext() {
		if ($this->responseData == null) {
			return null;			
		}
		return $this->responseData->resNext();
	}

	/**
	 * ������̤�¸�ߤ��뤫Ƚ��
	 * 
	 * @return boolean
	 */
	function hasResNext() {
		if ($this->responseData == null) {
			return false;
		}

		return $this->responseData->hasResNext();
	}

	/**
	 * ������̤����
	 * 
	 * @return String ������̡��ʤ���硢NULL
	 */
	function getResultStatus() {
		if ($this->responseData == null) {
			return null;
		}
		return $this->responseData->getResultStatus();
	}

	/**
	 * �쥹�ݥ󥹥����ɤ����
	 * 
	 * @return String �쥹�ݥ󥹥����ɡ��ʤ���硢NULL
	 */
	function getResponseCode() {
		if ($this->responseData == null) {
			
			return null;
		}
		return $this->responseData->getResponseCode();
	}

	/**
	 * �쥹�ݥ󥹾ܺ٤����
	 * 
	 * @return String �쥹�ݥ󥹾ܺ١��ʤ���硢NULL
	 */
	function getResponseDetail() {
		if ($this->responseData == null) {
			return null;
		}
		return $this->responseData->getResponseDetail();
	}

	/**
	 * �׵���ʸ�ѥ�᡼��̤�����ͤ�����
	 */
	function setTelegramParamUnsetting() {
		// ��³ID
		if (!array_key_exists(PaygentB2BModule__CONNECT_ID_KEY, $this->telegramParam)) {
			// ��³ID ��̤����ξ�硢�ǥե����ID ������
			$this->telegramParam[PaygentB2BModule__CONNECT_ID_KEY] = $this->defaultId;
		}

		// ��³�ѥ����
		if (!array_key_exists(PaygentB2BModule__CONNECT_PASSWORD_KEY, $this->telegramParam)) {
			// ��³�ѥ���ɤ�̤����ξ�硢�ǥե���ȥѥ���� ������
			$this->telegramParam[PaygentB2BModule__CONNECT_PASSWORD_KEY] = $this->defaultPassword;
		}

		// ���縡����
		if ($this->telegramKind != null) {
			if ($this->masterFile->isTelegramKindRef($this->telegramKind)) {
				// ��Ѿ���Ȳ�ξ��
				if (!array_key_exists(PaygentB2BModule__LIMIT_COUNT_KEY, $this->telegramParam)) {
					// ���縡������̤����ξ�硢�Ȳ�MAX���������
					$this->telegramParam[PaygentB2BModule__LIMIT_COUNT_KEY] = 
						$this->selectMaxCnt;
				}
			}
		}
	}

	/**
	 * Post�����顼�����å�
	 * 
	 * @return mixed ���顼�ʤ��ξ�硧TRUE��¾�����顼������
	 */
	function postErrorCheck() {
		// �ѥ�᡼��ɬ�ܥ����å�
		if (!$this->isModuleParamCheck()) {
			// �⥸�塼��ѥ�᡼�����顼
			trigger_error(PaygentB2BModuleConnectException__MODULE_PARAM_REQUIRED_ERROR 
					. ": Error in indespensable HTTP request value.", E_USER_WARNING);
			return PaygentB2BModuleConnectException__MODULE_PARAM_REQUIRED_ERROR;
		}

		if (!$this->isTeregramParamCheck()) {
			// ��ʸ�׵�ѥ�᡼�����顼
			trigger_error(PaygentB2BModuleConnectException__TEREGRAM_PARAM_OUTSIDE_ERROR 
					. ": HTTP request contains unexpected value.", E_USER_WARNING);
			return PaygentB2BModuleConnectException__TEREGRAM_PARAM_OUTSIDE_ERROR;
		}

		if (!$this->isResultCSV()) {
			// ���CSV�ե�����̾���ꥨ�顼
			trigger_error(PaygentB2BModuleConnectException__RESPONSE_TYPE_ERROR 
					. ": CVS file name error.", E_USER_WARNING);
			return PaygentB2BModuleConnectException__RESPONSE_TYPE_ERROR;
		}
		
		if (!$this->isTeregramParamKeyNullCheck()) {
			// ��ʸ�׵�Key null ���顼
			trigger_error(PaygentB2BModuleConnectException__TEREGRAM_PARAM_REQUIRED_ERROR 
					. ": HTTP request key must be null.", E_USER_WARNING);
			return PaygentB2BModuleConnectException__TEREGRAM_PARAM_REQUIRED_ERROR;
		}

		if (!$this->isTelegramParamKeyLenCheck()) {
			// ��ʸ�׵�KeyĹ���顼
			trigger_error(PaygentB2BModuleConnectException__TEREGRAM_PARAM_REQUIRED_ERROR 
					. ": HTTP request key must be shorter than " 
					. PaygentB2BModule__TELEGRAM_KEY_LENGTH . " bytes.", E_USER_WARNING);
			return PaygentB2BModuleConnectException__TEREGRAM_PARAM_REQUIRED_ERROR;
		}

		if (!$this->isTelegramParamValueLenCheck()) {
			// ��ʸ�׵�ValueĹ���顼
			trigger_error(PaygentB2BModuleConnectException__TEREGRAM_PARAM_REQUIRED_ERROR 
					. ": HTTP request value must be shorter than "
					. PaygentB2BModule__TELEGRAM_VALUE_LENGTH . " bytes.", E_USER_WARNING);
			return PaygentB2BModuleConnectException__TEREGRAM_PARAM_REQUIRED_ERROR;
		}

		if (!$this->isTelegramParamItemCountCheck()) {
			// ��ʸ�׵���ܿ����顼
			trigger_error(PaygentB2BModuleConnectException__TEREGRAM_PARAM_REQUIRED_ERROR 
					. ": The number of HTTP request keys must be smaller than "
					. PaygentB2BModule__TELEGRAM_ITEM_COUNT . ".", E_USER_WARNING);
			return PaygentB2BModuleConnectException__TEREGRAM_PARAM_REQUIRED_ERROR;
		}
		return true;
	}

	/**
	 * �⥸�塼��ѥ�᡼�������å�
	 * 
	 * @return boolean true=NotError false=Error
	 */
	function isModuleParamCheck() {
		$rb = false;

		// ɬ�ܥ��顼�����å�
		if ((0 < $this->timeout) && (0 < $this->selectMaxCnt)) {
			$rb = true;
		}

		return $rb;
	}

	/**
	 * ��ʸ�׵�ѥ�᡼�������å�
	 * 
	 * @return boolean true=NotError false=Error
	 */
	function isTeregramParamCheck() {
		$rb = false;

		// ��ʸ����ID ���顼�����å�
		if (array_key_exists(PaygentB2BModule__TELEGRAM_KIND_KEY, $this->telegramParam)) {
			if (!StringUtil::isEmpty($this->telegramParam[
				PaygentB2BModule__TELEGRAM_KIND_KEY])) {
				$rb = true;
			}
		}

		return $rb;
	}

	/**
	 * ���CSV�ե�����̾��������å�
	 * 
	 * @return boolean true=NotError false=Error
	 */
	function isResultCSV() {
		$rb = true;

		// ���CSV�ե�����̾���ꥨ�顼�����å�
		if (!$this->masterFile->isTelegramKindRef($this->telegramKind)
				&& !StringUtil::isEmpty($this->resultCsv)) {
			$rb = false;
		}

		return $rb;
	}

	/**
	 * ��ʸ�׵�ѥ�᡼�� Key Null �����å�
	 * 
	 * @return boolean true=NotError false=Error
	 */
	function isTeregramParamKeyNullCheck() {
		$rb = true;

		// Key null �����å�
		if (array_key_exists(null, $this->telegramParam)) {
				$rb = false;
		}

		return $rb;
	}

	/**
	 * ��ʸ�׵�ѥ�᡼�� Key Ĺ�����å�
	 * 
	 * @return boolean true=NoError false=Error
	 */
	function isTelegramParamKeyLenCheck() {
		$rb = true;

		foreach($this->telegramParam as $keys => $values) {
			if (!StringUtil::isEmpty($keys)) {
				if (strlen($keys) > PaygentB2BModule__TELEGRAM_KEY_LENGTH) {
					$rb = false;
					break;
				}
			}
		}
		
		return $rb;
	}

	/**
	 * ��ʸ�׵�ѥ�᡼�� Value Ĺ�����å�
	 * 
	 * @return boolean true=NoError false=Error
	 */
	function isTelegramParamValueLenCheck() {
		$rb = true;

		foreach($this->telegramParam as $keys => $values) {
			if (!StringUtil::isEmpty($values)) {
				if (strlen($values) > PaygentB2BModule__TELEGRAM_VALUE_LENGTH) {
					$rb = false;
					break;
				}
			}
		}
		
		return $rb;
	}

	/**
	 * ��ʸ�׵�ѥ�᡼�� ���ܿ������å�
	 * 
	 * @return boolean true=NoError false=Error
	 */
	function isTelegramParamItemCountCheck() {
		$rb = false;

		if (count($this->telegramParam) <= PaygentB2BModule__TELEGRAM_ITEM_COUNT) {
			$rb = true;
		}

		return $rb;
	}

	/**
	 * Proxy ����Ƚ��
	 * 
	 * @return boolean true=Set false=NotSet
	 */
	function isProxyDataSet() {
		$rb = false;

		if (!(StringUtil::isEmpty($this->proxyServerIp) && StringUtil
				::isEmpty($this->proxyServerName))
				&& 0 < $this->proxyServerPort) {
			// Proxy ����Ѥξ��
			$rb = true;
		}

		return $rb;
	}

	/**
	 * Parse ����Ƚ��
	 * 
	 * @param InputStream
	 * @return boolean true=parse false=ResultOnly
	 */
	function isParseProcess() {
		$rb = true;

		// Parse �����»�Ƚ��
		if (strcasecmp(get_class($this->responseData), "ReferenceResponseDataImpl") == 0) {
			// ReferenceResponseDataImpl �ξ��Τߡ�CSV���ϲ��ݤ���»�Ƚ��
			if (!StringUtil::isEmpty($this->resultCsv)) {
				$rb = false;
			}
		}

		return $rb;
	}
	
	/**
	 * CSV ����Ƚ��
	 * 
	 * @return boolean true=CSV Output false=Non
	 */
	function isCSVOutput() {
		$rb = false;

		if ($this->masterFile->isTelegramKindRef($this->telegramKind)
				&& !StringUtil::isEmpty($this->resultCsv)) {
			// ��ʸ���̤��Ȳ� ��� ���CSV�ե�����̾ ������Ѥξ��
			if ($this->getResultStatus() == PaygentB2BModule__RESULT_STATUS_ERROR) {
				// ������̤��۾�ξ��
				if ($this->getResponseCode() == PaygentB2BModule__RESPONSE_CODE_9003) {
					// �쥹�ݥ󥹥����ɤ� 9003 �ξ��
					$rb = true;
				}
			} else {
				// ������̤�����ξ��
				$rb = true;
			}
		}
		
		return $rb;
	}

	/**
	 * ��ʸ�׵�ѥ�᡼�� Ⱦ�ѥ��� �ִ�����
	 */
	function replaceTelegramKana() {

		foreach($this->telegramParam as $keys => $values) {
			if (in_array(strtolower($keys), $this->REPLACE_KANA_PARAM)) {
				$this->telegramParam[$keys] = 
					StringUtil::convertKatakanaZenToHan($values);
			}
		}
	}

}

?>
