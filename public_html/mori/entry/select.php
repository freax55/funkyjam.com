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

		//システム用変数
		$this->carriageTotal = 0;

		//コンビニ決済用の情報を取得
		$convenience_stores = $this->dbTable("convenience_store", "convenience_store_no","convenience_store_no");
		$this->units = array(
			"convenience_stores" => $convenience_stores
		);

		//カード情報用の年月日を取得
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