<?php
//ini_set('display_errors', 'on');
//error_reporting(E_ALL^E_NOTICE);

$domain = 'www.funkyjam.com';
$path = '/admin/mt/mt-xmlrpc.cgi';
$blogid = '10';
$username = 'post_mori';
$password = 'qgub7lnr';

$persons = array(
	'hm_keep_it_real@yahoo.ne.jp' => '¼��',
	'murayama@funkyjam.com' => '¼��PC',
	'saoring-0323@ezweb.ne.jp' => '����',
	'hashimoto@funkyjam.com' => '����PC',
	'yamasaaaan02650@ezweb.ne.jp' => '����',
	'p.e_0113_m.i@docomo.ne.jp' => '�إ�',
	'yamasaki@funkyjam.com' => '����PC',
	'kida@evol-ni.com' => '����',
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
