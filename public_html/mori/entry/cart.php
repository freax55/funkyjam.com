<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/Paginate.php');

class Action extends DatabaseAction {
	function init() {
		DatabaseAction::init();
	}

	function prepare() {
		if ($this->item_code) {
			$this->item_code = null;
		}
	}
		
	function execute() {
		$db =& $this->_db;

		$trees = array();
		$trees[moriYearsPass][item_code]="moriYearsPass";
		$trees[moriYearsPass][name]="森大輔ファンクラブ年間パス";
		$trees[moriYearsPass][category_code]="moriYearsPass";
		$trees[moriYearsPass][color]=NULL;
		$trees[moriYearsPass][size]=NULL;
		$trees[moriYearsPass][stock]=NULL;
		$trees[moriYearsPass][price]="3600";
		$trees[moriYearsPass][area]=NULL;
		$trees[moriYearsPass][place_no]=NULL;
		$trees[moriYearsPass][open_time]=NULL;
		$trees[moriYearsPass][start_time]=NULL;
		$trees[moriYearsPass][p_release]=NULL;
		$trees[moriYearsPass][g_release]=NULL;
		$trees[moriYearsPass][note]="";
		
		$this->itemList = $trees;
		
		$this->yearList = array();
		$now = date("Y");
		$start = $now-100;
		for($i = $start; $i<= $now; $i++){
			$this->yearList[] = $i;
		}
		$this->edit_no = $this->edit_no;
	}
	
	function validate() {
		
		return true;
	}
}
?>