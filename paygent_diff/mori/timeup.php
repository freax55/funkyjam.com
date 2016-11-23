<?php
/*test状態のパスの参考*/
/*/usr/bin/php /home/fj_test/public_html/premium/insert/test.php*/
/*システムの出力*/
	
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

//今日の日付を取得
$start = date("Y-m-d", mktime(0, 0, 0, date("n"), date("d"), date("Y")));
//$start = date("Y-m-d", mktime(0, 0, 0, 11, 21, 2016));

$list = "";

//同じ日付のものを抽出
$db->assign('start', $start);
$result = $db->statement(dirname(__FILE__).'/../sql/mori/timeup_list.sql');
$list = $db->buildTree($result);


if($list){
	$db->assign('reason', "有効期限切れ");
	foreach ($list as $value) {
		$db->assign('account_no', $value[account_no]);
		$db->statement(dirname(__FILE__).'/../sql/mori/timeup.sql');
		$db->commit();
	}
	echo "本日付けの有効期限切れの方を削除しました";
	return true;
}else{
	echo "本日付けの有効期限切れの方はおられませんでした";
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