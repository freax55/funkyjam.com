<?php
//ini_set('display_errors', 'on');
//error_reporting(E_ALL^E_NOTICE);

$domain = 'www.funkyjam.com';
$path = '/admin/mt/mt-xmlrpc.cgi';
$blogid = '10';
$username = 'post_mori';
$password = 'qgub7lnr';

$persons = array(
	'hm_keep_it_real@yahoo.ne.jp' => 'Â¼»³',
	'murayama@funkyjam.com' => 'Â¼»³PC',
	'saoring-0323@ezweb.ne.jp' => '¶¶ËÜ',
	'hashimoto@funkyjam.com' => '¶¶ËÜPC',
	'yamasaaaan02650@ezweb.ne.jp' => '»³ºê',
	'p.e_0113_m.i@docomo.ne.jp' => '¥Ø¥ß',
	'yamasaki@funkyjam.com' => '»³ºêPC',
	'kida@evol-ni.com' => 'ÌÚÅÄ',
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
