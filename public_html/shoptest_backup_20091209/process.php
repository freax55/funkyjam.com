<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/paygent/Paygent.php');

class Action extends DatabaseAction {
	function execute() {
		$p = new Paygent();
		$p->init();

		define('MERCHANT_ID', '16660');
		define('CONNECT_ID', 'funkyjamtest');
		define('CONNECT_PASSWORD', '8xSFTf28nU5xfNb6');
		define('TELEGRAM_VERSION', '1.0');
		
		/*
		 * telegram_kindについては
		 * 電文種別を表す3桁の数字を渡す
		 * 
		 * 010：ATM決済申込
		 * 020：カード決済オーソリ
		 * 021：カード決済オーソリキャンセル
		 * 022：カード決済売上
		 * 023：カード決済売上キャンセル
		 * 024：カード決済3Dオーソリ
		 * 028：カード決済オーソリ減額
		 * 029：カード決済売上減額
		 * 025：カート情報設定電文
		 * 026：カート情報削除電文
		 * 027：カート情報照会電文
		 * 030：コンビニ決済(番号方式)申込
		 * 040：コンビニ決済(払込票方式)申込
		 * 050：銀行ネット決済申込
		 * 060：銀行ネット決済ASP
         * 070：仮想口座決済
         * 091：決済情報差分照会
         */
		$telegram_kind = '010';
		$trading_id = '';
		$payment_id = '';
		
		$params = array(
			"merchant_id"=>MERCHANT_ID,
			"connect_id"=>CONNECT_ID,
			"connect_password"=>CONNECT_PASSWORD,
			"telegram_kind"=>$telegram_kind,
			"telegram_version"=>TELEGRAM_VERSION,
			"trading_id"=>$trading_id,
			"payment_id"=>$payment_id
		);

		$params['payment_amount'] = '2000';
		$params['payment_detail'] = 'ファンキージャム商品代金';
		$params['payment_detail_kana'] = 'ﾌｱﾝｷ-ｼﾞﾔﾑｼﾖｳﾋﾝﾀﾞｲｷﾝ';

		$p->set($params);
		
		$res = $p->run();
		echo '<pre>';
		var_dump($res);
		echo '</pre>';
		$this->payment_id = $res['payment_id'];
		$this->trading_id = $res['trading_id'];
		$this->pay_center_number = $res['pay_center_number'];
		$this->customer_number = $res['customer_number'];
		$this->conf_number = $res['conf_number'];
		$this->payment_limit_date = $res['payment_limit_date'];

		exit();
		
		$this->__controller->redirectToAction('complete');

		return false;
	}
}
?>