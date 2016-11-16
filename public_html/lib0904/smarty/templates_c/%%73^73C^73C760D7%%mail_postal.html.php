<?php /* Smarty version 2.6.18, created on 2014-12-01 18:42:41
         compiled from /home/funkyjam/public_html/mb/artist/kubota/ticket_reserve/mail_postal.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', '/home/funkyjam/public_html/mb/artist/kubota/ticket_reserve/mail_postal.html', 24, false),)), $this); ?>
<?php echo $this->_tpl_vars['orderDesc']['name']; ?>
 様<?php $this->assign('total', 0); ?><?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?><?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['admin']): ?>

ファンクラブチケット優先予約にお申込みいただきありがとうございます。

お支払い方法は「BARI BARI CREW カード決済（予約）（モバイル）」となります。

本メールは購入予約のご確認メールとなります。	
カードの発行を確認でき次第、購入内容を確定とさせていただきます。
下記のお支払い方法ご確認の上、お振込みください。
お申込み後、お客様の事情によるキャンセル・変更・追加・返金は、いかなる場合も応じられません。
すべてのお問い合わせには、下記受付番号が必要です。


受付番号：<?php echo $this->_tpl_vars['orderDesc']['order_desc_no']; ?>



*******************************

<?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
商品名：<?php echo $this->_tpl_vars['order']['name']; ?>
<?php if ($this->_tpl_vars['order']['item_code'] == 'KT20130914p'): ?> プレミアムシート<?php endif; ?>

価格：<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
個数：<?php echo $this->_tpl_vars['order']['quantity']; ?>
個

<?php endforeach; endif; unset($_from); ?>
*******************************
<?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
商品名：<?php echo $this->_tpl_vars['order']['name']; ?>
<?php if ($this->_tpl_vars['order']['item_code'] == 'KT20130914p'): ?> プレミアムシート<?php endif; ?>

価格：<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
個数：<?php echo $this->_tpl_vars['order']['quantity']; ?>
個

<?php endforeach; endif; unset($_from); ?>
*******************************

<?php if ($this->_tpl_vars['admin'] == 2): ?>
合計：<?php echo ((is_array($_tmp=$this->_tpl_vars['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
<?php else: ?>
送料：<?php echo ((is_array($_tmp=$this->_tpl_vars['orderDesc']['carriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
合計：<?php echo ((is_array($_tmp=$this->_tpl_vars['total']+$this->_tpl_vars['orderDesc']['carriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
<?php endif; ?>

*******************************


＜お願いとお断り＞
・チケットの購入、抽選3,000席分最前列ふくむ良席の抽選対象になる為には2015年1月10日までにBARI BARI CREW CARDが発行されていることが条件です。
・チケットお申し込み後、受付期間内にカードが発行された場合は再度申込の手続きの必要はございません。
・2015年1月10日までにカードが発行されなかった場合別途お支払い方法をご案内させていただきます。
・公演日まで会員継続をされていない場合、チケットが発送できませんのでご注意ください。
＜チケットのお届けについて＞
・お申込み公演日の約2週間前です。
チケット発送状況は、BBCインフォメーション、オフィシャルHPにて随時お知らせ致します。お手元にチケットが届いたら、必ず公演日、チケット枚数をご確認下さい。
お申込み内容と異なっていた場合、至急バリバリクルーにご連絡ください。
お申込み公演日10日前になってもチケットが届かない場合、PC/モバイルの方は購入内容確認メールに記載の『受付番号』にてお問合せください。
・チケットは貴重品の為、ヤマト運輸セキュリティーパッケージにてファンクラブ登録住所へお送りします。郵便局や、ヤマト運輸などの転送サービスはご利用出来ません。変更が間に合わず返送された場合など、お客様都合による再送は着払いとさせて頂きます。


***総合お問い合わせ先***
チケットに関するお問合わせは、
ファンキー・ジャム内 バリバリクルーへお願い致します。
TEL：03-3470-7709（平日15:00〜18:00以外はインフォメーションテープ）
e-mail：ticket@funkyjam.com

※このメールは送信専用です。
　返信いただいてもお答えすることは出来ませんのでご了承ください。

--------------------------------------------------------------

<?php echo $this->_tpl_vars['orderDesc']['order_desc_no']; ?>

BARI BARI CREW カード決済（予約）（モバイル）
<?php echo $this->_tpl_vars['orderDesc']['member_no']; ?>

<?php echo $this->_tpl_vars['orderDesc']['name']; ?>

<?php echo $this->_tpl_vars['orderDesc']['zip']; ?>

<?php echo $this->_tpl_vars['orderDesc']['address1']; ?>
<?php echo $this->_tpl_vars['orderDesc']['address2']; ?>
<?php echo $this->_tpl_vars['orderDesc']['address3']; ?>

<?php echo $this->_tpl_vars['orderDesc']['tel']; ?>

<?php echo $this->_tpl_vars['orderDesc']['mail']; ?>

<?php echo $this->_tpl_vars['total']+$this->_tpl_vars['orderDesc']['carriage']; ?>

<?php echo $this->_tpl_vars['orderDesc']['carriage']; ?>

<?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
<?php echo $this->_tpl_vars['order']['item_code']; ?>

<?php echo $this->_tpl_vars['order']['name']; ?>

<?php echo $this->_tpl_vars['order']['quantity']; ?>

<?php echo $this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']; ?>

<?php endforeach; endif; unset($_from); ?>
<?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
<?php echo $this->_tpl_vars['order']['item_code']; ?>

<?php echo $this->_tpl_vars['order']['name']; ?>

<?php echo $this->_tpl_vars['order']['quantity']; ?>

<?php echo $this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']; ?>

<?php endforeach; endif; unset($_from); ?>

--------------------------------------------------------------

<?php else: ?>

ファンクラブチケット優先予約にお申込みいただきありがとうございます。

お支払い方法は「BARI BARI CREW カード決済（予約）（モバイル）」となります。

本メールは購入予約のご確認メールとなります。	
カードの発行を確認でき次第、購入内容を確定とさせていただきます。
下記のお支払い方法ご確認の上、お振込みください。
お申込み後、お客様の事情によるキャンセル・変更・追加・返金は、いかなる場合も応じられません。
すべてのお問い合わせには、下記受付番号が必要です。


受付番号：<?php echo $this->_tpl_vars['orderDesc']['order_desc_no']; ?>



*******************************

<?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
商品名：<?php echo $this->_tpl_vars['order']['name']; ?>
<?php if ($this->_tpl_vars['order']['item_code'] == 'KT20130914p'): ?> プレミアムシート<?php endif; ?>

価格：<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
個数：<?php echo $this->_tpl_vars['order']['quantity']; ?>
個

<?php endforeach; endif; unset($_from); ?>
*******************************
<?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
商品名：<?php echo $this->_tpl_vars['order']['name']; ?>
<?php if ($this->_tpl_vars['order']['item_code'] == 'KT20130914p'): ?> プレミアムシート<?php endif; ?>

価格：<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
個数：<?php echo $this->_tpl_vars['order']['quantity']; ?>
個

<?php endforeach; endif; unset($_from); ?>
*******************************

<?php if ($this->_tpl_vars['admin'] == 2): ?>
合計：<?php echo ((is_array($_tmp=$this->_tpl_vars['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
<?php else: ?>
送料：<?php echo ((is_array($_tmp=$this->_tpl_vars['orderDesc']['carriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
合計：<?php echo ((is_array($_tmp=$this->_tpl_vars['total']+$this->_tpl_vars['orderDesc']['carriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
<?php endif; ?>

*******************************


＜お願いとお断り＞
・チケットの購入、抽選3,000席分最前列ふくむ良席の抽選対象になる為には2015年1月10日までにBARI BARI CREW CARDが発行されていることが条件です。
・チケットお申し込み後、受付期間内にカードが発行された場合は再度申込の手続きの必要はございません。
・2015年1月10日までにカードが発行されなかった場合別途お支払い方法をご案内させていただきます。
・公演日まで会員継続をされていない場合、チケットが発送できませんのでご注意ください。
＜チケットのお届けについて＞
・お申込み公演日の約2週間前です。
チケット発送状況は、BBCインフォメーション、オフィシャルHPにて随時お知らせ致します。お手元にチケットが届いたら、必ず公演日、チケット枚数をご確認下さい。
お申込み内容と異なっていた場合、至急バリバリクルーにご連絡ください。
お申込み公演日10日前になってもチケットが届かない場合、PC/モバイルの方は購入内容確認メールに記載の『受付番号』にてお問合せください。
・チケットは貴重品の為、ヤマト運輸セキュリティーパッケージにてファンクラブ登録住所へお送りします。郵便局や、ヤマト運輸などの転送サービスはご利用出来ません。変更が間に合わず返送された場合など、お客様都合による再送は着払いとさせて頂きます。


***総合お問い合わせ先***
チケットに関するお問合わせは、
ファンキー・ジャム内 バリバリクルーへお願い致します。
TEL：03-3470-7709（平日15:00〜18:00以外はインフォメーションテープ）
e-mail：ticket@funkyjam.com

※このメールは送信専用です。
　返信いただいてもお答えすることは出来ませんのでご了承ください。


<?php endif; ?>