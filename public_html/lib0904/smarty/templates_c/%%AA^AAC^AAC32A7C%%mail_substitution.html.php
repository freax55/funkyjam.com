<?php /* Smarty version 2.6.18, created on 2015-04-23 20:24:31
         compiled from shop/mail_substitution.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'shop/mail_substitution.html', 46, false),array('modifier', 'number_format', 'shop/mail_substitution.html', 47, false),)), $this); ?>
<?php echo $this->_tpl_vars['orderDesc']['name']; ?>
 様<?php $this->assign('total', 0); ?><?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?><?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['admin']): ?>
<?php echo $this->_tpl_vars['orderDesc']['order_desc_no']; ?>

代金引換（モバイル）
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
お支払い方法は「代金引換」となります。
商品お届け時に、商品の代金+\1,000(代引手数料／発送梱包料)を現金でお支払いください。
※お支払い方法は「現金のみ」となっております。予めご了承ください。
お申し込み内容に誤りがあった場合は、お申し込み日の翌日中にメールにてご連絡下さい。
期間内にご連絡がない時点で、お申し込み完了となります。
商品がお手元に届きましたら、代金引換にてお支払い下さい。

尚、このメールは、お客様のご購入控えにもなりますので、商品到着まで大切に保管してください。



＜お支払い方法＞
代金引換
受付番号：<?php echo $this->_tpl_vars['orderDesc']['order_desc_no']; ?>


***************
<?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
商品名：<?php echo $this->_tpl_vars['order']['name']; ?>

色：<?php echo $this->_tpl_vars['order']['color']; ?>

サイズ：<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['size'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp, false) : smarty_modifier_strip_tags($_tmp, false)); ?>

価格：<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
個数：<?php echo $this->_tpl_vars['order']['quantity']; ?>
個
<?php endforeach; endif; unset($_from); ?>
***************

<?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
商品名：<?php echo $this->_tpl_vars['order']['name']; ?>

色：<?php echo $this->_tpl_vars['order']['color']; ?>

サイズ：<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['size'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp, false) : smarty_modifier_strip_tags($_tmp, false)); ?>

価格：<?php echo ((is_array($_tmp=$this->_tpl_vars['order']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
個数：<?php echo $this->_tpl_vars['order']['quantity']; ?>
個
<?php endforeach; endif; unset($_from); ?>
***************
<?php if ($this->_tpl_vars['admin'] == 2): ?>
合計：<?php echo ((is_array($_tmp=$this->_tpl_vars['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
<?php else: ?>
送料：<?php echo ((is_array($_tmp=$this->_tpl_vars['orderDesc']['carriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
合計：<?php echo ((is_array($_tmp=$this->_tpl_vars['total']+$this->_tpl_vars['orderDesc']['carriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
<?php endif; ?>
***************

＜お願いとお断り＞
・商品のサイズ,色,規格等をよくご確認の上、お申し込み下さい。尚、お申し込み完了後の商品の交換/返品/サイズ変更は原則的に受け付けておりませんのでご了承ください。
・原則的にお申し込み後のキャンセル・ご返金はお受け出来ませんので予めご了承下さい。
・ホームページに掲載されている写真と実際の商品とでは、若干の差がある可能性がございますがご了承下さい。
・商品は数に限りがございます。ご要望に添えない場合もございますがご了承下さい。
・特別な包装はお受け致しかねます。
・商品未着等のトラブルに対処しやすいように当社では宅配便を使っております。商品の大小に関わらず同額の送料を一律￥1,000として頂きますが、どうぞご了承下さい。
・お届けした商品がお申込商品と異なったり、破損等していた場合は、商品到着後8日以内に下記お問い合せ先へお電話もしくはメールにてご連絡下さい。

＜商品のお届けについて＞
・商品がお手元に届くまで最大4週間程かかります。予めご了承下さい。
・住所等に不明瞭な点がある場合、発送が遅れます。ご注意下さい。またお申込み後に住所を変更された方はすみやかに下記のお問い合わせ先までご連絡下さい。
・お申込み時のご住所に宅配便にてお届け致しますので、お留守の場合は「不在通知票」に従いお受け取り下さい。不在通知票投函後、お客様から宅配業者へ再配達の希望連絡がなかった場合、お客様が申込み時に記入された住所が不明瞭だった場合、住所変更の連絡がなく配達出来なかった等の理由で、商品が発送元に返送された場合、再発送手数料1000円はお客様のご負担とさせていただきますので、予めご了承下さい。

※このメールは送信専用です。
返信いただいてもお答えすることは出来ませんのでご了承ください。

*　総合お問合わせ先　*
商品に関するお問合わせは、ファンキー・ジャム内 FJ SHOP係へお願い致します。
TEL：03-3470-7707（平日10:30〜18：30）
e-mail：shop@funkyjam.com
<?php endif; ?>
