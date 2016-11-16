<?php
/**
 * PAYGENT B2B MODULE
 * PaygentB2BModuleConnectException.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

/*
 * ��³�⥸�塼�롡��³���顼��Exception
 *
 * @version $Revision: 1.6 $
 * @author $Author: t-mori $
 */


	define("PaygentB2BModuleConnectException__serialVersionUID", 1);

	/**
	 * �⥸�塼��ѥ�᡼�����顼
	 */
	define("PaygentB2BModuleConnectException__MODULE_PARAM_REQUIRED_ERROR", "E02001");

	/**
	 * ��ʸ�׵�ѥ�᡼�����顼
	 */
	define("PaygentB2BModuleConnectException__TEREGRAM_PARAM_REQUIRED_ERROR", "E02002");

	/**
	 * ��ʸ�׵�ѥ�᡼�����������곰���顼
	 */
	define("PaygentB2BModuleConnectException__TEREGRAM_PARAM_OUTSIDE_ERROR", "E02003");

	/**
	 * �����񥨥顼
	 */
	define("PaygentB2BModuleConnectException__CERTIFICATE_ERROR", "E02004");

	/**
	 * ��ѥ��󥿡���³���顼
	 */
	define("PaygentB2BModuleConnectException__KS_CONNECT_ERROR", "E02005");

	/**
	 * �����б����̥��顼
	 */
	define("PaygentB2BModuleConnectException__RESPONSE_TYPE_ERROR", "E02007");

 
 class PaygentB2BModuleConnectException {
 
	/** ���顼������ */
	var $errorCode = "";

	/**
	 * ���󥹥ȥ饯��
	 * 
	 * @param errorCode String
	 * @param msg String
	 */
	function PaygentB2BModuleConnectException($errCode, $msg = null) {
		$this->errorCode = $errCode;
	}

	/**
	 * ���顼�����ɤ��֤�
	 * 
	 * @return String errorCode
	 */
	function getErrorCode() {
		return $this->errorCode;
	}
	
	/**
	 * ��å��������֤�
	 * 
	 * @return String code=message
	 */
    function getLocalizedMessage() {
    }
 	
 }
  
?>
