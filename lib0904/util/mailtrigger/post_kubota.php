<?php
//ini_set('display_errors', 'on');
//error_reporting(E_ALL^E_NOTICE);

$domain = 'www.funkyjam.com';
$path = '/admin/mt/mt-xmlrpc.cgi';
$blogid = '8';
$username = 'post_kubota';
$password = '37w5lmu6';

$persons = array(
	'hm_keep_it_real@yahoo.ne.jp' => '¼��',
	'murayama@funkyjam.com' => '¼��PC',
	'saoring-0323@ezweb.ne.jp' => '����',
	'hashimoto@funkyjam.com' => '����PC',
	'yamasaaaan02650@ezweb.ne.jp' => '����',
	'p.e_0113_m.i@docomo.ne.jp' => '�إ�',
	'hyemi@funkyjam.com' => '�إ�PC',
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
