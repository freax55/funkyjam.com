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
}

?>