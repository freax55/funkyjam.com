<?php
require_once(dirname(__FILE__) . '/BaseController.php');

class MailformController extends BaseController
{
	var $_system_mail = null;
	var $_system_name = null;
	var $_subject = null;
	
	var $confirmMail = null;
	var $sendedMailBody = null;
	
	function MailformController() {
		$this->BaseController();
	}

    function prepareInput() {
		$this->loadSession();

		$this->prepareInputBase();
	}

	function prepareInputBase() {
		$this->prepareCommonBase();
	}

    function executeInput() {
		return $this->render($this->_base_dir . 'input');
	}
	
    function prepareConfirm() {
		$this->registerSession();

		$this->prepareConfirmBase();
	}

	function prepareConfirmBase() {
		$this->prepareCommonBase();
	}

	function executeConfirm() {
		if (!$this->validate()) {
			$this->errors = $this->getErrors();
			$ret = $this->render($this->_base_dir . 'input');
			$this->errors = null;

			return $ret;
		}
		
		return $this->render($this->_base_dir . 'confirm');
	}
	
    function prepareComplete() {
		$this->loadSession();

		$this->prepareCompleteBase();
	}

	function prepareCompleteBase() {
		$this->prepareCommonBase();
	}

	function executeComplete() {
		if (!$this->validate()) {
			$this->errors = $this->getErrors();
			$ret = $this->render($this->_base_dir . 'input');
			$this->errors = null;

			return $ret;
		}

		$customer = $this->convertEncodingHeader($this->name) . '<' . $this->mail . '>';
		$system = $this->convertEncodingHeader($this->_system_name) . '<' . $this->_system_mail . '>';
		$subject = $this->convertEncodingHeader($this->_subject);
		
		//管理者へメール送信
		$this->admin = true;
		$body = $this->fetch($this->_base_dir . 'mail');
		$body = $this->convertEncodingBody($body);
		$this->send($system, $subject, $body, $customer);
	
		//お客さまへメール送信
		$this->admin = false;
		$body = $this->fetch($this->_base_dir . 'mail');
		$body = $this->convertEncodingBody($body);
		$this->send($customer, $subject, $body, $system);

		$this->sendedMailBody = $this->convertEncodingDisplay($body);
		$ret = $this->render($this->_base_dir . 'complete');
		$this->unregisterSession();

		return $ret;
    }

	/**
	 * Convert display encoding.
	 * @access private
	 * @return string
	 */
	function convertEncodingDisplay($str, $enc = 'EUC-JP') {
		$str = mb_convert_encoding($str, $enc, 'JIS');

		return $str;
	}

	/**
	 * Convert mail body encoding.
	 * @access private
	 * @return string
	 */
	function convertEncodingBody($str, $enc = 'EUC-JP') {
		$str = mb_convert_encoding($str, 'JIS', $enc);

		return $str;
	}

	/**
	 * Convert mail header encoding.
	 * @access private
	 * @return string
	 */
	function convertEncodingHeader($str, $enc = 'EUC-JP') {
		$str = $this->convertEncodingBody($str, $enc);
		$str = '=?iso-2022-jp?B?' . base64_encode($str) . '?=';

		return $str;
	}

	/**
	 * Send mail.
	 * @access private
	 */
	function send($to, $subject, $body, $from) {
		mail($to, $subject, $body, "From: " . $from);
	}

	function fold($str, $length = 70, $enc = 'EUC-JP') {
		$str = str_replace("\r\n", "\n", $str);
		$str = str_replace("\r", "\n", $str);
		$lines = mb_split("\n", $str);
		
		foreach($lines as $key => $line) {
			$works = '';
			$pos = 0;
			while ($pos + $length < strlen($line)) {
				$works .= mb_strcut($line, $pos, $length, $enc) . "\n";
				$pos += $length;
			}
			$lines[$key] = $works . mb_strcut($line, $pos);
		}
		
		return implode("\n", $lines);
	}
}
?>