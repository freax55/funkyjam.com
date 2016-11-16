<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/ShopAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/paygent/Paygent.php');

class Net_inputAction extends ShopAction {
	function execute() {
		$total = 0;
		foreach($this->cart as $item) {
			$total += $this->itemList[$item['item_code']]['price']*$item['quantity'];
		}

		if($_SERVER["HTTPS"])
			$protcol = "https://";
		else
			$protcol = "http://";
		$url = $protcol . $_SERVER["SERVER_NAME"];

		$p = new Paygent();
		$p->init();

		$this->addOrder();
		$trading_id = $this->p04;
		$payment_id = '';

		$params = array(
			"merchant_id" => MERCHANT_ID,
			"connect_id" => CONNECT_ID,
			"connect_password" => CONNECT_PASSWORD,
			"telegram_kind" => '',
			"telegram_version" => TELEGRAM_VERSION,
			"trading_id" => $trading_id,
			"payment_id" => $payment_id
		);
		$params['telegram_kind'] = '060';
		$params['amount'] = $total + $this->carriageTotal;
		$params['claim_kana'] = 'ﾌｱﾝｷ-ｼﾞﾔﾑｼﾖｳﾋﾝﾀﾞｲｷﾝ';
		$params['claim_kanji'] = 'ファンキージャム商品代金';
		$params['customer_family_name'] = $this->last_name;
		$params['customer_name'] = $this->first_name;
		$params['receipt_name_kana'] = 'ﾌｱﾝｷ-ｼﾞﾔﾑ';
		$params['receipt_name'] = 'ファンキージャム';
//		$params['pc_mobile_type'] = '0';

		$params['return_url'] = $url . '/shop/index.php?action=process&' . "{$this->sname}={$this->sid}";

		$params['asp_payment_term'] = '0000030';
		$params['stop_return_url'] = $url . '/shop/index.php?action=cart&' . "{$this->sname}={$this->sid}";

		$p->set($params);
		$response = $p->run();

		if($response['resultStatus'] != 0) {
			$this->deleteOrder($this->p04);
			$this->__controller->redirectToURL('index.php?action=paygent_error&' . "{$this->sname}={$this->sid}");
			return false;
		}

		foreach($response as $res) {
			if($res['result'] == 0) {
				$this->payment_id = $res['payment_id'];
				$this->trading_id = $res['trading_id'];
				$this->asp_url = $res['asp_url'];
				
				if(!empty($res)){
					$this->response = $response;
					$this->__controller->redirectToURL($this->asp_url);
					return false;	
				}

			}
		}


		return false;
	}

	function validate() {
		$this->errors = array();

		return true;
	}



}
?>