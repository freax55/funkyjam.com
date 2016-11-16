<?php
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
		$this->_subject = '森大輔オフィシャルファンクラブ「モリノナカマ」継続更新完了しました';
		$this->_system_name = 'モリノナカマ';
		$this->_system_mail = 'artist_mori@funkyjam.com';
		if(strpos($_SERVER['HTTP_HOST'], 'test.') !== false) {
			$this->_system_mail = 'artist_mori@funkyjam.com';
		}
		$this->confirm_mail = 'kida@evol-ni.com';
	}
	
	function execute() {
		$db =& $this->_db;

		/*
		 * orderへの登録処理
		 */
		$this->p04 = $_SESSION["p04"];
		$order_desc_no = $this->p04;
		$result_code = $this->p15;
		$detail_code = $this->p16;
		$db->assign('order_desc_no', $order_desc_no);
		$result = $db->statement('mori/mypage/update/sql/order_list_insert.sql');
		$tree = $db->buildTree($result, 'order_no');
		$orderList = $tree;
		$noTourGoodsList = $tree;

		/*
		 * order_descへの登録処理
		 */
		$result = $db->statement('mori/mypage/update/sql/order_desc_list_insert.sql');
		$row = $db->fetch_assoc($result);
		

		//閲覧開始日
		$start_stamp = date("Y-m-d", mktime(0, 0, 0, date("n"), date("j"), date("Y")));

		//閲覧終了日
//		$end_stamp = date("Y-m-d", mktime(0, 0, 0, date("n"), date("j")-1, date("Y")+1));

		//メール開始日1
//		$mail_stamp1 = date("Y-m-d", mktime(0, 0, 0, date("n")-1, date("j"), date("Y")+1));
		//メール開始日2
//		$mail_stamp2 = date("Y-m-d", mktime(0, 0, 0, date("n"), date("j")-15, date("Y")+1));
		//メール開始日3
//		$mail_stamp3 = date("Y-m-d", mktime(0, 0, 0, date("n"), date("j")-2, date("Y")+1));

		$db->begin();
		$db->assign('account_no', $this->account_no);

		//登録されているデータを取得
		$result = $db->statement('mori/mypage/update/sql/mori_user.sql');
		$use = $db->buildTree($result);
		$use_end_y = date('Y', strtotime($use[0][end_stamp]))+1;
		$use_end_m = date('m', strtotime($use[0][end_stamp]));
		$use_end_d = date('d', strtotime($use[0][end_stamp]));

		$mail_stamp1_y = date('Y', strtotime($use[0][mail_stamp1]))+1;
		$mail_stamp1_m = date('m', strtotime($use[0][mail_stamp1]));
		$mail_stamp1_d = date('d', strtotime($use[0][mail_stamp1]));
		
		$mail_stamp2_y = date('Y', strtotime($use[0][mail_stamp2]))+1;
		$mail_stamp2_m = date('m', strtotime($use[0][mail_stamp2]));
		$mail_stamp2_d = date('d', strtotime($use[0][mail_stamp2]));
		
		$mail_stamp3_y = date('Y', strtotime($use[0][mail_stamp3]))+1;
		$mail_stamp3_m = date('m', strtotime($use[0][mail_stamp3]));
		$mail_stamp3_d = date('d', strtotime($use[0][mail_stamp3]));

		//閲覧終了日(現在登録されているものから１年後の日付)
		$end_stamp = date("Y-m-d", mktime(0, 0, 0, $use_end_m, $use_end_d, $use_end_y));
		
		//メール開始日1(現在登録されているものから１年後の日付)
		$mail_stamp1 = date("Y-m-d", mktime(0, 0, 0, $mail_stamp1_m, $mail_stamp1_d, $mail_stamp1_y));		

		//メール開始日2(現在登録されているものから１年後の日付)
		$mail_stamp2 = date("Y-m-d", mktime(0, 0, 0, $mail_stamp2_m, $mail_stamp2_d, $mail_stamp2_y));		

		//メール開始日3(現在登録されているものから１年後の日付)
		$mail_stamp3 = date("Y-m-d", mktime(0, 0, 0, $mail_stamp3_m, $mail_stamp3_d, $mail_stamp3_y));		

		$db->assign('password', $this->password);
		$db->assign('last_name', $this->last_name);
		$db->assign('first_name', $this->first_name);
		$db->assign('last_kana', $this->last_kana);
		$db->assign('first_kana', $this->first_kana);
		$db->assign('last_roman', $this->last_roman);
		$db->assign('first_roman', $this->first_roman);
		$db->assign('zip1', $this->zip1);
		$db->assign('zip2', $this->zip2);
		$db->assign('address1', $this->address1);
		$db->assign('address2', $this->address2);
		$db->assign('address3', $this->address3);
		$db->assign('tel', $this->tel);
		$db->assign('mail', $this->mail);
		$db->assign('sex', $this->sex);
		$db->assign('birth_year', $this->birth_year);
		$db->assign('birth_month', $this->birth_month);
		$db->assign('birth_day', $this->birth_day);

		foreach($orderList as $o_id) {
			$db->assign('order_no', $o_id['order_no']);
			$db->assign('order_desc_no', $o_id['order_desc_no']);
		}
		$db->assign('start_stamp', $start_stamp);
		$db->assign('end_stamp', $end_stamp);
		$db->assign('mail_stamp1', $mail_stamp1);
		$db->assign('mail_stamp2', $mail_stamp2);
		$db->assign('mail_stamp3', $mail_stamp3);

		//更新処理
		$db->statement('mori/mypage/update/sql/mori_user_insert.sql');

		$db->commit();

		/*
		 * メール設定
		 */
		$mailer = new Renderer();
		$mailer->assign($this->getProperties());
		$mailer->assign('orderDesc', $row);
		$mailer->assign('account_no', $this->account_no);
		$mailer->assign('password', $this->password);
		$mailer->assign('last_name', $this->last_name);
		$mailer->assign('first_name', $this->first_name);
		$mailer->assign('last_kana', $this->last_kana);
		$mailer->assign('first_kana', $this->first_kana);
		$mailer->assign('zip1', $this->zip1);
		$mailer->assign('zip2', $this->zip2);
		$mailer->assign('address1', $this->address1);
		$mailer->assign('address2', $this->address2);
		$mailer->assign('address3', $this->address3);
		$mailer->assign('tel', $this->tel);
		$mailer->assign('mail', $this->mail);
		$mailer->assign('sex', $this->sex);
		$mailer->assign('birth_year', $this->birth_year);
		$mailer->assign('birth_month', $this->birth_month);
		$mailer->assign('birth_day', $this->birth_day);

		//購入方法により本文の内容を変更
		if ($row['payment'] == "コンビニ決済") {
			$this->_subject = "「モリノナカマ」年会費お支払いに関しまして（コンビニ決済）";
		}
		if ($this->mail) {
			$customer = $this->convertEncodingHeader($row['name']) . '<' . $this->mail . '>';
		}
		else {
			$customer = $this->_system_mail;
		}
		$system = $this->convertEncodingHeader($this->_system_name) . '<' .$this->_system_mail . '>';
		$subject = $this->convertEncodingHeader($this->_subject);

		if ($row['payment'] == "コンビニ決済") {
			//FunkyJamへメール送信
			$mailer->assign('admin', 0);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			//数字8桁で返ってくるので、日付として表示させる。アサインしなおし。
			$payment_limit_date = $this->__limitDateFormat($this->payment_limit_date);
			$mailer->assign("payment_limit_date", $payment_limit_date);

			$convenience_stores = $this->dbTable("convenience_store", "convenience_store_no");
			$mailer->assign("convenience_stores", $convenience_stores);

			$body = $mailer->fetch('mori/mypage/update/mail/mail_paygent_cvs_customer.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $this->convertEncodingHeader('【'. $row["name"].'　様の'.$this->_subject . '】'), $body, $customer);

			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('mori/mypage/update/mail/mail_paygent_cvs_customer.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, $this->convertEncodingHeader('Send to confirmer from evolni【'. $row["name"].'　様の'.$this->_subject . '】'), $body, $system);
			}

			if ($this->mail) {
				//お客さまへメール送信
				$mailer->assign('admin', 0);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('mori/mypage/update/mail/mail_paygent_cvs.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}
			
			/*
			 * 情報を更新する
			 */
			$db->begin();
			$db->statement('mori/mypage/update/sql/update_mori_user.sql');
			$db->commit();

			/*
			 * apply_dateを更新する
			 */
			$db->begin();
			$db->statement('mori/mypage/update/sql/update_apply_date_order_desc.sql');
			$db->commit();
		}
		elseif ($row['payment'] == "カード決済（ペイジェント）") {
			//FunkyJamへメール送信
			$mailer->assign('admin', 1);
			$mailer->assign('noTourGoodsList', $noTourGoodsList);
			$body = $mailer->fetch('mori/mypage/update/mail/mail_paygent_card_customer.html');
			$body = $this->convertEncodingBody($body);
			$this->send($system, $this->convertEncodingHeader('【'. $row["name"].'　様の'.$this->_subject . '】'), $body, $customer);

			if (!empty($this->confirm_mail)) {
				//Send to Confirmer.
				$mailer->assign('admin', 0);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('mori/mypage/update/mail/mail_paygent_card_customer.html');
				$body = $this->convertEncodingBody($body);
				$this->send($this->confirm_mail, $this->convertEncodingHeader('Send to confirmer from evolni【'. $row["name"].'　様の'.$this->_subject . '】'), $body, $system);
			}

			if ($this->mail) {
				//お客さまへメール送信
				$mailer->assign('admin', 0);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				$body = $mailer->fetch('mori/mypage/update/mail/mail_paygent_card.html');
				$body = $this->convertEncodingBody($body);
				$this->send($customer, $subject, $body, $system);
			}

			/*
			 * 正しく決済された場合に、d_stampをnullにする
			 * 決済確定までに時間差がある場合は、確定のタイミングでd_stampをnullにする
			 */
			$db->begin();
			foreach($orderList as $orderRow) {
				$db->assign('order_no', $orderRow['order_no']);
				$db->statement('mori/mypage/update/sql/update_order.sql');
			}
			$db->statement('mori/mypage/update/sql/update_order_desc.sql');
			$db->commit();

			/*
			 * 更新で正しく決済された場合に、u_◯◯◯シリーズ（一時保存フィールド）を全てnullにして、
			 * 本フィールドに上書きする
			 */
			$db->begin();
			$db->statement('mori/mypage/update/sql/update_mori_card_user.sql');
			$db->commit();

			/*
			 * 情報を更新する
			 */
			//$db->begin();
			//$db->statement('mori/mypage/update/sql/update_mori_user.sql');
			//$db->commit();
			/*
			 * apply_dateを更新する
			 */
			$db->begin();
			$db->statement('mori/mypage/update/sql/update_apply_date_order_desc.sql');
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