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
	}

	function prepare() {
		if (!$this->page) {
			$this->page = $this->__defaultPage;
		}
		if (!isset($this->amount)) {
			$this->amount = $this->__defaultAmount;
		}
	}
		
	function execute() {
		$cart = $this->cart;
		
		if (!is_array($cart)) {
			$cart = array();
		}
		
		if (!is_array($cart[$this->item_code])) {
			$item_code = $this->item_code;
			$category_code = $this->category_code;
			$quantity = $this->quantity;
			
			$cart[$item_code] = array();
			//$cart[$item_code]['item_code'] = $item_code;
			//$cart[$item_code]['category_code'] = $category_code;
			//$cart[$item_code]['quantity'] = $quantity;
			$cart[$item_code]['item_code'] = "yearsPASS";
			$cart[$item_code]['category_code'] = "yearsPASS";
			$cart[$item_code]['quantity'] = 1;

		}


		$this->status = "edit";
		$this->cart = $cart;
		$this->__controller->redirectToAction('cart');
		return false;

	}
	
	function validate() {
		
		return true;
	}
}
?>