<?php
/*test���֤Υѥ��λ���*/
/*/usr/bin/php /home/fj_test/public_html/premium/insert/test.php*/
/*�����ƥ�ν���*/
	
ini_set('display_errors', 'on');
error_reporting(E_ALL^E_NOTICE);

require_once(dirname(__FILE__) . '/../../lib0904/simple/Database.php');
require_once(dirname(__FILE__) . '/../../lib0904/simple/Renderer.php');
require_once(dirname(__FILE__) . '/../../lib0904/util/DatabaseConnector.php');

/*DBNEW*/
$url = 'pgsql://funkyjam:funkyjam@localhost:5432/fj_db';
if(strpos($_SERVER['HTTP_HOST'], 'test.') !== false) {
	$url = 'pgsql://funkyjam:Wi2Mi9gm@localhost:5432/fj_db_test';
}
$db = new Database($url);
$db->connect();
$dbcn = new DatabaseConnector($db);	
$db->begin();

//���������դ����
$start = date("Y-m-d", mktime(0, 0, 0, date("n"), date("d"), date("Y")));
//$start = date("Y-m-d", mktime(0, 0, 0, 11, 21, 2016));

$list = "";

//Ʊ�����դΤ�Τ����
$db->assign('start', $start);
$db->assign('stampNo', '1');
$result = $db->statement(dirname(__FILE__).'/../sql/mori/mail_update_contact_list.sql');
$list1 = $db->buildTree($result);

$db->assign('stampNo', '2');
$result = $db->statement(dirname(__FILE__).'/../sql/mori/mail_update_contact_list.sql');
$list2 = $db->buildTree($result);

$db->assign('stampNo', '3');
$result = $db->statement(dirname(__FILE__).'/../sql/mori/mail_update_contact_list.sql');
$list3 = $db->buildTree($result);

$list = array_merge($list1,$list2,$list3);

if(!empty($list)){

	$mailer = new Renderer();
	//�᡼��ν����ˤ��ä�����
	$from = convertEncodingHeader("���Υʥ���");
	$from .= " <artist_mori@funkyjam.com>";
	$subject = "�֥��Υʥ��ޡ� �����ͭ�����¤˴ؤ��ޤ���";
	$subject_n = convertEncodingHeader($subject);

	foreach ($list as $value) {

		$mailer->assign("name",$value[name]);
		$mailer->assign("end",$value[end_stamp]);
		$body = $mailer->fetch(dirname(__FILE__).'/../mail/mori/mail_update_contact.html');
		$body = convertEncodingBody($body);

		//�����ͤإ᡼������
		$to = $value[mail];
		send($to, $subject_n, $body, $from);


		//�������ޡ���
		$subject_c = "��".$value[name]." �ͤ�".$subject."��";
		$subject_c = convertEncodingHeader($subject_c);
		$body = $mailer->fetch(dirname(__FILE__).'/../mail/mori/mail_update_contact_customer.html');
		$body = convertEncodingBody($body);

		//FJ�˥᡼������
		$to = "artist_mori@funkyjam.com";
		send($to, $subject_c, $body, $from);

		//���ܥ�ˤ˥᡼������
		$to = "kida@evol-ni.com";
		send($to, "Send to confirmer from evolni".$subject_c, $body, $from);
	}
	echo "������ͭ�������ڤ�᡼����������ޤ���";
	return true;

}else{
	echo "������ͭ�������ڤ�᡼��Ϥ���ޤ���Ǥ�����";
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