<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');

class Action extends DatabaseAction {
	function execute() {
		$result = $this->dbTable("magazine", null, null, "d_stamp is NULL and account_no=" . $this->account_no);
		if($result) {
			$result = $result[0];
			if (!$this->loaded) {
				$this->login_mail = $result['mail'];
				$this->form['mail'] = $result['mail'];
				$this->form['mail2'] = $result['mail'];
				$this->form['sex'] = $result['sex'];
				$this->form['birthday_year'] = date("Y",strtotime($result['birthday']));
				$this->form['birthday_month'] = date("m", strtotime($result['birthday']));
				$this->form['birthday_day'] = date("d", strtotime($result['birthday']));
				$this->form['pref'] = $result['pref'];
	
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
				$this->loaded = true;
			}
			
			return null;
		}

		$this->clearProperties();
		$this->__controller->redirectToURL('/magazine/change/');
	
		return false;
	}

	function validate() {
		if ($this->account_no) {
			return true;
		}
		
		return 'auth';
	}
}
?>