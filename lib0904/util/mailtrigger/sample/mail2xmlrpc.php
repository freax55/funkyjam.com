<?php
require_once dirname(__FILE__) . '/../Mail_mimeDecode-1.5.1/mimeDecode.php';
require_once dirname(__FILE__) . '/../XML_RPC-1.5.3/RPC.php';

/**
 * �᡼��ʬ��
 */
$params = array();
$params['include_bodies'] = true;
$params['decode_bodies']  = true;
$params['decode_headers'] = true;
$params['input'] = file_get_contents(dirname(__FILE__) . '/mail2');
$params['crlf'] = "\r\n";

$data = Mail_mimeDecode::decode($params);

mb_convert_variables('UTF-8', 'JIS', $data);

$subject = $data->headers['subject'];
$subject = htmlspecialchars($subject);

// XML-RPC�ξ�����Ԥ��ʤ��ʤäƤ��ޤ��ΤǶ�ʸ�����ʸ������롣
$body = $data->body;
$body = preg_replace("/(\r\n)|\r/u", "\n", $body);
$body = preg_replace("/^\n/um", " \n", $body);
$body = htmlspecialchars($body);


/**
 * XML-RPC ���
 */
$date = date(DATE_ATOM);
$uri = '/admin/mt/mt-xmlrpc.cgi';
$client = new XML_RPC_Client($uri, '/');

$blogid = 8; // �֥�ID 8�ϡ����������������åե֥�
$username = 'admin'; // �����֥����ӥ��Υ桼����̾
$password = 'ow6mtier'; // �����֥����ӥ��Υѥ���ɡ��̾�Υѥ���ɤȰ㤦�Τ���ա���
$content = array(
	'title' => new XML_RPC_Value($subject, 'string'),
	'description' => new XML_RPC_Value($body, 'string'),
	'mt_convert_breaks' => new XML_RPC_Value(0, 'string')
);
$message = new XML_RPC_MESSAGE(
	'metaWeblog.newPost',
	array(
		new XML_RPC_Value($blogid, 'string'),
		new XML_RPC_Value($username, 'string'),
		new XML_RPC_Value($password, 'string'),
		new XML_RPC_Value($content, 'struct'),
		new XML_RPC_Value(1, 'boolean')
	)
);
$postId = $client->send($message);
?>
