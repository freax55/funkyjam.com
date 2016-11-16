<?php
/**
 * PAYGENT B2B MODULE
 * ResponseData.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleConnectException.php");
include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleException.php");

/**
 * ������ʸ�����ѥ��󥿡��ե�����
 * 
 * @version $Revision: 1.4 $
 * @author $Author: t-mori $
 */

	/**
	 * �������
	 */
	define("ResponseData__RESULT", "result");

	/**
	 * �쥹�ݥ󥹥�����
	 */
	define("ResponseData__RESPONSE_CODE", "response_code");

	/**
	 * �쥹�ݥ󥹾ܺ�
	 */
	define("ResponseData__RESPONSE_DETAIL", "response_detail");

	/**
	 * HTML����
	 */
	define("ResponseData__HTML_ITEM", "_html");



class ResponseData {

	/**
	 * ������ʸ��ʬ�򤷡��������ݻ�
	 * 
	 * @param data ������ʸ
	 * @return boolean TRUE: ������FALSE������ 
	 */
	function parse($data){}

	/**
	 * ������ʸ��ʬ�򡢽�����̡��쥹�ݥ󥹥����ɡ��쥹�ݥ󥹾ܺ٤Τ��ݻ�
	 * 
	 * @param data ������ʸ
	 * @return boolean TRUE: ������FALSE������ 
	 */
	function parseResultOnly($data){}

	/**
	 * ������̤����
	 * 
	 * @return String �������
	 */
	function getResultStatus(){}

	/**
	 * �쥹�ݥ󥹥����ɤ����
	 * 
	 * @return String �쥹�ݥ󥹥�����
	 */
	function getResponseCode(){}

	/**
	 * �쥹�ݥ󥹾ܺ٤����
	 * 
	 * @return String �쥹�ݥ󥹾ܺ�
	 */
	function getResponseDetail(){}

	/**
	 * ������ʸ��ꡢ1�쥳����ʬ����
	 * 
	 * @return Map 1�쥳����ʬ�ξ���;�ʤ���硢NULL���֤�
	 */
	function resNext(){}

	/**
	 * ���Υ쥳���ɤ�¸�ߤ��뤫Ƚ��
	 * 
	 * @return boolean Ƚ����
	 */
	function hasResNext(){}

}

?>