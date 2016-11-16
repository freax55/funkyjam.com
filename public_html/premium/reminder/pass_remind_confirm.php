<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/Renderer.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/publisherCommon.php');

//ini_set('display_errors', 'on');
//error_reporting(E_ALL);

class Action extends CommonAction {
	function init() {
		DatabaseAction::init();
	}
	
	function prepare() {
		$this->_subject = '��FJ PREMIUM�ۥѥ�����ѹ���λ�Τ��Τ餻';
		$this->_system_name = 'FJ�ץ�ߥ���ڡ���';
		$this->_system_mail = 'premium@funkyjam.com';
		$this->_other_mail = 'premium@funkyjam.com';
		$this->_other_mail_code = 'A013';
		$this->confirm_mail = 'kida@evol-ni.com';
	}
	
	function execute() {
		parent::execute();

		//������ѥ���ɺ���
		$seed = "123456789abcdefghjikmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXY";
		do {
			$password = "";
			for ($i = 0; $i < 8; $i++) {
				$password .= substr($seed, rand(0, strlen($seed) - 1), 1);
			}
		} while (!ereg("[0-9]", $password) || !ereg("[a-z]", $password) || !ereg("[A-Z]", $password));
		$this->password = $password;

		//�᡼�뵡ư
		$mailer = new Renderer();
		$mailer->assign($this->getProperties());
		$system = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_mail . '>';
		$subject = $this->convertEncodingHeader($this->_subject);
		$body = $mailer->fetch('premium/reminder/mail_pass_remind.html');
		$body = $this->convertEncodingBody($body);

		//���Ҥ��ޤإ᡼�������ܹ�������
		$customer = $this->login_id;
		$this->send($customer, $subject, $body, $system);
		$db =& $this->_db;
		$db->assign('id', $this->login_id);
		$db->assign('pass', $this->password);
		$db->statement('premium/reminder/sql/update_premium_pass.sql');
		$db->commit();

		//FJ�˥᡼������
		$this->send($system, $subject, $body, $customer);

		//���ܥ�ˤ˥᡼������
		$this->send($this->confirm_mail, "Send to confirmer from evolni.", $body, $system);

		$_SESSION['login_id'] = NULL;
		unset($this->login_flg);
		$this->clearProperties();
		$this->__controller->redirectToAction('pass_remind_complete');
	}
	function validate() {
		$this->errors = array();
		
		$db =& $this->_db;
		$result = $db->statement('premium/reminder/sql/pass_list.sql');
		$list = $db->buildTree($result);		
		if (!$this->login_id) {
			$this->errors['login_id'] = 'ID�����Ϥ��Ƥ���������';
		}elseif (!$this->isMail($this->login_id)) {
			$this->errors['login_id'] = 'ID�η���������������ޤ���';
		}else{
			$Coincidence = 0;
			if($list){
				foreach ($list as $value) {
					$key = NULL;
					$key = $value[mail];
					if($key == $this->login_id){
						$Coincidence = 1;
					}
				}
			}
			if($Coincidence == 0){				
				$this->errors['login_id'] = '��Ͽ����Ƥ��ʤ�ID���ޤ���ͭ�������ڤ�Ǥ���';
			}			
		}
		if (count($this->errors)) {
			return 'pass_remind';
		}

		return true;
	}
	function convertEncodingBody($str, $enc = 'SJIS') {
		$str = mb_convert_encoding($str, 'JIS', $enc);

		return $str;
	}
	function convertEncodingHeader($str, $enc = 'EUC-JP') {
		$str = $this->convertEncodingBody($str, $enc);
		$str = '=?iso-2022-jp?B?' . base64_encode($str) . '?=';

		return $str;
	}
	function send($to, $subject, $body, $from) {
		mail($to, $subject, $body, "From: " . $from);
	}
}
?>