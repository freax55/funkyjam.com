<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php');

class ticketAction extends DefaultAction {

	function prepare() {
		$this->errors = null;
		
		$this->phraseList = split("[\r\n]+", file_get_contents('auth.txt'));

		$this->defaultMessages = array(
			'emp' => '入力をお願いします。',
			'invalid' => '入力内容が正しくありません。'
		);
	}
	
	function execute() {
		$_SESSION["loginID"] = $this->form["phrase"];
		
		$this->__controller->redirectToAction('list');

		return false;
	}

	function validate() {
		$d =& $this->defaultMessages;
		$this->errors = array();	
		$e =& $this->errors;
		$f =& $this->form;

		$timeList = array(
//			'0' => array(
//				'start_time' => '2009/01/04 11:00:00',
//				'end_time' => '2010/01/03 23:59:59'
//			),
			'1' => array(
				'start_time' => '2010/01/04 11:00:00',
				'end_time' => '2010/01/22 23:59:59'
			),
			'2' => array(
				'start_time' => '2010/02/01 11:00:00',
				'end_time' => '2010/02/19 23:59:59'
			)
		);

		$key = 'time';
		$e[$key] = $d['invalid'];
		foreach($timeList as $time) {
			if(strtotime($time['start_time']) <= time()
				&& strtotime($time['end_time']) >= time()) {
				unset($e[$key]);
				break;
			}
		}
		if(count($e)) {
			return 'login';
		}

		$key = 'phrase';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}elseif(!in_array($f[$key], $this->phraseList)){
			$e[$key] = $d['invalid'];
		}

		if(count($e)) {
			return 'login';
		}
		
		return true;
	}
}
?>