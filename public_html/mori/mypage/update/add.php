<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/Paginate.php');

class Action extends DatabaseAction {
	function init() {
		DatabaseAction::init();
	}

	function prepare() {
	}
		
	function execute() {
		$cart = $this->cart;
		
		if (!is_array($cart)) {
			$cart = array();
		}
		
		if (!is_array($cart[$this->item_code])) {
			//直接アイテム情報を記載
			$cart[$item_code] = array();
			$cart[$item_code]['item_code'] = "moriYearsPass";
			$cart[$item_code]['category_code'] = "moriYearsPass";
			$cart[$item_code]['quantity'] = 1;

		}

		$this->status = "";
		$this->cart = $cart;
		$this->__controller->redirectToAction('cart');
		return false;

	}
	
	function validate() {
		
		return true;
	}
}
?>