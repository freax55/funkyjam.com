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

//現在時間を取得
$start = date("Y-m-d", mktime(0, 0, 0, date("n"), date("d"), date("Y")));

$db->assign('start', $start);
$result = $db->statement(dirname(__FILE__).'/sql/delete_list.sql');
$list = $db->buildTree($result);

if($list){
	foreach ($list as $value) {		
		$db->assign('delete', $value[id]);
		$db->statement(dirname(__FILE__).'/sql/delete_flg.sql');
		$db->commit();
	}
}
?>