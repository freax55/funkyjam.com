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
 * @todo payment_status��'40'�ξ��Ͼù��ѤʤΤ�
 * �������ߴ�λ�Υ᡼������롣
 */
$send_payment_status = "'40','43'";
$send_payment_type = "'01','03','05'";

/**
 * $this->_other_mail�䡢$tourGoodsList�ʤɤ�
 * 2003ǯ���ε����������Υĥ������å�����κݤ˻��Ѥ����ѥ�᡼����
 * �ĥ������å���category_code='A013'�Ȥ������ƥ���ˤʤäƤ��롣
 * ����ϡ��ĥ������å������̤β�Ҥ��������Ƥ����ΤǤ��Τ褦���б���ɬ�פȤʤä���
 * 2010ǯ�Υĥ������å��ˤĤ��Ƥϡ�funkyjam�Ǵ�����
 * ��������פˤʤ뤫�⤷��ޤ��󡣤�����ե�������󥰤λ��֤��ʤ��ΤǤȤꤢ�����ޥޤǤ���
 *
 * 2010/10/01 �и�
 */
$other_mail_code = 'A013';

$result = "";
$list = $dbcn->table("paygent_diff", "trading_id", null, "payment_type in({$send_payment_type}) and payment_status in({$send_payment_status}) and d_stamp is null");
$quickEstTradingIDList = $dbcn->table("paygent_diff", "trading_id", null, "payment_type in({$send_payment_type}) and payment_status = '43' and d_stamp is not null", "trading_id");

if(!empty($list)) {	
	$mailer = new Renderer();
	$mailer->template_dir = realpath(dirname(__FILE__) . '/..');
	
	foreach($list as $key => $row) {

		// �ù�®��ˤƷ�Ѵ�λ�᡼����������Ƥ�����ˡ������ʾù����Τ��Ƥ⡢�᡼����������ʤ��褦������
		if(!array_key_exists($key, $quickEstTradingIDList)) {
						
			//id����Ƭ�򳰤�����
			$order_id = $row["trading_id"];
			$distinction_code = substr($order_id, 0, 2);
			if(preg_match('/[a-zA-Z]$/', $distinction_code)){
				$order_id = substr_replace($order_id, "", 0,2);
			}
			
			$orderDesc = $dbcn->record("order_desc", "order_desc_no = {$order_id}");
			if(!empty($orderDesc)){

				$noTourGoodsList = $dbcn->table("\"order\"", "order_no", null, "order_desc_no = {$order_id}");

				//�᡼����������˿���ʬ��
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
				 * �ͤ�����
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
					 * �����ˡ��ɽ�����Ѥ���
					 * �֥�Х�����FJSHOP �פ��äơ��֡ʥ�Х���ˡפ��դ���
					 */
					$orderDesc['payment'] = mb_ereg_replace('��Х�����FJSHOP (.+)', '\1�ʥ�Х����', $orderDesc['payment']);
					
					// evol-ni �� ��ǧ�᡼������
					$evolni['to'] = $evolni_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$evolni['body'] = $mailer->fetch('paygent_diff/ticket_mail.html');
					$evolni['subject'] = "Send to confirmer from FJSHOP.";
					$evolni['from'] = $ticket_mail;
					
					//customer
					/**
					 * �����ˡ��ɽ�����Ѥ���
					 * �֡ʥ�Х���ˡפ���
					 */
					$orderDesc['payment'] = mb_ereg_replace('�ʥ�Х����', '', $orderDesc['payment']);
					
					$mailer->assign("orderDesc",$orderDesc);
					$customer['body'] = $mailer->fetch('paygent_diff/ticket_mail.html');
					$customer['subject'] = "���⤢�꤬�Ȥ��������ޤ���";
					$customer['from'] = $ticket_mail;
					
					// funkyjam
					$fj = array();
					$fj['to'] = $ticket_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$fj['body'] = $mailer->fetch('paygent_diff/ticket_mail.html');
					$fj['subject'] = "���⤢�꤬�Ȥ��������ޤ���";
					
					$fj['body'] = convertEncodingBody($fj['body']);
					$fj['subject'] = convertEncodingHeader($fj['subject']);
					$fj['from'] = convertEncodingHeader($orderDesc['name']) . '<' . $orderDesc['mail'] . '>';
					send($fj['to'], $fj['subject'], $fj['body'], $fj['from']);
					
				}
				elseif(count($baribaricrew)) {
					//funkyjam
					/**
					 * �����ˡ��ɽ�����Ѥ���
					 * �֥�Х�����FJSHOP �פ��äơ��֡ʥ�Х���ˡפ��դ���
					 */
					$orderDesc['payment'] = mb_ereg_replace('��Х�����FJSHOP (.+)', '\1�ʥ�Х����', $orderDesc['payment']);
					
					// evol-ni �� ��ǧ�᡼������
					$evolni['to'] = $evolni_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$evolni['body'] = $mailer->fetch('paygent_diff/baribaricrew_mail.html');
					$evolni['subject'] = "�����⤢�꤬�Ȥ��������ޤ����ʥ���ӥˡ�ǯ���񡦥��ܥ�ˡ�";
					$evolni['from'] = $baribaricrew_mail;
					
					//customer
					/**
					 * �����ˡ��ɽ�����Ѥ���
					 * �֡ʥ�Х���ˡפ���
					 */
					$orderDesc['payment'] = mb_ereg_replace('�ʥ�Х����', '', $orderDesc['payment']);
					
					$mailer->assign("orderDesc",$orderDesc);
					$customer['body'] = $mailer->fetch('paygent_diff/baribaricrew_mail.html');
					$customer['subject'] = "�����⤢�꤬�Ȥ��������ޤ����ʥ���ӥˡ�ǯ�����";
					$customer['from'] = $baribaricrew_mail;
					
					// funkyjam
					$fj = array();
					$fj['to'] = $baribaricrew_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$fj['body'] = $mailer->fetch('paygent_diff/baribaricrew_mail.html');
					$fj['subject'] = "�����⤢�꤬�Ȥ��������ޤ����ʥ���ӥˡ�ǯ�����";
					
					$fj['body'] = convertEncodingBody($fj['body']);
					$fj['subject'] = convertEncodingHeader($fj['subject']);
					$fj['from'] = convertEncodingHeader($orderDesc['name']) . '<' . $orderDesc['mail'] . '>';
					send($fj['to'], $fj['subject'], $fj['body'], $fj['from']);
					
				}
				elseif(count($yearsPASS)) {
					//funkyjam
					/**
					 * �����ˡ��ɽ�����Ѥ���
					 * �֥�Х�����FJSHOP �פ��äơ��֡ʥ�Х���ˡפ��դ���
					 */
					$orderDesc['payment'] = mb_ereg_replace('��Х�����FJSHOP (.+)', '\1�ʥ�Х����', $orderDesc['payment']);
					
					$sp_from = convertEncodingHeader("FJ�ץ�ߥ���ڡ���");
					$sp_from .= " <premium@funkyjam.com>";

					// evol-ni �� ��ǧ�᡼������
					$evolni['to'] = $evolni_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$evolni['body'] = $mailer->fetch('paygent_diff/yearsPASS_mail.html');
					$evolni['subject'] = "��FJ PREMIUM�����⤢�꤬�Ȥ��������ޤ����ʥ��ܥ�ˡ�";
					$evolni['from'] = $sp_from;
					
					//customer
					/**
					 * �����ˡ��ɽ�����Ѥ���
					 * �֡ʥ�Х���ˡפ���
					 */
					$orderDesc['payment'] = mb_ereg_replace('�ʥ�Х����', '', $orderDesc['payment']);
					
					$mailer->assign("orderDesc",$orderDesc);
					$customer['body'] = $mailer->fetch('paygent_diff/yearsPASS_mail.html');
					$customer['subject'] = "��FJ PREMIUM�����⤢�꤬�Ȥ��������ޤ���";
					$customer['from'] = $sp_from;
					
					// funkyjam
					$fj = array();
					$fj['to'] = $yearsPASS_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$fj['body'] = $mailer->fetch('paygent_diff/yearsPASS_mail.html');
					$fj['subject'] = "��FJ PREMIUM�����⤢�꤬�Ȥ��������ޤ���";
					
					$fj['body'] = convertEncodingBody($fj['body']);
					$fj['subject'] = convertEncodingHeader($fj['subject']);
					$fj['from'] = convertEncodingHeader($orderDesc['name']) . '<' . $orderDesc['mail'] . '>';
					send($fj['to'], $fj['subject'], $fj['body'], $fj['from']);
					
				}
				elseif(count($moriYearsPass)) {
					/**
					 * �����ˡ��ɽ�����Ѥ���
					 * �֥�Х�����FJSHOP �פ��äơ��֡ʥ�Х���ˡפ��դ���
					 */
					$orderDesc['payment'] = mb_ereg_replace('��Х�����FJSHOP (.+)', '\1�ʥ�Х����', $orderDesc['payment']);
					
					$sp_from = convertEncodingHeader("���Υʥ���");
					$sp_from .= " <artist_mori@funkyjam.com>";

					// evol-ni �� ��ǧ�᡼������
					$evolni['to'] = $evolni_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$evolni['body'] = $mailer->fetch('paygent_diff/mail/mori/mori_cvs_mail.html');
					$evolni['subject'] = "Send to confirmer from evolni��".$orderDesc['name']."���ͤΡ֥��Υʥ��ޡפ������ǧ�פ��ޤ���";
					$evolni['from'] = $sp_from;
					
					//customer
					/**
					 * �����ˡ��ɽ�����Ѥ���
					 * �֡ʥ�Х���ˡפ���
					 */
					$orderDesc['payment'] = mb_ereg_replace('�ʥ�Х����', '', $orderDesc['payment']);
					
					$mailer->assign("orderDesc",$orderDesc);
					$customer['body'] = $mailer->fetch('paygent_diff/mail/mori/mori_cvs_mail_customer.html');
					$customer['subject'] = "�֥��Υʥ��ޡפ������ǧ�פ��ޤ���";
					$customer['from'] = $sp_from;
					
					// funkyjam
					$fj = array();
					$fj['to'] = $moriYearsPass_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$fj['body'] = $mailer->fetch('paygent_diff/mail/mori/mori_cvs_mail.html');
					$fj['subject'] = "F��".$orderDesc['name']."���ͤΡ֥��Υʥ��ޡפ������ǧ�פ��ޤ���";
					
					$fj['body'] = convertEncodingBody($fj['body']);
					$fj['subject'] = convertEncodingHeader($fj['subject']);
					$fj['from'] = convertEncodingHeader($orderDesc['name']) . '<' . $orderDesc['mail'] . '>';
					send($fj['to'], $fj['subject'], $fj['body'], $fj['from']);
					
				}
				else {
					//funkyjam
					/**
					 * �����ˡ��ɽ�����Ѥ���
					 * �֥�Х�����FJSHOP �פ��äơ��֡ʥ�Х���ˡפ��դ���
					 */
					$orderDesc['payment'] = mb_ereg_replace('��Х�����FJSHOP (.+)', '\1�ʥ�Х����', $orderDesc['payment']);
					
					$fj = array();
					$fj['to'] = $shop_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$fj['body'] = $mailer->fetch('paygent_diff/mail_admin.html');
					$fj['subject'] = "�������ƤΤ���ǧ";
					
					$fj['body'] = convertEncodingBody($fj['body']);
					$fj['subject'] = convertEncodingHeader($fj['subject']);
					$fj['from'] = convertEncodingHeader($orderDesc['name']) . '<' . $orderDesc['mail'] . '>';
					send($fj['to'], $fj['subject'], $fj['body'], $fj['from']);
					
					// evol-ni �� ��ǧ�᡼������
					$evolni['to'] = $evolni_mail;
					$mailer->assign("orderDesc",$orderDesc);
					$evolni['body'] = $mailer->fetch('paygent_diff/mail.html');
					$evolni['subject'] = "Send to confirmer from FJSHOP.";
					$evolni['from'] = $shop_mail;
					
					//customer
					/**
					 * �����ˡ��ɽ�����Ѥ���
					 * �֡ʥ�Х���ˡפ���
					 */
					$orderDesc['payment'] = mb_ereg_replace('�ʥ�Х����', '', $orderDesc['payment']);
					
					$mailer->assign("orderDesc",$orderDesc);
					$customer['body'] = $mailer->fetch('paygent_diff/mail.html');
					$customer['subject'] = "���⤢�꤬�Ȥ��������ޤ���";
					$customer['from'] = $shop_mail;
				}

				// evol-ni �� ��ǧ�᡼������
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
