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
		unset($this->flgTour);
		unset($this->flgNormal);
	}
		
	function execute() {
		$db =& $this->_db;

		if ($this->amount) {
			$db->assign('limit', $this->amount);
			$db->assign('offset', ($this->page - 1) * $this->amount);
		}
		
		//orderList
		$this->orderList = array(
			'A013' => '久保田利伸ツアーグッズ',
			'A090' => '久保田利伸（カレンダー）',
			'A010' => '久保田利伸',
			'A020' => '浦嶋りんこ',
			'A030' => '森大輔',
			'A050' => '茂本ヒデキチ',
			'A060' => '島かおり',
			'A080' => 'ワタル',
			'A000' => 'FJショップ'
		);
		
		//category
		$result = $db->statement('shop/sql/category_list.sql');
		$tree = $db->buildTree($result, 'category_code');
		$this->categoryList = $tree;

		//item
		//カテゴリ指定のチェック
/*
		if($this->category_code) {
			$db->assign('category_code', $this->category_code);
		}
*/
		$result = $db->statement('shop/sql/item_list.sql');
		$tree = $db->buildTree($result, array('category_code', 'item_code'));
		$this->list = $tree;

		$result = $db->statement('shop/sql/item_list_total.sql');
		$row = $db->fetch_assoc($result);
		$total = $row['total'];
		if ($total < ($this->page - 1) * $this->amount) {
			$this->page = ceil($total / $this->amount);
			$db->assign('offset', ($this->page - 1) * $this->amount);
		}
		$paginate = new Paginate();
		$this->pageInfo = $paginate->getPageInfo($this->page, $total, $this->amount, $this->__defaultPageAmount);
		
		//amount
		$this->amountList = array(10, 20, 50, 100);

	}
	
	function validate() {
		
		return true;
	}
}
?>