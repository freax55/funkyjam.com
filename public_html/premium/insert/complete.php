<?php
/**
 * $this->_other_mailや、$tourGoodsListなどは
 * 2003年頃の久保田利伸のツアーグッズ販売の際に使用したパラメータ。
 * ツアーグッズはcategory_code='A013'というカテゴリになっている。
 * 当初は、ツアーグッズだけ別の会社が管理していたのでそのような対応が必要となったが
 * 2010年のツアーグッズについては、funkyjamで管理。
 * 今後は不要になるかもしれません。が、リファクタリングの時間がないのでとりあえずママです。
 *
 * 2010/10/01 出口
 */


//ini_set('display_errors', 'on');
//error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/simple/Paginate.php');

class Action extends DatabaseAction {
	var $__defaultPage = null;
	var $__defaultAmount = null;
	var $__defaultPageAmount = null;
	
	function init() {
		DatabaseAction::init();
		
		$this->__defaultPage = 1;
		$this->__defaultAmount = 20;
		$this->__defaultPageAmount = 5;
	}

	function prepare() {
		if($this->status == "edit"){
			$this->_subject = '【FJ PREMIUM】登録の更新・年会費お支払について';
		}
		else{
			$this->_subject = '【FJ PREMIUM】年会費お支払いについて';
		}

		$this->_system_name = 'FJプレミアムページ';
		//$this->_system_mail = 'kida@evol-ni.jp';
		//$this->_other_mail = 'kida@evol-ni.jp';
		$this->_system_mail = 'premium@funkyjam.com';
		$this->_other_mail = 'premium@funkyjam.com';
		$this->_other_mail_code = 'A013';

		$this->confirm_mail = 'kida@evol-ni.com';
	}
	
	function execute() {
		$db =& $this->_db;

		$this->p04 = $_SESSION["p04"];
		
		$mailer = new Renderer();
		$mailer->assign($this->getProperties());

		$order_desc_no = $this->p04;
		$result_code = $this->p15;
		$detail_code = $this->p16;
		
		//メール処理
		//order
		$db->assign('order_desc_no', $order_desc_no);
		$result = $db->statement('premium/insert/sql/order_list.sql');
		$tree = $db->buildTree($result, 'order_no');
		$orderList = $tree;
		$noTourGoodsList = $tree;
		
		//メール送信先毎に振り分け
		$tourGoodsList = array();
		foreach($noTourGoodsList as $order) {
			if($order['category_code'] == $this->_other_mail_code){
				$tourGoodsList[] = $noTourGoodsList[$order['order_no']];
				unset($noTourGoodsList[$order['order_no']]);
			}
		}
		
		//order_desc
		$result = $db->statement('premium/insert/sql/order_desc_list.sql');
		$row = $db->fetch_assoc($result);
		$mailer->assign('orderDesc', $row);

		$type = "";
		if ($row['payment'] == "コンビニ決済") {
			$this->_subject .= "（コンビニ決済）";
		}
		elseif ($row['payment'] == "カード決済（ペイジェント）") {
			$this->_subject .= "（クレジットカード）";
		}

		if ($this->mail) {
			$customer = $this->convertEncodingHeader($row['name']) . '<' . $this->mail . '>';
		}
		else {
			$customer = $this->_system_mail;
		}
		
		$system = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_mail . '>';
		$subject = $this->convertEncodingHeader($this->_subject);

		$start = date("Y-m-d", mktime(0, 0, 0, date("n"), 1, date("Y")));
		$end = date("Y-m-d", mktime(0, 0, 0, date("n")+1, 1-1, date("Y")+1));

		$start_mail = date("Y-m-d", mktime(0, 0, 0, date("n"), 1, date("Y")+1));
		$db->begin();
		$db->assign('mail', $this->mail);
		$db->assign('member_no', $this->member_no);
		$db->assign('start', $start);
		$db->assign('end', $end);
		$db->assign('start_mail', $start_mail);
		foreach($orderList as $o_id) {
			$db->assign('order_no', $o_id['order_no']);
			$db->assign('order_desc_no', $o_id['order_desc_no']);
		}
		//更新処理一時保存フィールドにデータを入れる
		if($this->status == "edit"){
			$db->statement('premium/insert/sql/update_premium.sql');
		}
		//登録処理
		else{
			$db->statement('premium/insert/sql/insert_premium.sql');
		}
		$db->commit();
		if ($row['payment'] == "コンビニ決済") {
			//FunkyJamへメール送信
			//コンビニ・ATM・銀行ネットについては、「予約」として、FJに通知する。
			$mailer->assign('admin', 0);
			$mailer->assign('tourGoodsList', $tourGoodsList);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			//数字8桁で返ってくるので、日付として表示させる。アサインしなおし。
			$payment_limit_date = $this->__limitDateFormat($this->payment_limit_date);
			$mailer->assign("payment_limit_date", $payment_limit_date);

			$convenience_stores = $this->dbTable("convenience_store", "convenience_store_no");
			$mailer->assign("convenience_stores", $convenience_stores);

			$body = $mailer->fetch('premium/insert/mail_paygent_cvs.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $this->convertEncodingHeader($this->_subject . '（予約）'), $body, $customer);

			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('premium/insert/mail_paygent_cvs.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, "Send to confirmer from evolni.", $body, $system);
			}

			if ($this->mail) {
				//お客さまへメール送信
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('premium/insert/mail_paygent_cvs.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}

			//ツアーグッズの申し込みがあった場合
			if($tourGoodsList) {
				$mailer->assign('orderList', $tourGoodsList);
				$other = $this->_other_mail;

				//管理会社へメール送信
				$mailer->assign('admin', 2);
				$body = $mailer->fetch('insert/mail_paygent_cvs.html');
				$body = $this->convertEncodingBody($body);
				$this->send($other, $subject, $body, $customer);
			}
			
			/*
			 * apply_dateを更新する
			 */
			$db->begin();
			$db->statement('premium/insert/sql/update_apply_date_order_desc.sql');
			$db->commit();
		}
		elseif ($row['payment'] == "カード決済（ペイジェント）") {
			//FunkyJamへメール送信
			$mailer->assign('admin', 1);
			$mailer->assign('tourGoodsList', $tourGoodsList);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			$body = $mailer->fetch('premium/insert/mail_paygent_card.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $subject, $body, $customer);

			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('premium/insert/mail_paygent_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, "Send to confirmer from evolni.", $body, $system);
			}

			if ($this->mail) {
				//お客さまへメール送信
				$mailer->assign('admin', 0);
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('premium/insert/mail_paygent_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}

			//ツアーグッズの申し込みがあった場合
			if($tourGoodsList) {
				$mailer->assign('orderList', $tourGoodsList);
				$other = $this->_other_mail;

				//管理会社へメール送信
				$mailer->assign('admin', 2);
				$body = $mailer->fetch('premium/insert/mail_paygent_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($other, $subject, $body, $customer);
			}
			/*
			 * 正しく決済された場合に、d_stampをnullにする
			 * 決済確定までに時間差がある場合は、確定のタイミングでd_stampをnullにする
			 */
			$db->begin();
			foreach($orderList as $orderRow) {
				$db->assign('order_no', $orderRow['order_no']);
				$db->statement('premium/insert/sql/update_order.sql');
			}
			$db->statement('premium/insert/sql/update_order_desc.sql');
			$db->commit();

			/*
			 * 更新で正しく決済された場合に、u_◯◯◯シリーズ（一時保存フィールド）を全てnullにして、
			 * 本フィールドに上書きする
			 */
			if($this->status == "edit"){
				$db->begin();
				$db->statement('premium/insert/sql/update_premium_card_user.sql');
				$db->commit();
			}
			/*
			 * apply_dateを更新する
			 */
			$db->begin();
			$db->statement('premium/insert/sql/update_apply_date_order_desc.sql');
			$db->commit();
		}
		else {
			return 'error';
		}
		$root = "";
		$root = $this->status;
		$_SESSION['login_id'] = NULL;
		unset($this->login_flg);
		$this->clearProperties();
		if($root == "edit"){
			$this->__controller->redirectToAction('end_edit');
		}
		else{
			$this->__controller->redirectToAction('end');
		}
		
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

	function validate() {
		return true;

	}


	function __limitDateFormat($limitDate){
		return mb_ereg_replace('([0-9]{4})([0-9]{2})([0-9]{2})', "\\1年\\2月\\3日", $limitDate);
	}

}
?>