<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL^E_NOTICE);
?>
<html>
<head>
<title>XML-RPC Client</title>
</head>
<body>
<h1>XML-RPC Client</h1>
<?php
require_once dirname(__FILE__) . '/../XML_RPC-1.5.3/RPC.php';

$uri = '/admin/mt/mt-xmlrpc.cgi'; // mt-xmlrpc.cgi��URI

$client = new XML_RPC_Client($uri, 'http://funkyjam.evol-ni.com'); // XML-RPX���饤����Ȥ�����

$entry_id = 38; // �֥�����ID
$user = 'admin'; // �����֥����ӥ��Υ桼����̾
$pass = 'ow6mtier'; // �����֥����ӥ��Υѥ���ɡ��̾�Υѥ���ɤȰ㤦�Τ���ա���

//$message = new XML_RPC_MESSAGE('mt.supportedMethods');
$message = new XML_RPC_MESSAGE(
	'metaWeblog.getPost',
	array(
		new XML_RPC_Value($entry_id, 'string'),
		new XML_RPC_Value($user, 'string'),
		new XML_RPC_Value($pass, 'string')
	)
);

$result = $client->send($message); // API��ư

var_dump($result);
?>

</body>
</html>