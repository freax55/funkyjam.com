<?php
require_once dirname(__FILE__) . '/../Mail_mimeDecode-1.5.1/mimeDecode.php';
require_once dirname(__FILE__) . '/../XML_RPC-1.5.3/RPC.php';

/**
 * メール分割
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

// XML-RPCの場合空白行がなくなってしまうので空文字を一文字入れる。
$body = $data->body;
$body = preg_replace("/(\r\n)|\r/u", "\n", $body);
$body = preg_replace("/^\n/um", " \n", $body);
$body = htmlspecialchars($body);


/**
 * XML-RPC 投稿
 */
$date = date(DATE_ATOM);
$uri = '/admin/mt/mt-xmlrpc.cgi';
$client = new XML_RPC_Client($uri, '/');

$blogid = 8; // ブログID 8は、久保田利伸スタッフブログ
$username = 'admin'; // ウェブサービスのユーザー名
$password = 'ow6mtier'; // ウェブサービスのパスワード（通常のパスワードと違うので注意！）
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
