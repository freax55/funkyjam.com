<?php
/*test状態のパスの参考*/
/*/usr/bin/php /home/fj_test/public_html/premium/insert/test.php*/
/*システムの出力*/
	
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

//現在時間から1月前を取得
$start = date("Y-m-d", mktime(0, 0, 0, date("n"), date("d"), date("Y")));

//start日付より
$db->assign('start', $start);
$result = $db->statement(dirname(__FILE__).'/sql/mail_list.sql');
$list = $db->buildTree($result);

$mailer = new Renderer();

//メーラの書き方にそって設定
$from = convertEncodingHeader("FJプレミアムページ");
$from .= " <premium@funkyjam.com>";
$subject = "【FJ PREMIUM】登録の更新・年会費お支払について";
$subject = convertEncodingHeader($subject);

if($list){
	foreach ($list as $value) {

		$mailer->assign("name",$value[name]);
		$mailer->assign("end",$value[end_stamp]);
		$body = $mailer->fetch(dirname(__FILE__).'/mail_lastMonth.html');
		$body = convertEncodingBody($body);

		//お客様へメール送信
		$to = $value[mail];
		send($to, $subject, $body, $from);

		//FJにメール送信
		$to = "premium@funkyjam.com";
		send($to, $subject, $body, $from);

		//エボルニにメール送信
//		$to = "saita@evol-ni.com,kida@evol-ni.com";
//		send($to, "Send to confirmer from evolni.", $body, $from);
		//UNTAMEDへ変更
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