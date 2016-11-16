<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
class Action extends DatabaseAction {
	
	function prepare() {
		$this->errors = null;
		
		$this->phraseList = split("[\r\n]+", file_get_contents('auth.txt'));
		
		$toursaleList = $this->dbTable('toursale', null, null, "start_date <= current_timestamp AND end_date >= current_timestamp", "password");
		if(count($toursaleList)) {
			foreach($toursaleList as $val) {
				$this->phraseList[] = $val['password'];
			}
		}
		
		$this->defaultMessages = array(
			'emp' => '入力をお願いします。',
			'invalid' => '入力内容が正しくありません。',
			'out_time' => 'ただいまの時間、ご購入頂けません。',
		);
	}
	
	function execute() {
		if($this->form["phrase"] == 'T3K3SAU') {
			$_SESSION["loginID"]['ticket'] = $this->form["phrase"];
			$this->__controller->redirectToURL('/artist/kubota/ticket/index.php?action=list');
		} elseif($this->form["phrase"] == 'YK98MN') {
			$_SESSION["loginID"]['backstage_2015'] = $this->form["phrase"];
			$this->__controller->redirectToURL('backstage_2015/');
		} elseif($this->form["phrase"] == 'TAVC') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm119/');
		} elseif($this->form["phrase"] == 'TKTA') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm118/');
		} elseif($this->form["phrase"] == 'LDBH') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm117/');
		} elseif($this->form["phrase"] == 'LOKK') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm116/');
		} elseif($this->form["phrase"] == 'AKOS') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm115/');
		} elseif($this->form["phrase"] == 'CTTM') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm114/');
		} elseif($this->form["phrase"] == 'NARK') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm113/');
		} elseif($this->form["phrase"] == 'JTKG') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm112/');
		} elseif($this->form["phrase"] == 'OYSZ') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm111/');
		} elseif($this->form["phrase"] == 'FLDP') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm110/');
		} elseif($this->form["phrase"] == 'NCCP') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm109/');
		} elseif($this->form["phrase"] == 'STBS') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm108/');
		} elseif($this->form["phrase"] == 'ITUS') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm107/');
		} elseif($this->form["phrase"] == 'SITU') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm106/');
		} elseif($this->form["phrase"] == 'BCYA') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm105/');
		} elseif($this->form["phrase"] == 'BMUP') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm104/');
		} elseif($this->form["phrase"] == 'TWTI') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm103/');
		} elseif($this->form["phrase"] == 'LDCS') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm102/');
		} elseif($this->form["phrase"] == 'PAAP') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm101/');
		} elseif($this->form["phrase"] == 'MNJU94') {
			$_SESSION["loginID"]['backstage_2011'] = $this->form["phrase"];
			$this->__controller->redirectToURL('backstage_2011/');
		} elseif($this->form["phrase"] == 'CTGS') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm100/');
		} elseif($this->form["phrase"] == 'NBKA') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm099/');
		} elseif($this->form["phrase"] == 'TYUS') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm098/');
		} elseif($this->form["phrase"] == '25AY') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm097/');
		} elseif($this->form["phrase"] == 'LORA') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm096/');
		} elseif($this->form["phrase"] == 'NADA') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm095/');
		} elseif($this->form["phrase"] == 'GGFP') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm094/');
		} elseif($this->old_page == 'bbcm_tkm091') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm091/magazine.html');
		} elseif($this->old_page == 'bbcm_tkm092') {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm092/magazine.html');
		}
		
		else {
			$_SESSION["loginID"]['normal'] = $this->form["phrase"];
			$this->__controller->redirectToURL('bbcm_tkm093/');
		}
		return false;
	}

	function validate() {
		$d =& $this->defaultMessages;
		$this->errors = array();	
		$e =& $this->errors;
		$f =& $this->form;
		
		$key = 'phrase';
		if(empty($f[$key])) {
			$e[$key] = $d['emp'];
		} elseif(!in_array($f[$key], $this->phraseList)) {
			$e[$key] = $d['invalid'];
		}
		if($f[$key] == 'TKSU607') {
			$timeList = array(
				'1' => array(
					'start_time' => '2013/07/10 12:00:00',
					'end_time' => '2013/08/31 23:59:59'
				),
			);
			
			$e[$key] = $d['invalid'];
			foreach($timeList as $time) {
				if(strtotime($time['start_time']) <= time()
					&& strtotime($time['end_time']) >= time()) {
					unset($e[$key]);
					break;
				}
			}
		}
		
		//萬壽会員バックステージの申し込み期限設定
		if($f[$key] == 'YK98MN') {
			$timeList = array(
				'1' => array(
					'start_time' => '2015/03/10 12:00:00',
					'end_time' => '2015/03/20 23:59:59'
				),
			);
			
			$e[$key] = $d['invalid'];
			foreach($timeList as $time) {
				if(strtotime($time['start_time']) <= time()
					&& strtotime($time['end_time']) >= time()) {
					unset($e[$key]);
					break;
				}
			}
		}

		if($f[$key] == 'MNJU94') {
			$timeList = array(
				'1' => array(
					'start_time' => '2011/09/01 12:00:00',
					'end_time' => '2011/09/14 23:59:59'
				),
			);
			
			$e[$key] = $d['invalid'];
			foreach($timeList as $time) {
				if(strtotime($time['start_time']) <= time()
					&& strtotime($time['end_time']) >= time()) {
					unset($e[$key]);
					break;
				}
			}
		}

		//萬壽会員バックステージの申し込み期限設定
		if($f[$key] == 'T3K3SAU') {

			//指定日付時間のみログイン不可

			$stop_start_time = strtotime('2013/08/08 00:00:00');
			$now = strtotime("now");
			$stop_end_time = strtotime('2013/08/08 06:00:00');
			if($stop_start_time <= $now && $now <= $stop_end_time){
			}else{
				$timeList = array(
					'1' => array(
						'start_time' => '2013/08/25 00:00:00',
						'end_time' => '2013/08/31 23:59:59'
					),
				);
			}

			// $timeList = array(
			// 	'1' => array(
			// 		'start_time' => '2013/08/01 12:00:00',
			// 		'end_time' => '2013/08/15 23:59:59'
			// 	),
			// );
			
			$e[$key] = $d['invalid'];
			foreach($timeList as $time) {
				if(strtotime($time['start_time']) <= time()
					&& strtotime($time['end_time']) >= time()) {
					unset($e[$key]);
					break;
				}
			}
		}

		if(count($e)) {
			return 'top';
		}
		
		return true;
	}
}
?>