<?php /* Smarty version 2.6.18, created on 2015-02-27 11:04:59
         compiled from /home/funkyjam/public_html/mb/artist/kubota/ticket/mail_paygent_cvs.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', '/home/funkyjam/public_html/mb/artist/kubota/ticket/mail_paygent_cvs.html', 67, false),)), $this); ?>
<?php echo $this->_tpl_vars['orderDesc']['name']; ?>
 様<?php $this->assign('total', 0); ?><?php if ($this->_tpl_vars['admin'] != 2): ?><?php $_from = $this->_tpl_vars['noTourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?><?php endif; ?><?php $_from = $this->_tpl_vars['tourGoodsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?><?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['order']['price']*$this->_tpl_vars['order']['quantity']); ?><?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['admin']): ?>
<?php echo $this->_tpl_vars['orderDesc']['order_desc_no']; ?>

コンビニ決済（モバイル）
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

お支払い方法は「コンビニ決済」となります。
<?php echo $this->_tpl_vars['convenience_stores'][$this->_tpl_vars['convenience_store_no']]['detail']; ?>


<?php echo $this->_tpl_vars['payment_limit_date']; ?>
23：59までにお支払いください。

<?php $_from = $this->_tpl_vars['convenience_store_item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
<?php echo $this->_tpl_vars['k']; ?>
:<?php echo $this->_tpl_vars['v']; ?>

<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['receipt_print_url']): ?>パソコンにて確認
<?php echo $this->_tpl_vars['receipt_print_url']; ?>

※パソコンに当メールを送信するなどしてご利用下さい。ケータイからはうまく表示されませんのでご注意ください。<?php endif; ?>

本メールは購入予約のご確認メールとなります。
お振込みを確認でき次第、購入内容を確定とさせていただきます。
お申込み後、お客様の事情によるキャンセル・変更・追加・返金は、いかなる場合も応じられません。
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
コンビニ決済


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
送料：<?php echo ((is_array($_tmp=$this->_tpl_vars['orderDesc']['paygentCarriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
決済手数料：<?php echo ((is_array($_tmp=$this->_tpl_vars['orderDesc']['paygentFee'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
合計：<?php echo ((is_array($_tmp=$this->_tpl_vars['total']+$this->_tpl_vars['orderDesc']['carriage'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
円
<?php endif; ?>

*******************************


＜お願いとお断り＞
・支払期限内にお振込み下さい。(支払期限は本メールに記載しております。)
　※支払期限が切れた場合はシステムで自動的にキャンセルされ、お申込みは無効となります。
・合計金額にはチケット代,送料の他に決済手数料300円（税込）がふくまれます。

＜チケットのお届けについて＞
・お申込み公演日の約2週間前です。チケット発送状況は、インフォメーションテープ、オフィシャルHPにて
　お知らせ致します。お手元にチケットが届いたら、必ず公演日、チケット枚数をご確認下さい。
　お申込み内容と異なっていた場合、至急バリバリクルーにご連絡下さい。
・お申込み公演日10日前になってもチケットが届かない場合、至急ご連絡ください。
　公演日の７日前までにご連絡頂けなかった場合、対応できない可能性がございます。
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