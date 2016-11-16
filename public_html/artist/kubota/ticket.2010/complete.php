<?php
require_once('auth.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/Renderer.php');

class Action extends AuthAction {
	function prepare() {
		$this->_subject = '購入内容のご確認';
		$this->_system_name = 'BBC TICKET STORE';
		$this->_system_from = 'ticket@funkyjam.com';
		$this->_system_to = 'ticket_kubota@funkyjam.com';
		$this->_evol_ni_to = 'kida@evol-ni.com';
	}
	
	function execute() {
		$db =& $this->_db;
		
		$mailer = new Renderer();
		$mailer->template_dir = realpath(dirname(__FILE__) . '/..');
		
		$mailer->assign($this->getProperties());
		
		$order_desc_no = $this->p04;
		$order_total = $this->p05;
		$result_code = $this->p15;
		$detail_code = $this->p16;
		
		$mailer->assign('total', $order_total);
		
		//メール処理
		//order
		$db->assign('order_desc_no', $order_desc_no);
		$db->assign('settlement_no', $this->p13);
		$db->assign('recognition_no', $this->p14);
		$result = $db->statement('artist/kubota/ticket/sql/order_list.sql');
		$tree = $db->buildTree($result, 'order_no');
		$orderList = $tree;
		$mailer->assign('orderList', $orderList);

		//order_desc
		$result = $db->statement('artist/kubota/ticket/sql/order_desc_list.sql');
		$row = $db->fetch_assoc($result);
		$mailer->assign('orderDesc', $row);

		/*
		 * 正しく決済された場合に、d_stampをnullにする
		 */
		if ($result_code == '0' && $detail_code == '00') {
			$db->begin();
			foreach($orderList as $orderRow) {
				$db->assign('order_no', $orderRow['order_no']);
				$db->statement('artist/kubota/ticket/sql/update_order.sql');
			}
			$db->statement('artist/kubota/ticket/sql/update_order_desc.sql');
			$db->commit();
		}

		if ($this->mail) {
			$customer = $this->convertEncodingHeader($row['name']) . '<' . $this->mail . '>';
		}
		else {
			$customer = $this->_system_to;
		}
		
		$systemTo = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_to . '>';
		$systemFrom = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_from . '>';
		$subject = $this->convertEncodingHeader($this->_subject);
		
		if ($result_code == '0' && $detail_code == '00') {
			//FunkyJamへメール送信
			$mailer->assign('admin', 1);
			$body = $mailer->fetch('ticket/mail_card_admin.html');
			$body = $this->convertEncodingBody($body);
			$this->send($systemTo, $subject, $body, $customer);
			$this->send($this->_evol_ni_to, $subject, $body, $customer);
			
			if ($this->mail) {
				//お客さまへメール送信
				$mailer->assign('admin', 0);
				$body = $mailer->fetch('ticket/mail_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $systemFrom);
				$this->send($this->_evol_ni_to, $subject, $body, $systemFrom);
			}
		} else {
			return 'error';
		}
		
		$this->clearProperties();
		$this->__controller->redirectToAction('end');
		
		return false;
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
	function convertEncodingBody($str, $enc = 'SJIS') {
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