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
		if ($this->item_code) {
			$this->item_code = null;
		}
	}
		
	function execute() {
		$db =& $this->_db;

		//item
		//$result = $db->statement('premium/insert/sql/item_list.sql');
		//$tree = $db->buildTree($result, 'item_code');
		
		$trees = array();
		$trees[yearsPASS][item_code]="yearsPASS";
		$trees[yearsPASS][name]="年間パス";
		$trees[yearsPASS][category_code]="yearsPASS";
		$trees[yearsPASS][color]=NULL;
		$trees[yearsPASS][size]=NULL;
		$trees[yearsPASS][stock]=NULL;
		$trees[yearsPASS][price]="3000";
		$trees[yearsPASS][area]=NULL;
		$trees[yearsPASS][place_no]=NULL;
		$trees[yearsPASS][open_time]=NULL;
		$trees[yearsPASS][start_time]=NULL;
		$trees[yearsPASS][p_release]=NULL;
		$trees[yearsPASS][g_release]=NULL;
		$trees[yearsPASS][note]="年間パスです";
		
		$this->itemList = $trees;
		
	}
	
	function validate() {
		
		return true;
	}
}
?>