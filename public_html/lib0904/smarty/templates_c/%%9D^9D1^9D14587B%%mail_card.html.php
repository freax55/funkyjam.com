<?php /* Smarty version 2.6.18, created on 2015-02-27 11:00:56
         compiled from /home/funkyjam/public_html/mb/artist/kubota/ticket/mail_card.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', '/home/funkyjam/public_html/mb/artist/kubota/ticket/mail_card.html', 53, false),)), $this); ?>
<?php echo $this->_tpl_vars['orderDesc']['name']; ?>
 様<?php $this->assign('total', 0); ?><?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?><?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['admin']): ?>
<?php echo $this->_tpl_vars['orderDesc']['order_desc_no']; ?>

BBCカード（クレジット決済）（モバイル）
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
<?php else: ?>

ご購入頂きまして有り難うございました。

下記の通りチケットご購入を、受け賜りました。
尚、このメールは、お客様のご購入控えにもなりますので、
チケット到着まで大切に保管してください。
すべてのお問い合わせには、下記受付番号が必要です。

＜お客様情報＞
FC会員番号：<?php echo $this->_tpl_vars['orderDesc']['member_no']; ?>

お名前：<?php echo $this->_tpl_vars['orderDesc']['name']; ?>

郵便番号：<?php echo $this->_tpl_vars['orderDesc']['zip']; ?>

住所：<?php echo $this->_tpl_vars['orderDesc']['address1']; ?>
<?php echo $this->_tpl_vars['orderDesc']['address2']; ?>
<?php echo $this->_tpl_vars['orderDesc']['address3']; ?>

連絡先電話番号：<?php echo $this->_tpl_vars['orderDesc']['tel']; ?>

Email：<?php echo $this->_tpl_vars['orderDesc']['mail']; ?>


＜お支払い方法＞
BBCカード（クレジット決済）

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
・一括払いのみのお取り扱いとなります。
・引落時カードの有効期限が切れている場合、決済が出来ませんのでお申込みは無効となります。
・BARI BARI CREWカード決済につきましては、システム上、お申込み完了時点でご購入確定とさせて頂きます。ご注意下さい。


＜チケットのお届けについて＞
・お申込み公演日の約2週間前です。チケット発送状況は、インフォメーションテープ、オフィシャルHPにて
　お知らせ致します。お手元にチケットが届いたら、必ず公演日、チケット枚数をご確認下さい。
　お申込み内容と異なっていた場合、至急バリバリクルーにご連絡下さい。
・お申込み公演日10日前になってもチケットが届かない場合、至急ご連絡ください。
　公演日の７日前までにご連絡頂けなかった場合、対応できない可能性がございます。。
・チケットは貴重品の為、ヤマト運輸セキュリティーパッケージにてファンクラブ登録住所へお送りします。
　郵便局や、ヤマト運輸などの転送サービスはご利用出来ません。変更が間に合わず返送された場合など、
　お客様都合による再送は着払いとさせて頂きます。


 * *　総合お問合わせ先　* * *
チケットに関するお問合わせは、
ファンキー・ジャム内 バリバリクルーへお願い致します。 
TEL：03-3470-7709（平日15:00〜18:00以外はインフォメーションテープ）
e-mail：ticket@funkyjam.com

※このメールは送信専用です。
　返信いただいてもお答えすることは出来ませんのでご了承ください。

<?php endif; ?>