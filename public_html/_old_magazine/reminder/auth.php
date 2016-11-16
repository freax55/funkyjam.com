<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');

class Action extends DatabaseAction {
	
	function prepare() {
		$this->errors = null;

		$this->defaultMessages = array(
			'emp' => '入力をお願いします。',
			'empS' => '選択をお願いします。',
			'cmp' => '確認入力と一致していません。入力をご確認ください。',
			'fom' => '形式をご確認ください。'
		);
	}
	
	function execute() {
		$this->__controller->redirectToAction('confirm');

		return false;
	}

	function validate() {
		$d =& $this->defaultMessages;
		$this->errors = array();
		$e =& $this->errors;
		$f =& $this->form;

		$key = 'mail';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}elseif(!$this->isMail($f[$key])){
			$e[$key] = $d['fom'];
		}

		$key = 'password';
		if(empty($f[$key])){
			$e[$key] = $d['emp'];
		}
		
		if(!count($e)) {
			$result = $this->dbTable("magazine", null, null, "d_stamp is NULL and mail='{$f['mail']}' and password='{$f['password']}'");
			if(!$result) {
				$e['mail'] = "メールアドレスまたは、パスワードに誤りがあります。";
			} else {
				$result = $result[0];
				$this->account_no = $result['account_no'];
				$this->login_mail = $result['mail'];
				$this->form['mail'] = $result['mail'];
				$this->form['mail2'] = $result['mail'];
				$this->form['sex'] = $result['sex'];
				$this->form['birthday_year'] = date("Y",strtotime($result['birthday']));
				$this->form['birthday_month'] = date("m", strtotime($result['birthday']));
				$this->form['birthday_day'] = date("d", strtotime($result['birthday']));
				$this->form['pref'] = $result['pref'];
				$this->form['password'] = $result['password'];
				$this->form['password2'] = $result['password'];

				$pattern = '/^fav_.+$/';
				foreach ($result as $key => $value) {
					if(preg_match($pattern, $key)) {
						if ($result[$key]){
							$this->form[$key] = 1;
						} else {
							unset($this->form[$key]);
						}
					}
				}
			}
		}

		if(count($e)) {
			return 'login';
		}

		$this->errors = array();
		
		return true;
	}

}
?>