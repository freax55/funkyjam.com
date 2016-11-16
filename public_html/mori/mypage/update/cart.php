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

		$this->login_flg = "";
		if(!empty($_SESSION['login_id'])){
			$this->login_flg = "login_ON";
			$login_id = $_SESSION['login_id'];
			$db =& $this->_db;
			$db->assign('login_id', $login_id);
			$result = $db->statement($_SERVER['DOCUMENT_ROOT'].'/mori/sql/mori_login_user.sql');
			$nowuser = $db->buildTree($result);
			if(!empty($nowuser)){
				$this->login_user_account_no = $nowuser['0']['account_no'];

				$this->login_user_first_name = $nowuser['0']['first_name'];
				$this->login_user_last_name = $nowuser['0']['last_name'];

				$this->login_user_first_kana = $nowuser['0']['first_kana'];
				$this->login_user_last_kana = $nowuser['0']['last_kana'];

				$this->login_user_first_roman = $nowuser['0']['first_roman'];
				$this->login_user_last_roman = $nowuser['0']['last_roman'];

				$this->login_user_zip1 = $nowuser['0']['zip1'];
				$this->login_user_zip2 = $nowuser['0']['zip2'];

				$this->login_user_address1 = $nowuser['0']['address1'];
				$this->login_user_address2 = $nowuser['0']['address2'];
				$this->login_user_address3 = $nowuser['0']['address3'];

				$this->login_user_tel = $nowuser['0']['tel'];

				$this->login_user_mail = $nowuser['0']['mail'];

				$this->login_user_sex = $nowuser['0']['sex'];

				$this->login_user_birth_year = $nowuser['0']['birth_year'];
				$this->login_user_birth_month = $nowuser['0']['birth_month'];
				$this->login_user_birth_day = $nowuser['0']['birth_day'];

				$this->login_user_end_stamp = $nowuser['0']['end_stamp'];

				$this->login_user_payment = $nowuser['0']['payment'];

				$this->login_user_pass = $nowuser['0']['pass'];
			}
			else{
				$this->login_flg = "login_OFF";
			}
		}
		else{
			$this->login_flg = "login_OFF";
		}

		$this->param = "";
		$this->turnParam = "";

		if($this->login_flg == 'login_ON'){
			//終了時刻を正規化して、ひと月前に設定
			$updateTime = strtotime($this->login_user_end_stamp);
			$updateTimeStart = mktime(0, 0, 0, date("m", strtotime("-1 month" , $updateTime)), date("d", strtotime("-1 month" , $updateTime)), date("Y", strtotime("-1 month" , $updateTime)));

			//現在時刻を取得
			$updateTimeNow = mktime(0, 0, 0, date("n"), date("d"), date("Y"));

			//現在時刻よりも終了時刻ひと月前が過ぎていれば、ok
			if($updateTimeNow >= $updateTimeStart){
				$this->param = "login";
				if(!$this->reset){

					//hidden
					$this->account_no = $this->login_user_account_no;
					
					//更新はさせないので、コメントウアト
					$this->first_name = $this->login_user_first_name;
					$this->last_name = $this->login_user_last_name;
					$this->first_kana = $this->login_user_first_kana;
					$this->last_kana = $this->login_user_last_kana;
					$this->first_roman = $this->login_user_first_roman;
					$this->last_roman = $this->login_user_last_roman;
					$this->sex = $this->login_user_sex;
					$this->birth_year = $this->login_user_birth_year;
					$this->birth_month = $this->login_user_birth_month;
					$this->birth_day = $this->login_user_birth_day;


					$this->zip1 = $this->login_user_zip1;
					$this->zip2 = $this->login_user_zip2;

					$this->address1 = $this->login_user_address1;
					$this->address2 = $this->login_user_address2;
					$this->address3 = $this->login_user_address3;

					$this->tel = $this->login_user_tel;

					$this->mail = $this->login_user_mail;
					$this->confirm = $this->login_user_mail;

					$this->password = $this->login_user_pass;
					$this->turnParam = "tar";
				}
			}else{
				$this->param = "notTime";
			}
		}
		else{
			$this->param = "out";
		}

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