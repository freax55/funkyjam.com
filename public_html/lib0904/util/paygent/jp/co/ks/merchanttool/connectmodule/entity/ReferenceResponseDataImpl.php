<?php
/**
 * PAYGENT B2B MODULE
 * ReferenceResponseDataImpl.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleConnectException.php");
include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleException.php");
include_once("jp/co/ks/merchanttool/connectmodule/util/CSVWriter.php");
include_once("jp/co/ks/merchanttool/connectmodule/util/CSVTokenizer.php");
include_once("jp/co/ks/merchanttool/connectmodule/util/HttpsRequestSender.php");
include_once("jp/co/ks/merchanttool/connectmodule/util/StringUtil.php");
include_once("jp/co/ks/merchanttool/connectmodule/entity/ResponseData.php");

/**
 * �Ȳ�ϱ�����ʸ�������饹
 * 
 * @version $Revision: 1.4 $
 * @author $Author: t-mori $
 */


	/**
	 * ���ֹ�ʥإå�������= "1"
	 */
	define("ReferenceResponseDataImpl__LINENO_HEADER", "1");

	/**
	 * ���ֹ�ʥǡ����إå�������", "2"
	 */
	define("ReferenceResponseDataImpl__LINENO_DATA_HEADER", "2");

	/**
	 * ���ֹ�ʥǡ�������", "3"
	 */
	define("ReferenceResponseDataImpl__LINENO_DATA", "3");

	/**
	 * ���ֹ�ʥȥ졼�顼����", "4"
	 */
	define("ReferenceResponseDataImpl__LINENO_TRAILER", "4");

	/**
	 * �쥳���ɶ�ʬ ����", 0
	 */
	define("ReferenceResponseDataImpl__LINE_RECORD_DIVISION", 0);

	/**
	 * �إå����� ������� ���� 1
	 */
	define("ReferenceResponseDataImpl__LINE_HEADER_RESULT", 1);

	/**
	 * �إå����� �쥹�ݥ󥹥����� ����", 2
	 */
	define("ReferenceResponseDataImpl__LINE_HEADER_RESPONSE_CODE", 2);

	/**
	 * �إå����� �쥹�ݥ󥹾ܺ� ����", 3
	 */
	define("ReferenceResponseDataImpl__LINE_HEADER_RESPONSE_DETAIL", 3);

	/**
	 * �ȥ졼�顼�� �ǡ������ ����", 1
	 */
	define("ReferenceResponseDataImpl__LINE_TRAILER_DATA_COUNT", 1);

	/**
	 * ����ʸ��
	 */
	define("ReferenceResponseDataImpl__LINE_SEPARATOR", "\r\n");

class ReferenceResponseDataImpl extends ResponseData {
	/** ������� */
	var $resultStatus;

	/** �쥹�ݥ󥹥����� */
	var $responseCode;

	/** �쥹�ݥ󥹾ܺ� */
	var $responseDetail;

	/** �ǡ����إå��� */
	var $dataHeader;

	/** �ǡ��� */
	var $data;

	/** ���ߤ�Index */
	var $currentIndex;

	/**
	 * ���󥹥ȥ饯��
	 */
	function ReferenceResponseDataImpl() {
		$this->dataHeader = array();
		$this->data = array();
		$this->currentIndex = 0;
	}

	/**
	 * data ��ʬ��
	 * 
	 * @param data
	 * @return mixed TRUE:������¾�����顼������ 
	 */
	function parse($body) {

		$csvTknzr = new CSVTokenizer(CSVTokenizer__DEF_SEPARATOR, 
			CSVTokenizer__DEF_ITEM_ENVELOPE);

		// �ݻ��ǡ���������
		$this->data = array();

		// ���߰��֤�����
		$this->currentIndex = 0;
		
		// �ꥶ��Ⱦ���ν����
		$this->resultStatus = "";
		$this->responseCode = "";
		$this->responseDetail = "";

		$lines = split(ReferenceResponseDataImpl__LINE_SEPARATOR, $body);
		foreach($lines as $i => $line) {
			$lineItem = $csvTknzr->parseCSVData($line);

			if (0 < count($lineItem)) {
				if ($lineItem[ReferenceResponseDataImpl__LINE_RECORD_DIVISION]
						== ReferenceResponseDataImpl__LINENO_HEADER) {
					// �إå������ιԤξ��
					if (ReferenceResponseDataImpl__LINE_HEADER_RESULT < count($lineItem)) {
						// ������̤�����
						$this->resultStatus = $lineItem[ReferenceResponseDataImpl__LINE_HEADER_RESULT];
					}
					if (ReferenceResponseDataImpl__LINE_HEADER_RESPONSE_CODE < count($lineItem)) {
						// �쥹�ݥ󥹥����ɤ�����
						$this->responseCode = $lineItem[ReferenceResponseDataImpl__LINE_HEADER_RESPONSE_CODE];
					}
					if (ReferenceResponseDataImpl__LINE_HEADER_RESPONSE_DETAIL < count($lineItem)) {
						// �쥹�ݥ󥹾ܺ٤�����
						$this->responseDetail = $lineItem[ReferenceResponseDataImpl__LINE_HEADER_RESPONSE_DETAIL];
					}
				} else if ($lineItem[ReferenceResponseDataImpl__LINE_RECORD_DIVISION]
						== ReferenceResponseDataImpl__LINENO_DATA_HEADER) {
					// �ǡ����إå������ιԤξ��
					$this->dataHeader = array();

					for ($i = 1; $i < count($lineItem); $i++) {
						// �ǡ����إå���������ʥ쥳���ɶ�ʬ�Ͻ�����
						$this->dataHeader[] = $lineItem[$i];
					}
				} else if ($lineItem[ReferenceResponseDataImpl__LINE_RECORD_DIVISION]
						== ReferenceResponseDataImpl__LINENO_DATA) {
					// �ǡ������ιԤξ��
					// �ǡ����إå�����������Ÿ���ѤߤǤ����������
					$map = array();

					if (count($this->dataHeader) == (count($lineItem) - 1)) {
						// �ǡ����إå������ȡ��ǡ������ܿ��ʥ쥳���ɶ�ʬ�����ˤϰ���
						for ($i = 1; $i < count($lineItem); $i++) {
							// �б�����ǡ����إå����� Key �ˡ�Map������
							$map[$this->dataHeader[$i - 1]] = $lineItem[$i];
						}
					} else {
						// �ǡ����إå������ȡ��ǡ������ܿ������פ��ʤ����
						$sb = PaygentB2BModuleException__OTHER_ERROR . ": ";
						$sb .= "Not Mutch DataHeaderCount=";
						$sb .= "" . count($this->dataHeader);
						$sb .= " DataItemCount:";
						$sb .= "" . (count($lineItem) - 1);
						trigger_error($sb, E_USER_WARNING);
						return PaygentB2BModuleException__OTHER_ERROR;
					}

					if (0 < count($map)) {
						// Map �����ꤵ��Ƥ�����
						$this->data[] = $map;
					}
				} else if ($lineItem[ReferenceResponseDataImpl__LINE_RECORD_DIVISION]
						== ReferenceResponseDataImpl__LINENO_TRAILER) {
					// �ȥ졼�顼���ιԤξ��
					if (ReferenceResponseDataImpl__LINE_TRAILER_DATA_COUNT < count($lineItem)) {
						// �ǡ���������
					}
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
	 * data ��ʬ�� �ꥶ��Ⱦ���Τߡ��ѿ�������
	 * 
	 * @param body
	 * @return mixed TRUE:������¾�����顼������ 
	 */
	function parseResultOnly($body) {

		$csvTknzr = new CSVTokenizer(CSVTokenizer__DEF_SEPARATOR, 
			CSVTokenizer__DEF_ITEM_ENVELOPE);
		$line = "";

		// �ݻ��ǡ���������
		$this->data = array();

		// ���߰��֤�����
		$this->currentIndex = 0;
		
		// �ꥶ��Ⱦ���ν����
		$this->resultStatus = "";
		$this->responseCode = "";
		$this->responseDetail = "";

		$lines = split(ReferenceResponseDataImpl__LINE_SEPARATOR, $body);
		foreach($lines as $i => $line) {
			$lineItem = $csvTknzr->parseCSVData($line);

			if (0 < count($lineItem)) {
				if ($lineItem[ReferenceResponseDataImpl__LINE_RECORD_DIVISION]
						== ReferenceResponseDataImpl__LINENO_HEADER) {
					// �إå������ιԤξ��
					if (ReferenceResponseDataImpl__LINE_HEADER_RESULT < count($lineItem)) {
						// ������̤�����
						$this->resultStatus = $lineItem[ReferenceResponseDataImpl__LINE_HEADER_RESULT];
					}
					if (ReferenceResponseDataImpl__LINE_HEADER_RESPONSE_CODE < count($lineItem)) {
						// �쥹�ݥ󥹥����ɤ�����
						$this->responseCode = $lineItem[ReferenceResponseDataImpl__LINE_HEADER_RESPONSE_CODE];
					}
					if (ReferenceResponseDataImpl__LINE_HEADER_RESPONSE_DETAIL < count($lineItem)) {
						// �쥹�ݥ󥹾ܺ٤�����
						$this->responseDetail = $lineItem[ReferenceResponseDataImpl__LINE_HEADER_RESPONSE_DETAIL];
					}
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
	 * @return Map
	 */
	function resNext() {
		$map = null;

		if ($this->hasResNext()) {

			$map = $this->data[$this->currentIndex];

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

	/**
	 * �ǡ�����������
	 * 
	 * @param data InputStream
	 * @return int -1:���顼 
	 */
	function getDataCount($body) {
		$ri = 0;
		$strCnt = null;
		
		$csvTknzr = new CSVTokenizer(CSVTokenizer__DEF_SEPARATOR, 
			CSVTokenizer__DEF_ITEM_ENVELOPE);
		$line = "";

		$lines = split(ReferenceResponseDataImpl__LINE_SEPARATOR, $body);
		foreach($lines as $i => $line) {
			$lineItem = $csvTknzr->parseCSVData($line);

			if (0 < count($lineItem)) {
				if ($lineItem[ReferenceResponseDataImpl__LINE_RECORD_DIVISION]
						== ReferenceResponseDataImpl__LINENO_TRAILER) {
					// �ȥ졼�顼���ιԤξ��
					if (ReferenceResponseDataImpl__LINE_TRAILER_DATA_COUNT < count($lineItem)) {
						// �ǡ����������� while����ȴ����
						if (StringUtil::isNumeric($lineItem[ReferenceResponseDataImpl__LINE_TRAILER_DATA_COUNT])) {
							$strCnt = $lineItem[ReferenceResponseDataImpl__LINE_TRAILER_DATA_COUNT];
						}
						break;
					}
				}
			}
		}

		if ($strCnt != null && StringUtil::isNumeric($strCnt)) {
			$ri = intval($strCnt);
		} else {
			return PaygentB2BModuleException__OTHER_ERROR;		//���顼
		}

		return $ri;
	}

	/**
	 * CSV �����
	 * 
	 * @param resBody
	 * @param resultCsv String
	 * @return boolean true��������¾�����顼������
	 */
	function writeCSV($body, $resultCsv) {
		$rb = false;

		// CSV �� 1�Ԥ��Ľ���
		$csvWriter = new CSVWriter($resultCsv);
		if ($csvWriter->open() === false) {
			// �ե����륪���֥󥨥顼
			trigger_error(PaygentB2BModuleException__CSV_OUTPUT_ERROR
				. ": Failed to open CSV file.", E_USER_WARNING);
			return PaygentB2BModuleException__CSV_OUTPUT_ERROR;
		}

		$lines = split(ReferenceResponseDataImpl__LINE_SEPARATOR, $body);
		foreach($lines as $i => $line) {
			if (!$csvWriter->writeOneLine($line)) {
				// �񤭹���ʤ��ä����
				trigger_error(PaygentB2BModuleException__CSV_OUTPUT_ERROR
					. ": Failed to write to CSV file.", E_USER_WARNING);
				return PaygentB2BModuleException__CSV_OUTPUT_ERROR;
			}
		}

		$csvWriter->close();

		$rb = true;

		return $rb;
	}

}

?>