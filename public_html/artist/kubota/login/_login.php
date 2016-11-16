<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php');
class Action extends DefaultAction {

	function prepare() {
		$this->errors = null;
		
		$this->phraseList = split("[\r\n]+", file_get_contents('auth.txt'));

		$this->defaultMessages = array(
			'emp' => '入力をお願いします。',
			'invalid' => '入力内容が正しくありません。'
		);
	}
	
	function execute() {
		if($this->form["phrase"] == 'TKHT2010') {
			$_SESSION["loginID"]['ticket'] = $this->form["phrase"];
			$this->__controller->redirectToURL('https://www.funkyjam.com/artist/kubota/ticket/index.php?action=list');
//			$_SESSION["loginID"]['subscribe_20100209'] = $this->form["phrase"];
//			$this->__controller->redirectToURL('subscribe_20100209/');
//			$_SESSION["loginID"]['backstage_2010'] = $this->form["phrase"];
//			$this->__controller->redirectToURL('backstage_2010/');
//			$this->__controller->redirectToURL('ticket_20100215/');
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
		} else {
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
		} elseif($f[$key] == 'TKHT2010') {
			$timeList = array(
//				'0' => array(
//					'start_time' => '2009/01/04 00:00:00',
//					'end_time' => '2010/01/03 23:59:59'
//				),
				'1' => array(
					'start_time' => '2010/01/04 11:00:00',
					'end_time' => '2010/01/22 23:59:59'
				),
				'2' => array(
					'start_time' => '2010/02/10 00:00:00',
					'end_time' => '2010/02/15 11:59:59'
				),
				'3' => array(
					'start_time' => '2010/02/15 12:00:00',
					'end_time' => '2010/03/07 23:59:59'
				),
				'4' => array(
					'start_time' => '2010/03/15 12:00:00',
					'end_time' => '2010/03/28 23:59:59'
				),
				'5' => array(
					'start_time' => '2010/04/08 12:00:00',
					'end_time' => '2010/04/16 23:59:59'
				),
				'6' => array(
					'start_time' => '2010/06/11 12:00:00',
					'end_time' => '2010/06/18 23:59:59'
				)
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

		if(count($e)) {
			return 'top';
		}
		
		return true;
	}
}
?>