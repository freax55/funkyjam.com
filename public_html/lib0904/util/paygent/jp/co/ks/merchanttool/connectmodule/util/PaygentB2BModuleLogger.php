<?php
/**
 * PAYGENT B2B MODULE
 * PaygentB2BModuleLogger.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

include_once("jp/co/ks/merchanttool/connectmodule/system/PaygentB2BModuleResources.php");

/**
 * ��³�⥸�塼���� Logger ���饹
 * 
 * @version $Revision: 1.6 $
 * @author $Author: t-mori $
 */

class PaygentB2BModuleLogger {

	/** FileAppender �ݻ� */
	var $filename = null;

	/**
	 * ���󥹥ȥ饯��
	 */
	function PaygentB2BModuleLogger() {
		$inst = PaygentB2BModuleResources::getInstance();
		if (is_object($inst) && 
			!StringUtil::isEmpty($inst->getLogOutputPath())) {
			$this->filename = $inst->getLogOutputPath();
		}
	}
	
	/**
	 * PaygentB2BModuleLogger �����
	 * 
	 * @return PaygentB2BModuleLogger
	 */
	function &getInstance() {
		static $logInstance = null;		
		if (isset($logInstance) == false
			|| $logInstance == null
			|| is_object($logInstance) != true) {

			$logInstance = new PaygentB2BModuleLogger();
		}
		return $logInstance;
	}

	/**
	 * �ǥХå��������
	 * 
	 * @param className String ���ν��ϸ����饹̾ ���ϸ�����
	 * @param message Object ����å�����
	 */
	function debug($className, $message) {
		if(is_null($this->filename) == false && $this->filename != "") {
			if(! $handle = fopen( $this->filename, 'a')) {
				// �ե����뤬�����ʤ�
				trigger_error(PaygentB2BModuleException__OTHER_ERROR. ":File doesn't open.(".$this->filename.").", E_USER_WARNING);
				return;
			}
			if(! fwrite($handle, $this->outputMsg($message, $className))) {
				// �ե�����˽񤭹���ʤ�
				trigger_error(PaygentB2BModuleException__OTHER_ERROR. ":It is not possible to write it in the file(".$this->filename.").", E_USER_WARNING);
				return;
			}
			fclose($handle);
		}
	}
	
	/**
	 * ���ϥ�å���������������
	 * 
	 * @param message ����å�����
	 * @param className ���饹̾
	 * @return ������Υ�å�����
	 */
	function outputMsg($message, $className) {
		return date("Y/m/d H:i:s")." $className ".$message."\n";
	}
}

?>
