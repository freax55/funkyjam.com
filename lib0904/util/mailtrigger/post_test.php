<?php
//ini_set('display_errors', 'on');
//error_reporting(E_ALL^E_NOTICE);

$domain = 'www.funkyjam.com';
$path = '/admin/mt/mt-xmlrpc.cgi';
$blogid = '12';
$username = 'post_test';
$password = 'aagl5j6f';

$persons = array(
	'kida@evol-ni.com' => '木田（エボルニテスト）',
);

require_once dirname(__FILE__) . '/mailTriggerPostMT.php';
$m = new mailTriggerPostMT();

$m->mailDecode();

if($m->checkPerson($persons)) {
} else {
	exit();
}

$m->postMT($domain, $path, $blogid, $username, $password);

?>
