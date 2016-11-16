<?php
/*test状態のパスの参考*/
/*/usr/bin/php /home/fj_test/public_html/premium/shop/test.php*/
/*システムの出力*/
	
ini_set('display_errors', 'on');
error_reporting(E_ALL^E_NOTICE);

require_once(dirname(__FILE__) . '/../../../lib0904/simple/Database.php');
require_once(dirname(__FILE__) . '/../../../lib0904/simple/Renderer.php');
require_once(dirname(__FILE__) . '/../../../lib0904/util/DatabaseConnector.php');

/*DBNEW*/
$url = 'pgsql://funkyjam:Wi2Mi9gm@localhost:5432/fj_db_test';
$db = new Database($url);
$db->connect();
$dbcn = new DatabaseConnector($db);	
$db->begin();

$mailer = new Renderer();
//$to = "deguchi@evol-ni.com";
$from = "kida@evol-ni.com";
$subject = "契約期間延長";
$subject = convertEncodingHeader($subject);
$body = $mailer->fetch('/home/fj_test/public_html/premium/shop/mail_lastMonth.html');
$body = convertEncodingBody($body);


//現在時間から1月前を取得
$start = date("Y-m-d", mktime(0, 0, 0, date("n")-1, date("d"), date("Y")));

//start日付より
/*抽出条件が逆*/
$db->assign('start', $start);
$result = $db->statement('/home/fj_test/public_html/premium/shop/sql/mail_list.sql');
$list = $db->buildTree($result);

if($list){
	foreach ($list as $value) {
		$to = $value[mail];
		send($to, $subject, $body, $from);
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