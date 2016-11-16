<?php
/**
 * PAYGENT B2B MODULE
 * PaymentResponseDataImpl.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleConnectException.php");
include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleException.php");
include_once("jp/co/ks/merchanttool/connectmodule/util/HttpsRequestSender.php");
include_once("jp/co/ks/merchanttool/connectmodule/util/StringUtil.php");
include_once("jp/co/ks/merchanttool/connectmodule/entity/ResponseData.php");

/**
 * ��ѷϱ�����ʸ�������饹
 * 
 * @version $Revision: 1.4 $
 * @author $Author: t-mori $
 */

	/**
	 * ������ʸ�Ѷ��ڤ�ʸ��
	 */
	define("PaymentResponseDataImpl__PROPERTIES_REGEX", "=");
	
	/**
	 * ������ʸ�Ѷ��ڤ�� 
	 */
	define("PaymentResponseDataImpl__PROPERTIES_REGEX_COUNT", 2);
	
	/**
	 * ����ʸ��
	 */
	define("PaymentResponseDataImpl__LINE_SEPARATOR", "\r\n");


class PaymentResponseDataImpl extends ResponseData {

	/** ������� ʸ����*/
	var $resultStatus;

	/** �쥹�ݥ󥹥����� ʸ����*/
	var $responseCode;

	/** �쥹�ݥ󥹾ܺ� */
	var $responseDetail;

	/** �ǡ��� array*/
	var $data;

	/** ���ߤ�Index */
	var $currentIndex;

	/**
	 * ���󥹥ȥ饯��
	 */
	function PaymentResponseDataImpl() {
		$this->data = array();
		$this->currentIndex = 0;
	}

	/**
	 * body ��ʬ��
	 * 
	 * @param �쥹�ݥ󥹥ܥǥ�
	 * @return boolean TRUE: ������¾�����顼������ 
	 */
	function parse($body) {

		$line = "";
		// �ݻ��ǡ���������
		$this->data = array();
		$map = array();

		// ���߰��֤�����
		$this->currentIndex = 0;
		
		// �ꥶ��Ⱦ���ν����
		$this->resultStatus = "";
		$this->responseCode = "";
		$this->responseDetail = "";
		
		// "_html" ����¸�ߥե饰
		$htmlKeyFlg = false;
		
		// "_htmk" ������
		$htmlKey = "";
		
		// "_html" �����и��ʸ�Υǡ����ݻ�
		$htmlValue = "";

		$lines = split(PaymentResponseDataImpl__LINE_SEPARATOR, $body);
		foreach($lines as $i => $line) {
			$lineItem = StringUtil::split($line, PaymentResponseDataImpl__PROPERTIES_REGEX, 
				PaymentResponseDataImpl__PROPERTIES_REGEX_COUNT);
			// �ɹ���λ
			$tmpLen = strlen($lineItem[0]) - strlen(ResponseData__HTML_ITEM);
			if ($tmpLen >= 0 
				&&  strpos($lineItem[0], ResponseData__HTML_ITEM, $tmpLen) 
				=== $tmpLen) {
				// Key �� "_html" �ξ��
				$htmlKey = $lineItem[0];
				$htmlKeyFlg = true;
			}
			if ($htmlKeyFlg) {
				if (!(strlen($lineItem[0]) - strlen(ResponseData__HTML_ITEM) >= 0 
					&& strpos($lineItem[0], ResponseData__HTML_ITEM,
						strlen($lineItem[0]) - strlen(ResponseData__HTML_ITEM)) 
					=== strlen($lineItem[0]) - strlen(ResponseData__HTML_ITEM))) {
					// "_html" Key ���ɤ߼��줿���
					$htmlValue .= $line;
					$htmlValue .= PaymentResponseDataImpl__LINE_SEPARATOR;
				}
			} else {
				if (0 < count($lineItem)) {
					if ($lineItem[0] == ResponseData__RESULT) {
						// ������̤�����
						$this->resultStatus = $lineItem[1];
					} else if ($lineItem[0] == ResponseData__RESPONSE_CODE) {
						// �쥹�ݥ󥹥����ɤ�����
						$this->responseCode = $lineItem[1];
					} else if ($lineItem[0] == ResponseData__RESPONSE_DETAIL) {
						// �쥹�ݥ󥹾ܺ٤�����
						$this->responseDetail = $lineItem[1];
					} else {
						// Map������
						$map[$lineItem[0]] = $lineItem[1];
					}
				}
			}
		}
		
		if ($htmlKeyFlg) {
			// "_html" Key ���и�������硢����
			if (strlen(PaymentResponseDataImpl__LINE_SEPARATOR) <= strlen($htmlValue)) {
				if (strpos($htmlValue, PaymentResponseDataImpl__LINE_SEPARATOR,
						strlen($htmlValue) - strlen(PaymentResponseDataImpl__LINE_SEPARATOR)) 
					=== strlen($htmlValue) - strlen(PaymentResponseDataImpl__LINE_SEPARATOR)) {
					$htmlValue = substr($htmlValue, 0, 
						strlen($htmlValue) - strlen(PaymentResponseDataImpl__LINE_SEPARATOR));
				}
			}
			$map[$htmlKey] = $htmlValue;
		}

		if (0 < count($map)) {
			// Map �����ꤵ��Ƥ�����
			$this->data[] = $map;
		}

		if (StringUtil::isEmpty($this->resultStatus)) {
			// ������̤� ��ʸ�� �⤷���� null �ξ��
			trigger_error(PaygentB2BModuleConnectException__KS_CONNECT_ERROR
			. ": resultStatus is Nothing.", E_USER_WARNING);
			return PaygentB2BModuleConnectException__KS_CONNECT_ERROR;
		}
		
		return true;
	}

	/**
	 * data ��ʬ�� �ꥶ��Ⱦ���Τߡ��ѿ���ȿ��
	 * 
	 * @param data
	 * @return boolean TRUE: ������FALSE������ 
	 */
	function parseResultOnly($body) {

		$line = "";

		// �ݻ��ǡ���������
		$this->data = array();

		// ���߰��֤�����
		$this->currentIndex = 0;
		
		// �ꥶ��Ⱦ���ν����
		$this->resultStatus = "";
		$this->responseCode = "";
		$this->responseDetail = "";

		$lines = split(PaymentResponseDataImpl__LINE_SEPARATOR, $body);
		foreach($lines as $i => $line) {
			$lineItem = StringUtil::split($line, PaymentResponseDataImpl__PROPERTIES_REGEX);
			// �ɹ���λ
			if (strpos($lineItem[0], ResponseData__HTML_ITEM) 
				=== strlen($lineItem[0]) - strlen(ResponseData__HTML_ITEM)) {
				// Key �� "_html" �ξ��
				break;
			}

			if (0 < count($lineItem)) {
				// 1�Ԥ����ɹ�(���ܿ���2�ʾ�ξ��)
				if ($lineItem[0] == ResponseData__RESULT) {
					// ������̤�����
					$this->resultStatus = $lineItem[1];
				} else if ($lineItem[0] == ResponseData__RESPONSE_CODE) {
					// �쥹�ݥ󥹥����ɤ�����
					$this->responseCode = $lineItem[1];
				} else if ($lineItem[0] == ResponseData__RESPONSE_DETAIL) {
					// �쥹�ݥ󥹾ܺ٤�����
					$this->responseDetail = $lineItem[1];
				}
			}
		}
		
		if (StringUtil::isEmpty($this->resultStatus)) {
			// ������̤� ��ʸ�� �⤷���� null �ξ��
			trigger_error(PaygentB2BModuleConnectException__KS_CONNECT_ERROR
				. ": resultStatus is Nothing.", E_USER_WARNING);
			return PaygentB2BModuleConnectException__KS_CONNECT_ERROR;
		}
		return true;
	}

	/**
	 * ���Υǡ��������
	 * 
	 * @return Map �ǡ������ʤ���硢NULL���᤹
	 */
	function resNext() {
		$map = null;

		if ($this->hasResNext()) {

			$map =$this->data[$this->currentIndex];

			$this->currentIndex++;
		} 
		
		return $map;
	}

	/**
	 * ���Υǡ�����¸�ߤ��뤫Ƚ��
	 * 
	 * @return boolean true=¸�ߤ��� false=¸�ߤ��ʤ�
	 */
	function hasResNext() {
		$rb = false;

		if ($this->currentIndex < count($this->data)) {
			$rb = true;
		}

		return $rb;
	}

	/**
	 * resultStatus �����
	 * 
	 * @return String
	 */
	function getResultStatus() {
		return $this->resultStatus;
	}

	/**
	 * responseCode �����
	 * 
	 * @return String
	 */
	function getResponseCode() {
		return $this->responseCode;
	}

	/**
	 * responseDetail �����
	 * 
	 * @return String
	 */
	function getResponseDetail() {
		return $this->responseDetail;
	}

}

?>