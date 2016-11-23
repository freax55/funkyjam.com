<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL^E_NOTICE);

require_once(dirname(__FILE__) . '/../lib0904/simple/Database.php');
require_once(dirname(__FILE__) . '/../lib0904/simple/Renderer.php');
require_once(dirname(__FILE__) . '/../lib0904/util/DatabaseConnector.php');
require_once('config.php');

$db = new Database($url);
$db->connect();
$dbcn = new DatabaseConnector($db);


/**
 * @todo payment_statusが'40'の場合は消込済なので
 * 申し込み完了のメールを送る。
 */
$send_payment_status = "'40','43'";
$send_payment_type = "'01','03','05'";

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
$other_mail_code = 'A013';

$result = "";
$list = $dbcn->table("paygent_diff", "trading_id", null, "payment_type in({$send_payment_type}) and payment_status in({$send_payment_status}) and d_stamp is null");
$quickEstTradingIDList = $dbcn->table("paygent_diff", "trading_id", null, "payment_type in({$send_payment_type}) and payment_status = '43' and d_stamp is not null", "trading_id");

if(!empty($list)) {	
	$mailer = new Renderer();
	$mailer->template_dir = realpath(dirname(__FILE__) . '/..');
	
	foreach($list as $key => $row) {

		// 消込速報にて決済完了メールを送信している場合に、正式な消込を検知しても、メールを送信しないように制御
		if(!array_key_exists($key, $quickEstTradingIDList)) {
						
			//idの先頭を外す処理
			$order_id = $row["trading_id"];
			$distinction_code = substr($order_id, 0, 2);
			if(preg_match('/[a-zA-Z]$/', $distinction_code)){
				$order_id = substr_replace($order_id, "", 0,2);
			}
			
			$orderDesc = $dbcn->record("order_desc", "order_desc_no = {$order_id}");
			if(!empty($orderDesc)){

				$noTourGoodsList = $dbcn->table("\"order\"", "order_no", null, "order_desc_no = {$order_id}");

				//メール送信先毎に振り分け
				$tourGoodsList = array();
				foreach($noTourGoodsList as $order) {
					if($order['category_code'] == $other_mail_code){
						$tourGoodsList[] = $noTourGoodsList[$order['order_no']];
						unset($noTourGoodsList[$order['order_no']]);
					}
				}
				$mailer->assign('tourGoodsList', $tourGoodsList);
				$mailer->assign('noTourGoodsList', $noTourGoodsList);
				
				/*
				 * 値の設定
				 */
				$evolni = array();
				$customer = array();
				
				$ticket = $dbcn->table("\"order\"", "order_no", null, "order_desc_no = {$order_id} AND category_code = 'A011'");
				$baribaricrew = $dbcn->table("\"order\"", "order_no", null, "order_desc_no = {$order_id} AND category_code = 'BariBariCrew'");
				$yearsPASS = $dbcn->table("\"order\"", "order_no", null, "order_desc_no = {$order_id} AND category_code = 'yearsPASS'");
				$moriYearsPass = $dbcn->table("\"order\"", "order_no", null, "order_desc_no = {$order_id} AND category_code = 'moriYearsPass'");
				if(count($ticket)) {
					//funkyjam
					/**
					 * 決済方法の表記を変える
					 * 「モバイル版FJSHOP 」を取って、「（モバイル）」を付ける
					 */
					$orderDesc['payment'] = mb_ereg_replace('モバイル版FJSHOP (.+)', '\1（モバイル）', $orderDesc['payment']);
					
					// evol-ni へ 確認メール送信
					$evolni['to'] = $evolni_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$evolni['body'] = $mailer->fetch('paygent_diff/ticket_mail.html');
					$evolni['subject'] = "Send to confirmer from FJSHOP.";
					$evolni['from'] = $ticket_mail;
					
					//customer
					/**
					 * 決済方法の表記を変える
					 * 「（モバイル）」を取る
					 */
					$orderDesc['payment'] = mb_ereg_replace('（モバイル）', '', $orderDesc['payment']);
					
					$mailer->assign("orderDesc",$orderDesc);
					$customer['body'] = $mailer->fetch('paygent_diff/ticket_mail.html');
					$customer['subject'] = "入金ありがとうございました";
					$customer['from'] = $ticket_mail;
					
					// funkyjam
					$fj = array();
					$fj['to'] = $ticket_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$fj['body'] = $mailer->fetch('paygent_diff/ticket_mail.html');
					$fj['subject'] = "入金ありがとうございました";
					
					$fj['body'] = convertEncodingBody($fj['body']);
					$fj['subject'] = convertEncodingHeader($fj['subject']);
					$fj['from'] = convertEncodingHeader($orderDesc['name']) . '<' . $orderDesc['mail'] . '>';
					send($fj['to'], $fj['subject'], $fj['body'], $fj['from']);
					
				}
				elseif(count($baribaricrew)) {
					//funkyjam
					/**
					 * 決済方法の表記を変える
					 * 「モバイル版FJSHOP 」を取って、「（モバイル）」を付ける
					 */
					$orderDesc['payment'] = mb_ereg_replace('モバイル版FJSHOP (.+)', '\1（モバイル）', $orderDesc['payment']);
					
					// evol-ni へ 確認メール送信
					$evolni['to'] = $evolni_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$evolni['body'] = $mailer->fetch('paygent_diff/baribaricrew_mail.html');
					$evolni['subject'] = "ご入金ありがとうございました（コンビニ・年会費・エボルニ）";
					$evolni['from'] = $baribaricrew_mail;
					
					//customer
					/**
					 * 決済方法の表記を変える
					 * 「（モバイル）」を取る
					 */
					$orderDesc['payment'] = mb_ereg_replace('（モバイル）', '', $orderDesc['payment']);
					
					$mailer->assign("orderDesc",$orderDesc);
					$customer['body'] = $mailer->fetch('paygent_diff/baribaricrew_mail.html');
					$customer['subject'] = "ご入金ありがとうございました（コンビニ・年会費）";
					$customer['from'] = $baribaricrew_mail;
					
					// funkyjam
					$fj = array();
					$fj['to'] = $baribaricrew_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$fj['body'] = $mailer->fetch('paygent_diff/baribaricrew_mail.html');
					$fj['subject'] = "ご入金ありがとうございました（コンビニ・年会費）";
					
					$fj['body'] = convertEncodingBody($fj['body']);
					$fj['subject'] = convertEncodingHeader($fj['subject']);
					$fj['from'] = convertEncodingHeader($orderDesc['name']) . '<' . $orderDesc['mail'] . '>';
					send($fj['to'], $fj['subject'], $fj['body'], $fj['from']);
					
				}
				elseif(count($yearsPASS)) {
					//funkyjam
					/**
					 * 決済方法の表記を変える
					 * 「モバイル版FJSHOP 」を取って、「（モバイル）」を付ける
					 */
					$orderDesc['payment'] = mb_ereg_replace('モバイル版FJSHOP (.+)', '\1（モバイル）', $orderDesc['payment']);
					
					$sp_from = convertEncodingHeader("FJプレミアムページ");
					$sp_from .= " <premium@funkyjam.com>";

					// evol-ni へ 確認メール送信
					$evolni['to'] = $evolni_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$evolni['body'] = $mailer->fetch('paygent_diff/yearsPASS_mail.html');
					$evolni['subject'] = "【FJ PREMIUM】入金ありがとうございました（エボルニ）";
					$evolni['from'] = $sp_from;
					
					//customer
					/**
					 * 決済方法の表記を変える
					 * 「（モバイル）」を取る
					 */
					$orderDesc['payment'] = mb_ereg_replace('（モバイル）', '', $orderDesc['payment']);
					
					$mailer->assign("orderDesc",$orderDesc);
					$customer['body'] = $mailer->fetch('paygent_diff/yearsPASS_mail.html');
					$customer['subject'] = "【FJ PREMIUM】入金ありがとうございました";
					$customer['from'] = $sp_from;
					
					// funkyjam
					$fj = array();
					$fj['to'] = $yearsPASS_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$fj['body'] = $mailer->fetch('paygent_diff/yearsPASS_mail.html');
					$fj['subject'] = "【FJ PREMIUM】入金ありがとうございました";
					
					$fj['body'] = convertEncodingBody($fj['body']);
					$fj['subject'] = convertEncodingHeader($fj['subject']);
					$fj['from'] = convertEncodingHeader($orderDesc['name']) . '<' . $orderDesc['mail'] . '>';
					send($fj['to'], $fj['subject'], $fj['body'], $fj['from']);
					
				}
				elseif(count($moriYearsPass)) {
					/**
					 * 決済方法の表記を変える
					 * 「モバイル版FJSHOP 」を取って、「（モバイル）」を付ける
					 */
					$orderDesc['payment'] = mb_ereg_replace('モバイル版FJSHOP (.+)', '\1（モバイル）', $orderDesc['payment']);
					
					$sp_from = convertEncodingHeader("モリノナカマ");
					$sp_from .= " <artist_mori@funkyjam.com>";

					// evol-ni へ 確認メール送信
					$evolni['to'] = $evolni_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$evolni['body'] = $mailer->fetch('paygent_diff/mail/mori/mori_cvs_mail.html');
					$evolni['subject'] = "Send to confirmer from evolni【".$orderDesc['name']."　様の「モリノナカマ」ご入金確認致しました";
					$evolni['from'] = $sp_from;
					
					//customer
					/**
					 * 決済方法の表記を変える
					 * 「（モバイル）」を取る
					 */
					$orderDesc['payment'] = mb_ereg_replace('（モバイル）', '', $orderDesc['payment']);
					
					$mailer->assign("orderDesc",$orderDesc);
					$customer['body'] = $mailer->fetch('paygent_diff/mail/mori/mori_cvs_mail_customer.html');
					$customer['subject'] = "「モリノナカマ」ご入金確認致しました";
					$customer['from'] = $sp_from;
					
					// funkyjam
					$fj = array();
					$fj['to'] = $moriYearsPass_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$fj['body'] = $mailer->fetch('paygent_diff/mail/mori/mori_cvs_mail.html');
					$fj['subject'] = "F【".$orderDesc['name']."　様の「モリノナカマ」ご入金確認致しました";
					
					$fj['body'] = convertEncodingBody($fj['body']);
					$fj['subject'] = convertEncodingHeader($fj['subject']);
					$fj['from'] = convertEncodingHeader($orderDesc['name']) . '<' . $orderDesc['mail'] . '>';
					send($fj['to'], $fj['subject'], $fj['body'], $fj['from']);
					
				}
				else {
					//funkyjam
					/**
					 * 決済方法の表記を変える
					 * 「モバイル版FJSHOP 」を取って、「（モバイル）」を付ける
					 */
					$orderDesc['payment'] = mb_ereg_replace('モバイル版FJSHOP (.+)', '\1（モバイル）', $orderDesc['payment']);
					
					$fj = array();
					$fj['to'] = $shop_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$fj['body'] = $mailer->fetch('paygent_diff/mail_admin.html');
					$fj['subject'] = "購入内容のご確認";
					
					$fj['body'] = convertEncodingBody($fj['body']);
					$fj['subject'] = convertEncodingHeader($fj['subject']);
					$fj['from'] = convertEncodingHeader($orderDesc['name']) . '<' . $orderDesc['mail'] . '>';
					send($fj['to'], $fj['subject'], $fj['body'], $fj['from']);
					
					// evol-ni へ 確認メール送信
					$evolni['to'] = $evolni_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$evolni['body'] = $mailer->fetch('paygent_diff/mail.html');
					$evolni['subject'] = "Send to confirmer from FJSHOP.";
					$evolni['from'] = $shop_mail;
					
					//customer
					/**
					 * 決済方法の表記を変える
					 * 「（モバイル）」を取る
					 */
					$orderDesc['payment'] = mb_ereg_replace('（モバイル）', '', $orderDesc['payment']);
					
					$mailer->assign("orderDesc",$orderDesc);
					$customer['body'] = $mailer->fetch('paygent_diff/mail.html');
					$customer['subject'] = "入金ありがとうございました";
					$customer['from'] = $shop_mail;
				}

				// evol-ni へ 確認メール送信
				$evolni['body'] = convertEncodingBody($evolni['body']);
				$evolni['subject'] = convertEncodingHeader($evolni['subject']);
				send($evolni['to'], $evolni['subject'], $evolni['body'], $evolni['from']);

				//customer
				$customer['to'] = $orderDesc['mail'];
				$customer['body'] = convertEncodingBody($customer['body']);
				$customer['subject'] = convertEncodingHeader($customer['subject']);
				if(send($customer['to'], $customer['subject'], $customer['body'], $customer['from'])) {
					$dbcn->query("update paygent_diff set d_stamp = current_timestamp where trading_id='{$row["trading_id"]}';");
				}

			}
		} else {
			$dbcn->query("update paygent_diff set d_stamp = current_timestamp where trading_id='{$row["trading_id"]}';");
		}

	}

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
	$str = convertEncodingBody($str, $enc);
	$str = '=?iso-2022-jp?B?' . base64_encode($str) . '?=';

	return $str;
}

/**
 * Send mail.
 * @access private
 */
function send($to, $subject, $body, $from) {
	return mail($to, $subject, $body, "From: " . $from);
}

?>
