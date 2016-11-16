<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/Paginate.php');

class Action extends DatabaseAction {
	var $__defaultPage = null;
	var $__defaultAmount = null;
	var $__defaultPageAmount = null;

	function init() {
		DatabaseAction::init();
	
		$this->__defaultPage = 1;
		$this->__defaultAmount = 20;
		$this->__defaultPageAmount = 5;
		$this->_tourGoodsCode = 'A013';
	}

	function prepare() {
		if (!$this->page) {
			$this->page = $this->__defaultPage;
		}
		if (!isset($this->amount)) {
			$this->amount = $this->__defaultAmount;
		}
		
		$this->member_no = mb_convert_kana($this->member_no, 'n', 'EUC-JP');
		$this->zip1 = mb_convert_kana($this->zip1, 'n', 'EUC-JP');
		$this->zip2 = mb_convert_kana($this->zip2, 'n', 'EUC-JP');
		$this->tel1 = mb_convert_kana($this->tel1, 'n', 'EUC-JP');
		$this->tel2 = mb_convert_kana($this->tel2, 'n', 'EUC-JP');
		$this->tel3 = mb_convert_kana($this->tel3, 'n', 'EUC-JP');

		$this->errors = null;
		
		$this->defaultMessages = array(
			'emp' => '入力をお願いします。',
			'empS' => '選択をお願いします。',
			'cmp' => '確認入力と一致していません。入力をご確認ください。',
			'fom' => '形式をご確認ください。'
		);
	}
		
	function execute() {
		unset($this->flgTour);
		unset($this->flgNormal);

		foreach($this->cart as $item) {
			if($item['category_code'] == $this->_tourGoodsCode) {
				$this->flgTour = 1;
			} else {
				$this->flgNormal = 1;
			}
 		}

		if ($this->payment == '代金引換') {
			if($this->flgTour == 1) {
				$this->carriageTour = 1000;
			} else {
				$this->carriageTour = 0;
			}
			if($this->flgNormal == 1) {
				$this->carriage = 1000;
			} else {
				$this->carriage = 0;
			}
		}
		elseif ($this->payment == '郵便振替') {
			if($this->flgTour == 1) {
				$this->carriageTour = 700;
			} else {
				$this->carriageTour = 0;
			}
			if($this->flgNormal == 1) {
				$this->carriage = 700;
			} else {
				$this->carriage = 0;
			}
		}
		elseif($this->payment == 'クレジットカード') {
			if($this->flgTour == 1) {
				$this->carriageTour = 800;
			} else {
				$this->carriageTour = 0;
			}
			if($this->flgNormal == 1) {
				$this->carriage = 800;
			} else {
				$this->carriage = 0;
			}
		}
		// elseif ($this->payment == 'コンビニ決済') {
		// 	$this->paygentCarriage = 0;

		// 	if($this->flgTour == 1) {
		// 		$this->carriageTour = 700;
				
		// 		if($this->total + $this->carriageTour >= 10000) {
		// 			$this->carriageTour += 240;
		// 			$this->paygentFee = 240;
		// 		} else {
		// 			$this->carriageTour += 200;
		// 			$this->paygentFee = 200;
		// 		}
		// 	} else {
		// 		$this->carriageTour = 0;
		// 	}
		// 	if($this->flgNormal == 1) {
		// 		$this->carriage = 700;
		// 		if($this->total + $this->carriage >= 10000) {
		// 			$this->carriage += 240;
		// 			$this->paygentFee = 240;
		// 		} else {
		// 			$this->carriage += 200;
		// 			$this->paygentFee = 200;
		// 		}
		// 	} else {
		// 		$this->carriage = 0;
		// 	}
		// }
		elseif ($this->payment == 'カード決済（ペイジェント）') {
			if($this->flgTour == 1) {
				$this->carriageTour = 0;
			} else {
				$this->carriageTour = 0;
			}
			if($this->flgNormal == 1) {
				$this->carriage = 0;
			} else {
				$this->carriage = 0;
			}
		}
		elseif ($this->payment == 'ATM決済') {
			$this->paygentCarriage = 700;

			if($this->flgTour == 1) {
				$this->carriageTour = 700;
				if($this->total + $this->carriageTour >= 10000) {
					$this->carriageTour += 240;
					$this->paygentFee = 240;
				} else {
					$this->carriageTour += 200;
					$this->paygentFee = 200;
			}
			} else {
				$this->carriageTour = 0;
			}
			if($this->flgNormal == 1) {
				$this->carriage = 700;
				if($this->total + $this->carriage >= 10000) {
					$this->carriage += 240;
					$this->paygentFee = 240;
				} else {
					$this->carriage += 200;
					$this->paygentFee = 200;
				}
			} else {
				$this->carriage = 0;
			}

		}
		else if ($this->payment == '銀行ネット決済') {
			$this->paygentCarriage = 700;

			if($this->flgTour == 1) {
				$this->carriageTour = 700;
				if($this->total + $this->carriageTour >= 10000) {
					$this->carriageTour += 240;
					$this->paygentFee = 240;
				} else {
					$this->carriageTour += 200;
					$this->paygentFee = 200;
				}
			} else {
				$this->carriageTour = 0;
			}
			if($this->flgNormal == 1) {
				$this->carriage = 700;
				if($this->total + $this->carriage >= 10000) {
					$this->carriage += 240;
					$this->paygentFee = 240;
				} else {
					$this->carriage += 200;
					$this->paygentFee = 200;
				}
			} else {
				$this->carriage = 0;
			}
		}

		$this->carriageTotal = $this->carriage + $this->carriageTour;

		$convenience_stores = $this->dbTable("convenience_store", "convenience_store_no","convenience_store_no");

		$this->units = array(
			"convenience_stores" => $convenience_stores
		);



		$this->valid_term_month = array();
		for($i = 0; $i < 12; $i++) {
			$this->valid_term_month[] = sprintf('%02d', $i + 1);
		}

		$this->valid_term_year = array();
		$year = date('y');
		for($i = 0; $i < 15; $i++) {
			$this->valid_term_year[] =  sprintf('%02d', $year + $i);
		}
	}

	function validate() {
		$cart = $this->cart;

		$d =& $this->defaultMessages;
		$this->errors = array();
		
		$e =& $this->errors;
		
		if($this->flg == "edit"){
			$key = 'no';
			if(empty($this->$key)){
				$e[$key] = $d['emp'];
			}elseif(!$this->isNumber($this->$key)){
				$e[$key] = $d['fom'];
			}elseif(mb_strlen($this->$key)!=8){
				$e[$key] = "8桁の入力をお願いします。";
			}
		}

		$key = 'last_name';
		if(empty($this->$key)){
			$e['name'] = $d['emp'];
		}
		$key = 'first_name';
		if(empty($this->$key)){
			$e['name'] = $d['emp'];
		}
		


		$key = 'last_name_kana';
		$key2 = 'first_name_kana';
		if(empty($this->$key) || empty($this->$key2)){
			$e['kana'] = $d['emp'];
		}elseif(!$this->isKatakana($this->$key.$this->$key2)){
			$e['kana'] = "カタカナで入力をお願いします。";
		}

		$key = 'zip1';
		$key2 = 'zip2';
		if(empty($this->$key) || empty($this->$key2)){
			$e['zip'] = $d['emp'];
		}elseif(!$this->isZip($this->$key.$this->$key2)){
			$e['zip'] = $d['fom'];
		}

		$key = 'address1';
		if(empty($this->$key)){
			$e[$key] = $d['empS'];
		}

		$key = 'address2';
		if(empty($this->$key)){
			$e[$key] = $d['emp'];
		}

		$key = 'tel';
		$key2 = 'tel2';
		if(empty($this->$key) && empty($this->$key2)){
			$e[$key] = "電話番号は「自宅」もしくは「携帯」のどちらか入力をお願いします。";
			$e[$key2] = "電話番号は「携帯」もしくは「自宅」のどちらか入力をお願いします。";
		}else{
			if(!$this->isTel($this->$key) && !empty($this->$key)){
				$e[$key] = $d['fom'];
			}
			if(!$this->isTel($this->$key2) && !empty($this->$key2)){
				$e[$key2] = $d['fom'];
			}
		}
		
		$key = 'mail';
		$key2 = 'mail2';
		if(empty($this->$key)){
			$e[$key] = $d['emp'];
		}elseif(!$this->isMail($this->$key)){
			$e[$key] = $d['fom'];
		}

		if(empty($this->$key2)){
			$e[$key.'2'] = $d['emp'];
		}elseif(!$this->isMail($this->$key2)){
			$e[$key.'2'] = $d['fom'];
		}elseif($this->$key2 != $this->$key){
			$e[$key] = $d['cmp'];
		}


		if($this->flg == "input"){

			$key = 'sex';
			if(empty($this->$key)){
				$e[$key] = $d['empS'];
			}

			$key = "birth1";
			if(empty($this->$key)){
				$e["birth"] = $d['empS'];
			}

			$key = "birth2";
			if(empty($this->$key)){
				$e["birth"] = $d['empS'];
			}

			$key = "birth3";
			if(empty($this->$key)){
				$e["birth"] = $d['empS'];
			}

		}




		if (count($this->errors)) {
			return 'cart';
		}

		return true;
	}
}

?>