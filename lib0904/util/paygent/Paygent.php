<?php
$path = dirname(__FILE__);
ini_set('include_path', $path . PATH_SEPARATOR . ini_get('include_path'));

class Paygent {
	var $p;

	/*
	 * �����
	 */
	function init() {
		include_once("jp/co/ks/merchanttool/connectmodule/entity/ResponseDataFactory.php");
		include_once("jp/co/ks/merchanttool/connectmodule/system/PaygentB2BModule.php");
		
		//�ʲ��ϥ��顼�����ɤ򻲾Ȥ������ɬ��
		include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleConnectException.php");
		include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleException.php");
		
		//���֥�����������
		$this->p = new PaygentB2BModule();

		//�����
		$this->p->init();
	}

	/*
	 * �ꥯ�����ȥѥ�᡼������
	 */
	function set($array = null) {
		if(!count($array)) {
			return false;
		}
		foreach($array as $key => $value) {
			$this->p->reqPut($key, mb_convert_encoding($value, "SJIS", "EUC-JP"));
		}
		return true;
	}

	/*
	 * �ꥯ�����ȼ¹�
	 */
	function run() {
		//�ꥯ������
		$result = $this->p->post();
		
		if(!($result === true)) {
			//���顼�����ɼ���
			$errorCode = $result;
			
			//���顼����
			$resultStatus = $this->p->getResultStatus();//������� 0=���ｪλ, 1=�۾ｪλ
			$responseCode = $this->p->getResponseCode();//�۾ｪλ�����쥹�ݥ󥹥����ɤ������Ǥ���
			$responseDetail = $this->p->getResponseDetail();//�۾ｪλ�����쥹�ݥ󥹾ܺ٤������Ǥ���

			$error = array();
			$error['resultStatus'] = $resultStatus;
			$error['responseCode'] = $responseCode;
			$error['responseDetail'] = $responseDetail;

			return $error;
		}

		//�쥹�ݥ����Ƽ���
		$res = array();
		while($this->p->hasResNext()) {
			$res_array = $this->p->resNext();
			$res[] = $res_array;
		}

		return $res;
	}
}
?>