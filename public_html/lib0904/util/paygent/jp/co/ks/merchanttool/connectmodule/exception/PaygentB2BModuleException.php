<?php
/**
 * PAYGENT B2B MODULE
 * PaygentB2BModuleException.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

/*
 * ��³�⥸�塼�롡�Ƽ泌�顼��Exception
 *
 * @version $Revision: 1.6 $
 * @author $Author: t-mori $
 */
 
	define("PaygentB2BModuleException__serialVersionUID", 1);

	/**
	 * ����ե�����ʤ����顼
	 */
	define("PaygentB2BModuleException__RESOURCE_FILE_NOT_FOUND_ERROR", "E01001");

	/**
	 * ����ե������������顼
	 */
	define("PaygentB2BModuleException__RESOURCE_FILE_REQUIRED_ERROR", "E01002");

	/**
	 * ����¾�Υ��顼
	 */
	define("PaygentB2BModuleException__OTHER_ERROR", "E01901");

	/**
	 * CSV���ϥ��顼
	 */
	define("PaygentB2BModuleException__CSV_OUTPUT_ERROR", "E01004");


 class PaygentB2BModuleException {
 	
	/** ���顼������ */
	var $errorCode = "";

	/**
	 * ���󥹥ȥ饯��
	 * 
	 * @param errorCode String
	 * @param msg String
	 */
	function PaygentB2BModuleException($errCode, $msg = null) {
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
