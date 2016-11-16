<?php
$path = dirname(__FILE__);
ini_set('include_path', $path . PATH_SEPARATOR . ini_get('include_path'));

class Paygent {
	var $p;

	/*
	 * 初期化
	 */
	function init() {
		include_once("jp/co/ks/merchanttool/connectmodule/entity/ResponseDataFactory.php");
		include_once("jp/co/ks/merchanttool/connectmodule/system/PaygentB2BModule.php");
		
		//以下はエラーコードを参照する場合に必要
		include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleConnectException.php");
		include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleException.php");
		
		//オブジェクト生成
		$this->p = new PaygentB2BModule();

		//初期化
		$this->p->init();
	}

	/*
	 * リクエストパラメータ設定
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
	 * リクエスト実行
	 */
	function run() {
		//リクエスト
		$result = $this->p->post();
		
		if(!($result === true)) {
			//エラーコード取得
			$errorCode = $result;
			
			//エラー処理
			$resultStatus = $this->p->getResultStatus();//処理結果 0=正常終了, 1=異常終了
			$responseCode = $this->p->getResponseCode();//異常終了時、レスポンスコードが取得できる
			$responseDetail = $this->p->getResponseDetail();//異常終了時、レスポンス詳細が取得できる

			$error = array();
			$error['resultStatus'] = $resultStatus;
			$error['responseCode'] = $responseCode;
			$error['responseDetail'] = $responseDetail;

			return $error;
		}

		//レスポンス内容取得
		$res = array();
		while($this->p->hasResNext()) {
			$res_array = $this->p->resNext();
			$res[] = $res_array;
		}

		return $res;
	}
}
?>