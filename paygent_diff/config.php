<?php
//ペイジェント用接続IDなど
//20121120kida
define('MERCHANT_ID', '15869');
define('CONNECT_ID', 'pgynt15869');
define('CONNECT_PASSWORD', '8fJrCOyVqb1NSfJ');
define('TELEGRAM_VERSION', '1.0');
//define('MERCHANT_ID', '16660');
//define('CONNECT_ID', 'funkyjamtest');
//define('CONNECT_PASSWORD', '8xSFTf28nU5xfNb6');
//define('TELEGRAM_VERSION', '1.0');


//DB接続情報
//20121120kida
$url = 'pgsql://funkyjam:funkyjam@localhost:5432/fj_db';
//$url = 'pgsql://funkyjam:Wi2Mi9gm@localhost:5432/fj_db_test';

//メール送信先設定
//20121120kida
$ticket_mail = 'ticket_kubota@funkyjam.com';
$shop_mail = 'shop@funkyjam.com';
$baribaricrew_mail = 'kaihi_kubota@funkyjam.com';
//20130617追加
$yearsPASS_mail = 'premium@funkyjam.com';
$moriYearsPass_mail = 'artist_mori@funkyjam.com';
$evolni_mail = 'kida@evol-ni.com';
?>
