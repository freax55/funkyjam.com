<?php
/*test���֤Υѥ��λ���*/
/*/usr/bin/php /home/fj_test/public_html/premium/insert/test.php*/
/*�����ƥ�ν���*/
	
ini_set('display_errors', 'on');
error_reporting(E_ALL^E_NOTICE);

require_once(dirname(__FILE__) . '/../../../lib0904/simple/Database.php');
require_once(dirname(__FILE__) . '/../../../lib0904/simple/Renderer.php');
require_once(dirname(__FILE__) . '/../../../lib0904/util/DatabaseConnector.php');

/*DBNEW*/
//$url = 'pgsql://funkyjam:Wi2Mi9gm@localhost:5432/fj_db_test';
$url = 'pgsql://funkyjam:funkyjam@localhost:5432/fj_db';
$db = new Database($url);
$db->connect();
$dbcn = new DatabaseConnector($db);	
$db->begin();

//���߻��֤���1���������
$start = date("Y-m-d", mktime(0, 0, 0, date("n"), date("d"), date("Y")));

//start���դ��
$db->assign('start', $start);
$result = $db->statement(dirname(__FILE__).'/sql/mail_list.sql');
$list = $db->buildTree($result);

$mailer = new Renderer();

//�᡼��ν����ˤ��ä�����
$from = convertEncodingHeader("FJ�ץ�ߥ���ڡ���");
$from .= " <premium@funkyjam.com>";
$subject = "��FJ PREMIUM����Ͽ�ι�����ǯ���񤪻�ʧ�ˤĤ���";
$subject = convertEncodingHeader($subject);

if($list){
	foreach ($list as $value) {

		$mailer->assign("name",$value[name]);
		$mailer->assign("end",$value[end_stamp]);
		$body = $mailer->fetch(dirname(__FILE__).'/mail_lastMonth.html');
		$body = convertEncodingBody($body);

		//�����ͤإ᡼������
		$to = $value[mail];
		send($to, $subject, $body, $from);

		//FJ�˥᡼������
		$to = "premium@funkyjam.com";
		send($to, $subject, $body, $from);

		//���ܥ�ˤ˥᡼������
//		$to = "saita@evol-ni.com,kida@evol-ni.com";
//		send($to, "Send to confirmer from evolni.", $body, $from);
		//UNTAMED���ѹ�
		$to = "kondo@untamed.co.jp,funatsu@untamed.co.jp";
		send($to, "Send to confirmer from untamed", $body, $from);
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
	mail($to, $subject, $body, "From: " . $from);
}



?>