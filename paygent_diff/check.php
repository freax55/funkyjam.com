<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL^E_NOTICE);

require_once(dirname(__FILE__) . '/../lib0904/util/paygent/Paygent.php');
require_once(dirname(__FILE__) . '/../lib0904/simple/Database.php');
require_once(dirname(__FILE__) . '/../lib0904/simple/Renderer.php');
require_once(dirname(__FILE__) . '/../lib0904/util/DatabaseConnector.php');
require_once('config.php');

$p = new Paygent();
$p->init();

$params = array(
	"merchant_id" => MERCHANT_ID,
	"connect_id" => CONNECT_ID,
	"connect_password" => CONNECT_PASSWORD,
	"telegram_kind" => '091',
	"telegram_version" => TELEGRAM_VERSION,
);

$p->set($params);


$db = new Database($url);
$db->connect();
$dbcn = new DatabaseConnector($db);

//$result = $db->statement(dirname(__FILE__) . '/sql/last_id.sql');
//$row = $db->fetch_assoc($result);
//$lastID = $row['id'];
$lastID = 0;
$db->assign('last_id', $lastID);

$response = $p->run();

if(!$response){
	echo "��ѽ�����Ϣ�Ȥ˼��Ԥ��ޤ���";
	exit();
}
//echo '<pre>';
//var_dump($params);
//var_dump($response);
//echo '</pre>';

if(insertData($db, $response)) {
} else {
//	exit();
}

/*
 * �ǡ������ʤ��ʤ�ޤǼ����򷫤��֤�����
 */
while($response[0]['success_code'] == 0) {
	$response = $p->run();
	if(insertData($db, $response)) {
	} else {
	}
}
/*
 * ��ꤳ�ܤ��γ�ǧ��
 */
$result = $db->statement(dirname(__FILE__) . '/sql/fall_id.sql');
$list = $db->buildTree($result, 'id');
$idList = array_keys($list);

if(!$list) {
	exit();
}


$newLastID = $dbcn->valQuery("SELECT coalesce(max(id), 0) AS id FROM paygent_diff");
$fallList = array();
for($i = $lastID+1 ; $i < $newLastID ; $i++){
	if( !in_array($i, $idList)){
		$fallList[] = $i;
	}
}

//foreach($list as $key => $row) {
//	if(!$list[$row['id'] + 1]) {
//		$fallList[] = $row['id'] + 1;
//	}
//}

/*
 * fallList�κǸ�����Ǥˡ����˼��������Ǥ���ID�����äƤ���ΤǤ������
 */
//array_pop($fallList);

if(!empty($fallList)) {
	foreach($fallList as $fallID) {
//		do{

			$params['payment_notice_id'] = $fallID;
			$p->set($params);
			$response = $p->run();

//		} while( $response[0]['success_code'] != 1 );

		if(insertData($db, $response)) {
		} else {
		}
		
	}
} else {
	exit();
}

//��ꤳ�ܤ���ǧ�᡼������
$mailer = new Renderer();
$mailer->template_dir = realpath(dirname(__FILE__) . '/..');
$to = "kida@evol-ni.com";
$from = "info@funkyjam.com";
$subject = "paygent_diff��ꤳ�ܤ������å�";
$subject = convertEncodingHeader($subject);
$mailer->assign('fallList', $fallList);
$body = $mailer->fetch('paygent_diff/check_mail.html');
$body = convertEncodingBody($body);
send($to, $subject, $body, $from);



/**
 * insert paygent diff data
 *
 * @param &$db
 * @param $response
 *
 * @todo $db���������Ϥ��Ƥ��뤫��ǧ����ɬ�פ��ꡣ
 */
function insertData(&$db, $response) {
	if($response[0]['success_code'] != 0) {
		return false;
	}
	
//	echo '<pre>';
//	var_dump($response);
//	echo '</pre>';

	$db->begin();
	$result = $db->statement(dirname(__FILE__) . '/sql/lock_table.sql');

	foreach($response as $res) {
		if(isset($res['3dsecure_ryaku'])) {
			$res['three_d_secure_ryaku'] = $res['3dsecure_ryaku'];
			unset($res['3dsecure_ryaku']);
		}
		
		//id����Ƭ�򳰤�����
		$order_id = $res["trading_id"];
		$distinction_code = substr($order_id, 0, 2);
		if(preg_match('/[a-zA-Z]$/', $distinction_code)){
			$order_id = substr_replace($order_id, "", 0,2);
		}
		$res["order_id"] = $order_id;
		
		mb_convert_variables('EUC-JP', 'SJIS', $res);
		$db->assign($res);
		$dbcn = new DatabaseConnector($db);
		$rs = $dbcn->valQuery("select id from paygent_diff where payment_notice_id = '{$res["payment_notice_id"]}'");
		if(empty($rs)) {
			$db->statement(dirname(__FILE__) . '/sql/insert.sql');
			
			/*
			 * payment_status��40or43�ʾù����ä�����®��ˤξ���
			 * ����ӥˡ�ATM�ʤɤ�d_stamp�ʷ�ѳ���ե饰��null����ѳ���ˡˤ�null�ˤ���
			 */
			if($res["payment_status"] == 40 || $res["payment_status"] == 43) {
				$db->statement(dirname(__FILE__) . '/sql/update_d_stamp_order_desc.sql');
				$db->statement(dirname(__FILE__) . '/sql/update_d_stamp_order.sql');
				/*
				 *order_id ���顡�ץ�ߥ���桼�����򻲾Ȥ��ˤ��ä�u_�������ͤ������
				 *�����¸�ե�����ɤ���ǡ�����ʹߤ��������ȯ�Ԥ���
				*/
				//�������󤹤�ǡ������������
				//�ץ�ߥ�����
				$list_p = "";
				$result_p = $db->statement(dirname(__FILE__) . '/sql/premium_u_date.sql');
				$list_p = $db->buildTree($result_p);
				if($list_p){
					$db->assign('u_start_stamp', $list_p['0']['u_start_stamp']);
					$db->assign('u_end_stamp', $list_p['0']['u_end_stamp']);
					$db->assign('u_mail_stamp', $list_p['0']['u_mail_stamp']);
					$db->assign('u_order_no', $list_p['0']['u_order_no']);
					$db->assign('u_order_desc_no', $list_p['0']['u_order_desc_no']);
					$db->statement(dirname(__FILE__) . '/sql/premium_u_date_update.sql');
				}
				//���ѹ������򸽺߻�����ѹ�������
				$list_p = "";
				$result_p = $db->statement(dirname(__FILE__) . '/sql/mori_user_date.sql');
				$list_p = $db->buildTree($result_p);
				if($list_p){
					//�����ॹ����פϷ�ѥ����ߥ󥰤��ѹ�
					//����������
					$start_stamp = date("Y-m-d", mktime(0, 0, 0, date("n"), date("j"), date("Y")));
					//������λ��
					$end_stamp = date("Y-m-d", mktime(0, 0, 0, date("n"), date("j")-1, date("Y")+1));
					//�᡼�볫����1
					$mail_stamp1 = date("Y-m-d", mktime(0, 0, 0, date("n")-1, date("j"), date("Y")+1));
					//�᡼�볫����2
					$mail_stamp2 = date("Y-m-d", mktime(0, 0, 0, date("n"), date("j")-15, date("Y")+1));
					//�᡼�볫����3
					$mail_stamp3 = date("Y-m-d", mktime(0, 0, 0, date("n"), date("j")-2, date("Y")+1));
					$db->assign('start_stamp', $start_stamp);
					$db->assign('end_stamp', $end_stamp);
					$db->assign('mail_stamp1',$mail_stamp1);
					$db->assign('mail_stamp2', $mail_stamp2);
					$db->assign('mail_stamp3', $mail_stamp3);
					$db->statement(dirname(__FILE__) . '/sql/mori_user_date_update.sql');
				}
				//����
				$list_p = "";
				$result_p = $db->statement(dirname(__FILE__) . '/sql/mori_user_u_date.sql');
				$list_p = $db->buildTree($result_p);
				if($list_p){
					$db->assign('u_order_no', $list_p['0']['u_order_no']);
					$db->assign('u_order_desc_no', $list_p['0']['u_order_desc_no']);
					//�����ॹ����פϷ�ѥ����ߥ󥰤��ѹ�
					$db->assign('u_start_stamp', $list_p['0']['u_start_stamp']);
					$db->assign('u_end_stamp', $list_p['0']['u_end_stamp']);
					$db->assign('u_mail_stamp1', $list_p['0']['u_mail_stamp1']);
					$db->assign('u_mail_stamp2', $list_p['0']['u_mail_stamp2']);
					$db->assign('u_mail_stamp3', $list_p['0']['u_mail_stamp3']);
					$db->statement(dirname(__FILE__) . '/sql/mori_user_u_date_update.sql');
				}
			}
			/*
			 * payment_status��12or43�ʻ�ʧ�������ڤ�ˤξ���
			 * delete_flg��Ω�����ƺ��٥��ɥ쥹����Ѳ�ǽ�ˤ���
			 */
			if($res["payment_status"] == 12) {
				//�ץ�ߥ�����
				$db->statement(dirname(__FILE__) . '/sql/premium_delete.sql');
				//����
				$db->assign('reason', "��������ڤ�");
				$db->statement(dirname(__FILE__) . '/sql/mori/mori_user_delete.sql');
			}
		}
	}
	$db->commit();

	return true;
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
	mail($to, $subject, $body, "From: " . $from);
}

?>
