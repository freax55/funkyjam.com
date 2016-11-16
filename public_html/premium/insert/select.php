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

		if ($this->payment == '����ӥ˷��') {
			$this->paygentCarriage = 0;

			if($this->flgTour == 1) {
				$this->carriageTour = 0;
				
				if($this->total + $this->carriageTour >= 10000) {
					$this->carriageTour += 0;
					$this->paygentFee = 250;
				} else {
					$this->carriageTour += 0;
					$this->paygentFee = 250;
				}
			} else {
				$this->carriageTour = 0;
			}
			if($this->flgNormal == 1) {
				$this->carriage = 0;
				if($this->total + $this->carriage >= 10000) {
					$this->carriage += 0;
					$this->paygentFee = 250;
				} else {
					$this->carriage += 0;
					$this->paygentFee = 250;
				}
			} else {
				$this->carriage = 0;
			}
		}
		elseif ($this->payment == '�����ɷ�ѡʥڥ�������ȡ�') {
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
}

?>