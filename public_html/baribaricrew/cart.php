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
		$this->errors = null;
		
		$this->defaultMessages = array(
			'emp' => '���Ϥ򤪴ꤤ���ޤ���'
		);
	}
		
	function execute() {
		$db =& $this->_db;

		//item
		//$result = $db->statement('shop/sql/item_list.sql');
		//$tree = $db->buildTree($result, 'item_code');
		
		$trees = array();
		$trees[BariBariCrew][item_code]="BariBariCrew";
		$trees[BariBariCrew][name]="BariBariCrew���";
		$trees[BariBariCrew][category_code]="BariBariCrew";
		$trees[BariBariCrew][color]=NULL;
		$trees[BariBariCrew][size]=NULL;
		$trees[BariBariCrew][stock]=NULL;
		if($this->flg == "input"){
			$trees[BariBariCrew][price]="5750";
		}
		if($this->flg == "edit"){
			$trees[BariBariCrew][price]="5250";
		}
		$trees[BariBariCrew][area]=NULL;
		$trees[BariBariCrew][place_no]=NULL;
		$trees[BariBariCrew][open_time]=NULL;
		$trees[BariBariCrew][start_time]=NULL;
		$trees[BariBariCrew][p_release]=NULL;
		$trees[BariBariCrew][g_release]=NULL;
		$trees[BariBariCrew][note]="BariBariCrew����Ǥ�";
		
		$this->itemList = $trees;
		
	}
	
	function validate() {


		/*------------------------------------------------------------------------
		����Υѥ���ɤϰʲ��򹹿����Ʋ�������
		------------------------------------------------------------------------*/
		//2��25������6��30���ޤǤβ���
			$febPassword = "MSDB";
		//5��25������9��30���ޤǤβ���
			$mayPassword = "MTTS";
		//8��25������12��31���ޤǤβ���
			$augPassword = "WVCJ";
		//11��25������3��31���ޤǤβ���
			$novPassword = "LTHH";
		/*----------------------------------------------------------------------*/


		/*------------------------------------------------------------------------
		�������դ����
		------------------------------------------------------------------------*/
		$today = getdate();
		$today_month = $today['mon'];
		$today_day = $today['mday'];
		$today_year = $today['year'];
		$now = mktime(0, 0, 0, $today_month, $today_day, $today_year);

		/*------------------------------------------------------------------------
		�ѥ���ɳƼ�����
		------------------------------------------------------------------------*/
		$febNo = $this->getPasswordConfig($febPassword,2,25,6,30,$today_month,$today_year);
		$mayNo = $this->getPasswordConfig($mayPassword,5,22,9,30,$today_month,$today_year);
		$augNo = $this->getPasswordConfig($augPassword,8,25,12,31,$today_month,$today_year);
		$novNo = $this->getPasswordConfig($novPassword,11,25,3,31,$today_month,$today_year);
		//�ѥ���ɰ���
		$passList = array(
			"1" => $febNo,
			"2" => $mayNo,
			"3" => $augNo,
			"4" => $novNo
		);

		/*------------------------------------------------------------------------
		�Ʒ�Ƽ�����
		------------------------------------------------------------------------*/
		$jan = $this->getDateConfig(11,25,1,31,$today_month,$today_year);
		$feb = $this->getDateConfig(11,25,2,28,$today_month,$today_year);
		$mar = $this->getDateConfig(11,25,3,31,$today_month,$today_year);
		$apr = $this->getDateConfig(2,25,4,30,$today_month,$today_year);
		$may = $this->getDateConfig(2,25,5,31,$today_month,$today_year);
		$jun = $this->getDateConfig(2,25,6,30,$today_month,$today_year);
		$jul = $this->getDateConfig(5,22,7,31,$today_month,$today_year);
		$aug = $this->getDateConfig(5,22,8,31,$today_month,$today_year);
		$sep = $this->getDateConfig(5,22,9,30,$today_month,$today_year);
		$oct = $this->getDateConfig(8,25,10,31,$today_month,$today_year);
		$nov = $this->getDateConfig(8,25,11,30,$today_month,$today_year);
		$dec = $this->getDateConfig(8,25,12,31,$today_month,$today_year);
		//�ѥ���ɰ���
		$dateList = array(
			"01" => $jan,
			"02" => $feb,
			"03" => $mar,
			"04" => $apr,
			"05" => $may,
			"06" => $jun,
			"07" => $jul,
			"08" => $aug,
			"09" => $sep,
			"10" => $oct,
			"11" => $nov,
			"12" => $dec
		);

		$d =& $this->defaultMessages;
		$this->errors = array();
		$e =& $this->errors;
		$this->flg = $this->flg;

		if($this->flg == "input"){
			$key = 'input_pass';
			if(empty($this->$key)){
				$e[$key] = $d['emp'];
			}
		}

		if($this->flg == "edit"){
			$key = 'edit_no';
				if(empty($this->$key)){
				$e[$key] = $d['emp'];
			}
			$key = 'edit_pass';
			if(empty($this->$key)){
				$e[$key] = $d['emp'];
			}
		}

		if(count($e)) {
			return 'login';
		}elseif($this->flg == "edit"){
			/*------------------------------------------------------------------------
			�ѥ���ɰ��׽���
			------------------------------------------------------------------------*/
			//�������Ƥ������������
			$insertMonth = substr($this->edit_no, 2, 2);

			$updateStart = $dateList[$insertMonth]['start'];
			$updateEnd = $dateList[$insertMonth]['end'];

			//��������������˸������դ����뤫�ɤ�����Ƚ�Ǥ���
			if($updateStart <= $now && $now <= $updateEnd){
				//������ξ�硢�������դ�����ѤǤ���ѥ���ɤ���Ф���
				for( $i = 1; $i <= 4; $i++ ){
					if($passList[$i]['start'] < $now && $now < $passList[$i]['end']){
						$updatePassList[]=$passList[$i]['password'];
					}
				}
				//�ѥ���ɰ��׽���
				if(!in_array($this->edit_pass, $updatePassList)){
 					$e['edit_login'] = "������˼��Ԥ��ޤ���";
					return 'login';
				}
			}else{
				$e['edit_login'] = "�������֤ǤϤ������ޤ���Τǡ������󤹤�����Ǥ��ޤ���";
				return 'login';
			}
		}elseif($this->flg == "input"){
			//�������դ�����ѤǤ���ѥ���ɤ���Ф���
				for( $i = 1; $i <= 4; $i++ ){
				if($passList[$i]['start'] < $now && $now < $passList[$i]['end']){
					$updatePassList[]=$passList[$i]['password'];
				}
			}
			//�ѥ���ɰ��׽���
			if(!in_array($this->input_pass, $updatePassList)){
					$e['input_login'] = "������˼��Ԥ��ޤ���";
				return 'login';
			}
		}
		$this->yearList = array();

		$now = date("Y");
		$start = $now-100;
		for($i = $start; $i<= $now; $i++){
			$this->yearList[] = $i;
		}
		$this->edit_no = $this->edit_no;
		return true;
	}

	function getStartYear($startMonth,$endMonth,$today_month,$today_year){
		$startYear = $today_year;
		if($startMonth > $endMonth && $startMonth > $today_month){
			$startYear = $today_year-1;
		}

		return $startYear;
	}

	function getEndYear($startMonth,$endMonth,$today_month,$today_year){
		$endYear = $today_year;
		if($startMonth > $endMonth && $endMonth < $today_month){
			$endYear = $today_year+1;
		}

		return $endYear;

	}

	function getPasswordConfig($febPassword,$startMonth,$startDay,$endMonth,$endDay,$today_month,$today_year){
		$passwordConfig = $this->getDateConfig($startMonth,$startDay,$endMonth,$endDay,$today_month,$today_year);
		$passwordConfig["password"] = $febPassword;
		return $passwordConfig;
	}

	function getDateConfig($startMonth,$startDay,$endMonth,$endDay,$today_month,$today_year){
		$startYear = $this->getStartYear($startMonth,$endMonth,$today_month,$today_year);
		$endYear = $this->getEndYear($startMonth,$endMonth,$today_month,$today_year);
		if($endYear-$startYear > 1){
			$endYear = $startYear+1;
		}
		$dateConfig = array(
			"start" => mktime(0, 0, 0, $startMonth, $startDay, $startYear),
			"end" => mktime(23, 59, 59, $endMonth, $endDay, $endYear)
		);

		return $dateConfig;

	}
}
?>