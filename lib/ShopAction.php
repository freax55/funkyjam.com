<?php
require_once('DatabaseAction.php');

define('MERCHANT_ID', '15869');
define('CONNECT_ID', 'pgynt15869');
define('CONNECT_PASSWORD', '8fJrCOyVqb1NSfJ');
define('TELEGRAM_VERSION', '1.0');
set_time_limit(120);
	
class ShopAction extends DatabaseAction {

	function getNextOrderNo(){
		$row =  $this->dbRow('shop/sql/new_order_desc_no.sql');
		return $row['new_no'];
	}

	function addOrder(){
		set_error_handler(array(&$this,"catchError"));
		$this->dbBigen();
		$this->dbExec('shop/sql/lock_table.sql');
		$this->p04 = $this->getNextOrderNo();
		foreach($this->cart as $value){
			$this->item = $value;
			$this->dbExec('shop/sql/insert_order.sql');
		}
		$this->dbExec('shop/sql/insert_order_desc.sql');
		$this->dbCommit();
	}

	function deleteOrder($id){
//		$sql = "delete from order_desc
//			where order_desc_no = {$id};";

		$sql = "update order_desc set
			d_stamp = current_timestamp
			where order_desc_no={$id};";
		$this->dbQuery($sql);
		
		$sql = "delete from \"order\"
			where order_desc_no = {$id};";
		$this->dbQuery($sql);
	}

	function errorDestructor(){
		$this->deleteOrder($this->p04);
		$this->__controller->redirectToURL('index.php?action=paygent_error&' . "{$this->sname}={$this->sid}");
		exit();
	}
	function catchError($errno, $errstr, $errfile, $errline){

//		switch ($errno) {
//			case E_NOTICE:
//			case E_USER_NOTICE:
//				break;
//			case E_WARNING:
//			case E_USER_WARNING:
//			case E_ERROR:
//			case E_USER_ERROR:
//			default:
//				$this->errorDestructor();
//				break;
//        }
	}


	function saveCheckoutData($res,$id){
		if(empty($res['payment_id']))
			$sql = "update order_desc set
					trading_id='{$res['trading_id']}'
				where
					order_desc_no = {$id};";

		else
			$sql = "update order_desc set
					payment_id={$res['payment_id']},
					trading_id='{$res['trading_id']}'
				where
					order_desc_no = {$id};";
					
		$this->dbQuery($sql);
	}

	function setATMData($res){
		$this->pay_center_number = $res['pay_center_number'];
		$this->customer_number = $res['customer_number'];
		$this->conf_number = $res['conf_number'];
		$this->payment_limit_date = $res['payment_limit_date'];
	}
	
	function saveATMData($res,$id){
		$sql = "update order_desc set
				pay_center_number={$res['pay_center_number']},
				customer_number='{$res['customer_number']}',
				conf_number='{$res['conf_number']}',
				payment_limit_date='{$res['payment_limit_date']}'
			where
				order_desc_no = {$id};";

		$this->dbQuery($sql);
	}

	function setCardData($res){
		$this->issur_class = $res['issur_class'];
		$this->acq_id = $res['acq_id'];
		$this->issur_name = $res['issur_name'];
		$this->acq_name = $res['acq_name'];
		$this->fc_auth_umu = $res['fc_auth_umu'];
		$this->daiko_code = $res['daiko_code'];
		$this->card_shu_code = $res['card_shu_code'];
		$this->k_card_name = $res['k_card_name'];
		$this->out_acs_html = $res['out_acs_html'];
	}


	function setConvenienceStoreData($res){
		$this->receipt_number = $res['receipt_number'];
		$this->receipt_print_url = $res['receipt_print_url'];
		$this->usable_cvs_company_id = $res['usable_cvs_company_id'];
		$this->payment_limit_date = $res['payment_limit_date'];
	}

	function saveConvenienceStoreData($res,$id,$tel){
		$sql = "update order_desc set
				receipt_number={$res['receipt_number']},
				receipt_print_url='{$res['receipt_print_url']}',
				usable_cvs_company_id='{$res['usable_cvs_company_id']}',
				payment_limit_date='{$res['payment_limit_date']}'
			where
				order_desc_no = {$id};";

			$this->dbQuery($sql);

		$convenience_store_item = array();
		if($res['usable_cvs_company_id'] == "00C016"){
			$convenience_store_item = array(
				"お支払いコンビニ"=>"セイコーマート",
				"受付番号"=>$res["receipt_number"],
				"電話番号"=>$tel
			);
		}elseif($res['usable_cvs_company_id'] == "00C001"){
			$convenience_store_item = array(
				"お支払いコンビニ"=>"セブンイレブン",
				"払込票番号"=>$res["receipt_number"]
			);
		}elseif($res['usable_cvs_company_id'] == "00C016"){
			$convenience_store_item = array(
				"お支払いコンビニ"=>"ローソン",
				"お客様番号"=>$res["receipt_number"],
				"確認番号"=>"400008"
			);
		}elseif($res['usable_cvs_company_id'] == "00C005"){
			$convenience_store_item = array(
				"お支払いコンビニ"=>"ファミリーマート",
				"お客様番号"=>$res["receipt_number"]
			);
		}elseif($res['usable_cvs_company_id'] == "00C004"){
			$convenience_store_item = array(
				"お支払いコンビニ"=>"ミニストップ",
				"ケータイ/オンライン決済番号"=>$res["receipt_number"],
			);
		}elseif($res['usable_cvs_company_id'] == "00C007"){
			$convenience_store_item = array(
				"お支払いコンビニ"=>"サークルKサンクス",
				"ケータイ/オンライン決済番号"=>$res["receipt_number"],
			);
		}elseif($res['usable_cvs_company_id'] == "00C006"){
			$convenience_store_item = array(
				"お支払いコンビニ"=>"サークルKサンクス",
				"ケータイ/オンライン決済番号"=>$res["receipt_number"],
			);
		}elseif($res['usable_cvs_company_id'] == "00C014"){
			$convenience_store_item = array(
				"お支払いコンビニ"=>"デイリーヤマザキ",
				"ケータイ/オンライン決済番号"=>$res["receipt_number"],
			);
		}

		return $convenience_store_item;
	}


}
?>