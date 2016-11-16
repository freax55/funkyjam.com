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

		//�����ƥ����ѿ�
		$this->carriageTotal = 0;

		//����ӥ˷���Ѥξ�������
		$convenience_stores = $this->dbTable("convenience_store", "convenience_store_no","convenience_store_no");
		$this->units = array(
			"convenience_stores" => $convenience_stores
		);

		//�����ɾ����Ѥ�ǯ���������
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