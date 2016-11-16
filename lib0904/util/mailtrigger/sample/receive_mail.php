<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL^E_NOTICE);

require_once dirname(__FILE__) . '/../Mail_mimeDecode-1.5.1/mimeDecode.php';

$params = array();
$params['include_bodies'] = true;
$params['decode_bodies']  = true;
$params['decode_headers'] = true;
$params['input'] = file_get_contents("php://stdin");
$params['input'] = file_get_contents(dirname(__FILE__) . '/mail');
$params['input'] = file_get_contents(dirname(__FILE__) . '/mail2');
$params['input'] = file_get_contents(dirname(__FILE__) . '/mail3');
$params['crlf'] = "\r\n";

$data = Mail_mimeDecode::decode($params);

mb_convert_variables('UTF-8', 'JIS', $data);
//var_dump($data);

$subject = $data->headers['subject'];
$body = $data->body;
?>
<html>
<head>
<title>receive mail</title>
</head>
<body>
<h1>receive mail</h1>
<h2><?php echo htmlspecialchars($subject); ?></h2>
<p><?php echo nl2br(htmlspecialchars($body)); ?></p>
</body>
</html>
