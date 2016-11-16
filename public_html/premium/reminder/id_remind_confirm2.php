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
		$this->_subject = '��FJ PREMIUM��ID�ѹ���λ�Τ��Τ餻';
		$this->_system_name = 'FJ�ץ�ߥ���ڡ���';
		$this->_system_mail = 'premium@funkyjam.com';
		$this->_other_mail = 'premium@funkyjam.com';
		$this->_other_mail_code = 'A013';
		$this->confirm_mail = 'kida@evol-ni.com';
	}

	function execute() {
		parent::execute();

		//�᡼�뵡ư
		$mailer = new Renderer();
		$mailer->assign($this->getProperties());
		$system = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_mail . '>';
		$subject = $this->convertEncodingHeader($this->_subject);
		$body = $mailer->fetch('premium/reminder/mail_id_remind.html');
		$body = $this->convertEncodingBody($body);

		//�����ͤ˥᡼������
		$customer = $this->new_id;
		$this->send($customer, $subject, $body, $system);

		$db =& $this->_db;
		$db->assign('id', $this->insert_id);
		$db->assign('mail', $this->new_id);
		$db->statement('premium/reminder/sql/update_premium.sql');
		$db->commit();

		//FJ�˥᡼������
		$this->send($system, $subject, $body, $customer);

		//���ܥ�ˤ˥᡼������
		$this->send($this->confirm_mail, "Send to confirmer from evolni.", $body, $system);

		$_SESSION['login_id'] = NULL;
		unset($this->login_flg);
		$this->clearProperties();
		$this->__controller->redirectToAction('id_remind_complete');
	}
	function validate() {
		$this->errors = array();
		
		$db =& $this->_db;
		$result = $db->statement('premium/reminder/sql/insert_list.sql');
		$tree = $db->buildTree($result);
				
		function array_flattent($item,$key,$ret){
		if(is_array($item)) array_walk($item,"array_flattent",&$ret);
			else $ret[]=$item;
		}
		array_walk($tree,"array_flattent",&$new_arr);

		if (!$this->new_id) {
			$this->errors['new_id'] = 'ID�����Ϥ��Ƥ���������';
		}elseif (!$this->isMail($this->new_id)) {
			$this->errors['new_id'] = 'ID�η���������������ޤ���';
		}elseif ($this->new_id != $this->new_conf ) {
			$this->errors['new_id'] = '��ǧ���ϤȰ��פ��ޤ���';
		}elseif (in_array($this->new_id, $new_arr)) {
			$this->errors['new_id'] = '������Υ᡼�륢�ɥ쥹�ϻ��ѤǤ��ޤ���';
		}
		if (count($this->errors)) {
			return 'id_remind_confirm';
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