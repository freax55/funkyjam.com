<?php
/**
 * PAYGENT B2B MODULE
 * HttpsRequestSender.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

include_once("jp/co/ks/merchanttool/connectmodule/util/StringUtil.php");
include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleConnectException.php");
include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleException.php");
include_once("jp/co/ks/merchanttool/connectmodule/util/PaygentB2BModuleLogger.php");

/**
 * https�׵�򤪤��ʤ��桼�ƥ���ƥ����饹��
 * 
 * @vesrion $Revision: 1.5 $
 * @author $Author: t-mori $
 */
 
	// cURL ���顼������ 
	// http://curl.haxx.se/libcurl/c/libcurl-errors.html
	define("HttpsRequestSender__CURLE_COULDNT_CONNECT", 7);
	define("HttpsRequestSender__CURLE_SSL_CERTPROBLEM", 58);	
	define("HttpsRequestSender__CURLE_SSL_CACERT", 60);
	define("HttpsRequestSender__CURLE_SSL_CACERT_BADFILE", 77);
	define("HttpsRequestSender__CURLE_HTTP_RETURNED_ERROR", 22);

	/**
	 * HTTP POST �̿��Ѹ�����
	 */
	define("HttpsRequestSender__POST", "POST");

	/**
	 * HTTP�ץ�ȥ����ɽ�����
	 */
	define("HttpsRequestSender__HTTP", "HTTP");

	/**
	 * HTTP/1.0��ɽ�����
	 */
	define("HttpsRequestSender__HTTP_1_0", "HTTP/1.0");

	/**
	 * HTTP�̿�������������
	 */
	define("HttpsRequestSender__HTTP_1_0_200", "HTTP/1.0 200");
	
	/**
	 * HTTP�̿������������ɡ�200
	 */
	define("HttpsRequestSender__HTTP_SUCCESS", 200);
	
	/**
	 * HTTP�̿������������ɡ�206
	 */
	define("HttpsRequestSender__HTTP_PARTIAL_CONTENT", 206);

	/**
	 * ��ʸĹ
	 */
	define("HttpsRequestSender__TELEGRAM_LENGTH", 10240);

	/**
	 * HTTPS Default Port
	 */
	define("HttpsRequestSender__DEFAULT_PORT", 443);

	/**
	 * �ꥯ�����ȡ��쥹�ݥ󥹤β��ԥ�����
	 */
	define("HttpsRequestSender__CRLF", "\r\n");

	/**
	 * �ǥե���ȤΥ��󥳡��ǥ���
	 */
	define("HttpsRequestSender__DEFAULT_ENCODING", "SJIS-win");

	/**
	 * HTTP���ơ������������ѿ��ν����
	 */
	define("HttpsRequestSender__HTTP_STATUS_INIT_VALUE", -1);

	/**
	 * ���ơ����������ɤ�Ĺ��
	 */
	define("HttpsRequestSender__REGEXPSTATUS_LEN", 3);

	/**
	 * Content-Length
	 */
	define("HttpsRequestSender__CONTENT_LENGTH", "Content-Length");

	/**
	 * User-Agent
	 */
	define("HttpsRequestSender__USER_AGENT", "User-Agent");

	/**
	 * Content-Type
	 */
	define("HttpsRequestSender__CONTENT_TYPE", "Content-Type=application/x-www-form-urlencoded");
	define("HttpsRequestSender__HTTP_ENCODING", "charset=Windows-31J");
	
class HttpsRequestSender {
	/**
	 * KeyStore Password
	 */
	var $KEYSTORE_PASSWORD = "changeit";

	/** �쥹�ݥ󥹥إå� */
	var $responseHeader;

	/** �쥹�ݥ󥹥ܥǥ� */
	var $responseBody;

	/** ���ơ����������ɡ�*/
	var $statusCode;
	
	/** ��³�� URL */
	var $url;

	/** ���饤����Ⱦ�����ѥ� */
	var $clientCertificatePath;

	/** ǧ�ڶɾ�����ѥ� */
	var $caCertificatePath;

	/** SSL�̿��ѥ����å� */
	var $ch;

	/** �ȥ�ͥ륽���å� */
	//var $tunnelSocket;

	/** �����ॢ������ int */
	var $timeout;

	/** Proxy�ۥ���̾ */
	var $proxyHostName;

	/** Proxy�ݡ����ֹ� int */
	var $proxyPort;

	/** Proxy��³�����ॢ������ */
	var $proxyConnectTimeout;

	/** Proxy���������ॢ������ */
	var $proxyCommunicateTimeout;

	/** Proxy����Ƚ�� */
	var $isUsingProxy = false;

	/**
	 * ���󥹥ȥ饯��<br>
	 * ��³��URL������
	 * 
	 * @param url String
	 */
	function HttpsRequestSender($url) {
		$this->url = $url;
		$this->proxyHostName = "";
		$this->proxyPort = 0;
		
		$this->responseBody = null;
		$this->responseHeader = null;
	}

	/**
	 * ���饤����Ⱦ�����ѥ�������
	 * 
	 * @param fileName String
	 */
	function setClientCertificatePath($fileName) {
		$this->clientCertificatePath = $fileName;
	}

	/**
	 * ǧ�ڶɾ�����ѥ�������
	 * 
	 * @param fileName String
	 */
	function setCaCertificatePath($fileName) {
		$this->caCertificatePath = $fileName;
	}

	/**
	 * �����ॢ���Ȥ�����
	 * 
	 * @param timeout int
	 */
	function setTimeout($timeout) {
		$this->timeout = $timeout;
	}

	/**
	 * Proxy��³�����ॢ���Ȥ�����
	 * 
	 * @param proxyConnectTimeout int
	 */
	function setProxyConnectTimeout($proxyConnectTimeout) {
		$this->proxyConnectTimeout = $proxyConnectTimeout;
	}

	/**
	 * Proxy���������ॢ���Ȥ�����
	 * 
	 * @param proxyCommunicateTimeout int
	 */
	function setProxyCommunicateTimeout($proxyCommunicateTimeout) {
		$this->proxyCommunicateTimeout = $proxyCommunicateTimeout;
	}

	/**
	 * ProxyHostName, ProxyPort ������
	 * 
	 * @param proxyHostName String
	 * @param proxyPort int
	 */
	function setProxyInfo($proxyHostName, $proxyPort) {
		$this->proxyHostName = $proxyHostName;
		$this->proxyPort = $proxyPort;
		$this->isUsingProxy = false;

		if (!StringUtil::isEmpty($this->proxyHostName) && 0 < $this->proxyPort) {
			// Proxy�������ꤵ�줿�١�true ������
			$this->isUsingProxy = true;
		}
	}

	/**
	 * Post��»�
	 * 
	 * @param formData Map
	 * @return mixed TRUE:������¾:���顼������
	 */
	function postRequestBody($formData) {

		// �̿�����
		$this->initCurl();

		if ($this->isUsingProxy) {
			// �ץ�����ͳ���̿������³
			$this->setProxy();
		}

		// �ꥯ�����Ȥ�����
		$retCode = $this->send($formData);

		// �쥹�ݥ󥹤����
		$this->closeCurl();

		return $retCode;
	}

	/**
	 * �����ǡ������֤�
	 * 
	 * @return InputStream
	 */
	function getResponseBody() {
		return $this->responseBody;
	}

	/**
	 * ��ʸĹ�����å�
	 * 
	 * @return boolean true=NotError false=Error
	 */
	function isTelegramLength($formData) {
		$rb = false;

		// URL Length Check
		$sb = $this->url;
		$sb .= "?";
		$sb .= $this->convertToUrlEncodedString($formData);

		if (strlen($sb) <= HttpsRequestSender__TELEGRAM_LENGTH) {
			$rb = true;
		}

		return $rb;
	}

	/**
	 * �׵���ʸ�����
	 * 
	 * @param formData Map �׵���ʸ
	 * @return String ���������׵���ʸ��URL��
	 */
	function convertToUrlEncodedString($formData) {
		$encodedString = "";
		if ($formData == null) {
			return "";
		}

		foreach($formData as $key => $value) {
//			$this->outputDebugLog("param: " . $key . " = \"" . $value . "\"");
			$tmp = $key;
			$encodedString .= urlencode($tmp);
			$encodedString .= "=";
			$tmp = $value;
			$encodedString .= urlencode($tmp);
			$encodedString .= "&";
		}

		$rs = "";

		if (0 < strlen($encodedString)) {
			$rs = substr($encodedString, 0, strlen($encodedString) - 1);
		}

		return $rs;

	}
	
	/**
	 * �ǥХå������ϥ᥽�å�
	 * �����ϥ��饹�Υ��󥹥��������˼��Ԥ�����ɸ����Ϥ˥��顼��å�������
	 * ���Ϥ��롣
	 * 
	 * @param msg String ���ϥ�å�����
	 */
	function outputDebugLog($msg) {
		if(StringUtil::isEmpty($msg)) return;

		$inst = PaygentB2BModuleLogger::getInstance();
		if (is_object($inst)) {
			$inst->debug(get_class($this), $msg);
		}
	}

	/**
	 * Proxy��³��
	 * 
	 */
	function setProxy() {
		curl_setopt($this->ch, CURLOPT_HTTPPROXYTUNNEL, true);
		curl_setopt($this->ch, CURLOPT_PROXY, "http://" . $this->proxyHostName . ":" . $this->proxyPort);

	}

	/**
	 * ��³�Τ���ν��������
	 * 
	 */
	function initCurl() {
		$rslt = true;
		// �����
		$this->ch = curl_init($this->url);

		$rslt = $rslt && curl_setopt($this->ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0 );
		$rslt = $rslt && curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		$rslt = $rslt && curl_setopt($this->ch, CURLOPT_POST, true);
		$rslt = $rslt && curl_setopt($this->ch, CURLOPT_HEADER, true);
		
		// ������
		$rslt = $rslt && curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, true);
		$rslt = $rslt && curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
		$rslt = $rslt && curl_setopt($this->ch, CURLOPT_SSLCERT, $this->clientCertificatePath);
		$rslt = $rslt && curl_setopt($this->ch, CURLOPT_SSLKEYPASSWD, $this->KEYSTORE_PASSWORD);
		$rslt = $rslt && curl_setopt($this->ch, CURLOPT_CAINFO, $this->caCertificatePath);
		
		// �����ॢ����
		$rslt = $rslt && curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->timeout);
		$rslt = $rslt && curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->proxyConnectTimeout);

		return $rslt;
	}

	/**
	 * �ꥯ����������������
	 * 
	 * @param formData Map �׵���ʸ
	 * @return mixed TRUE:������¾:���顼������
	 */
	function send($formData) {
		// �ꥯ�����Ȥ� Map ���� String ���Ѵ�

		$query = $this->convertToUrlEncodedString($formData);

		$header = array();
		$header[] = HttpsRequestSender__CONTENT_TYPE;
		$header[] = HttpsRequestSender__HTTP_ENCODING;
		$header[] = HttpsRequestSender__CONTENT_LENGTH . ": " 
			. (StringUtil::isEmpty($query)? "0" : strlen($query));
		$header[] = HttpsRequestSender__USER_AGENT . ": " . "curl_php";
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $query);
		
//		$this->outputDebugLog("Query: " . $query);		
		$str = curl_exec($this->ch);

		if ($str === false && curl_errno($this->ch) != 0) {
			return $this->procError($this->ch);
		}
		
		$this->outputDebugLog("Response: " . $str);		
		$data = $str;
		$retCode = $this->parseResponse($data);

		return $retCode;
	}

	/**
	 * Curl�Υ��顼����
	 * @return mixed True:����ʤ���¾�����顼������
	 */
	function procError() {
		$errorNo = curl_errno($this->ch);
		$errorMsg = $errorNo . ": " . curl_error($this->ch); 
		$retCode = true;
		
		if ($errorNo <= HttpsRequestSender__CURLE_COULDNT_CONNECT) { // 7
			// ��³����
			$retCode = PaygentB2BModuleConnectException__KS_CONNECT_ERROR;
			$this->outputDebugLog($errorMsg);
		} else if ($errorNo == HttpsRequestSender__CURLE_COULDNT_CONNECT) { // 7
			// ��³����
			$retCode = PaygentB2BModuleConnectException__KS_CONNECT_ERROR;
			$this->outputDebugLog($errorMsg);
		} else if ($errorNo == HttpsRequestSender__CURLE_SSL_CERTPROBLEM) { 
			// ǧ������
			$retCode = PaygentB2BModuleConnectException__CERTIFICATE_ERROR;
			$this->outputDebugLog($errorMsg);
		} else if ($errorNo == HttpsRequestSender__CURLE_SSL_CACERT) {
			// ǧ������
			$retCode = PaygentB2BModuleConnectException__CERTIFICATE_ERROR;
			$this->outputDebugLog($errorMsg);
		} else if ($errorNo == HttpsRequestSender__CURLE_SSL_CACERT_BADFILE) {	// CURLE_SSL_CACERT_BADFILE 
			// ǧ������
			$retCode = PaygentB2BModuleConnectException__CERTIFICATE_ERROR;
			$this->outputDebugLog($errorMsg);
		} else if ($errorNo == HttpsRequestSender__CURLE_HTTP_RETURNED_ERROR) {
			// HTTP Return code error
			$retCode = PaygentB2BModuleConnectException__KS_CONNECT_ERROR;
			$this->outputDebugLog($errorMsg);
		} else {
			// ����¾�Υ��顼
			$retCode = PaygentB2BModuleConnectException__KS_CONNECT_ERROR;
			$this->outputDebugLog($errorMsg);
		}

		trigger_error("$retCode: Http request ended with errors.", E_USER_WARNING);
		return $retCode;
	}

	/**
	 * �쥹�ݥ󥹤������
	 * 
	 * @param $data �쥹�ݥ�ʸ����
	 * @return mixed TRUE:������¾:���顼������
	 */
	function parseResponse($data) {

		// �쥹�ݥ󥹼���
		$line = null;
		$retCode = HttpsRequestSender__HTTP_STATUS_INIT_VALUE;
		$bHeaderOver = false;
		$resBodyStart = 0;
	
		$lines = mb_split(HttpsRequestSender__CRLF, $data);
		// �إå��ޤǤ��ɤ߹���
		foreach($lines as $i => $line) {
			
			if (StringUtil::isEmpty($line)) {
				 break;	
			}
			$resBodyStart += strlen($line) + strlen(HttpsRequestSender__CRLF);
			
			if ($retCode === HttpsRequestSender__HTTP_STATUS_INIT_VALUE) {
				// ���ơ������β���
				$retCode = $this->parseStatusLine($line);
				if ($retCode === true) {
					continue;
				}
				$this->outputDebugLog("Cannot get http return code.");
				return $retCode;
			}

			// �إå��β���
			if (!$this->parseResponseHeader($line)) {
				continue;
			}
		}
		$resBodyStart += strlen(HttpsRequestSender__CRLF);
		$this->responseBody = substr($data, $resBodyStart);

		return true;
	}

	/**
	 * ���ơ������饤������
	 * (HTTP-Version SP Status-Code SP Reason-Phrase CRLF)
	 * 
	 * @param line String ���ơ������饤��
	 * @return mixed TRUE:������¾:���顼������
	 */
	function parseStatusLine($line) {

		if (StringUtil::isEmpty($line)) {
				
			// �����ʥ��ơ����������ɤ������ä�
			return PaygentB2BModuleConnectException__KS_CONNECT_ERROR;
		}

		$statusLine = StringUtil::split($line, " ", 3);

		if (StringUtil::isNumeric($statusLine[1])) {
			$this->statusCode = intVal($statusLine[1]);
		} else {
			
			// �����ʥ��ơ����������ɤ������ä�
			return PaygentB2BModuleConnectException__KS_CONNECT_ERROR;
		}

		if (strpos($statusLine[0], HttpsRequestSender__HTTP . "/") != 0 
				|| !StringUtil::isNumericLength($statusLine[1], HttpsRequestSender__REGEXPSTATUS_LEN)) {

			// �����ʥ��ơ����������ɤ������ä�
			return PaygentB2BModuleConnectException__KS_CONNECT_ERROR;
		}
		
		if (!((HttpsRequestSender__HTTP_SUCCESS <= $this->statusCode) 
			&& ($this->statusCode <= HttpsRequestSender__HTTP_PARTIAL_CONTENT))) {

			// HTTP Status �� Success Code (200 - 206) �Ǥʤ����
			return PaygentB2BModuleConnectException__KS_CONNECT_ERROR;
		}

		return true;
	}

	/**
	 * �쥹�ݥ󥹥إå����Բ��Ϥ��ơ������˳�Ǽ��<br>
	 * �쥹�ݥ󥹥إå����ͤ�¸�ߤ��ʤ����ϡ�null�����ꡣ
	 * 
	 * @param line String �����Ф��������ä��쥹�ݥ󥹹�
	 * @return boolean true=�إå����ϡ���Ǽ��λ, false=�إå��ǤϤʤ��ʥإå�����λ��
	 */
	function parseResponseHeader($line) {
		if (StringUtil::isEmpty($line)) {
			// HEADER��λ
			return false;
		}

		// HEADER
		$headerStr = StringUtil::split($line, ":", 2);
		if ($this->responseHeader == null) {
			$this->responseHeader = array();
		}

		if (count($headerStr) == 1 || strlen(trim($headerStr[1])) == 0) {
			// �ͤ�¸�ߤ��ʤ� or �ͤ���ʸ����
			$this->responseHeader[$headerStr[0]] = null;
		} else {
			$this->responseHeader[$headerStr[0]] = trim($headerStr[1]);
		}

		return true;
	}

	/**
	 * Close curl
	 * 
	 */
	function closeCurl() {
		// �ץ��������å�CLOSE
		if ($this->ch != null) {
			curl_close($this->ch);
			$this->ch = null;
		}
	}

}

?>
