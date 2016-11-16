<?php /* Smarty version 2.6.18, created on 2015-02-27 11:05:01
         compiled from artist/kubota/ticket/end_cvs.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'artist/kubota/ticket/end_cvs.html', 33, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>Funky Jam</title>
<meta name="Keywords" content="Funky Jam" />
<meta name="Description" content="Funky Jam" />
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" lang="ja" xml:lang="ja">
<font size="-1" color="#333333">
<a name="pagetop"></a>
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#000000" width="100%">
<tr>
	<td align="center">
	<font size="1" color="#FFFFFF">
		<img src="/images/common/dot.gif" width="1" height="5" /><br /><h3>FJ SHOP</h3>
		FUNKY JAM SHOPPING STORE</font><br /><img src="/images/common/dot.gif" width="1" height="5" />

	</td>
</tr>
</table>

<img src="/images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FAE9BA" width="100%">
	<tr>
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br />お申込み完了画面<br /><img src="/images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<center><font color="#A4272C">このページを保存されることをお勧め致します。</font></center>
<img src="/images/common/dot.gif" width="1" height="10" /><br />

お支払い方法は「コンビニ決済」となります。<br />
<!--<?php echo ((is_array($_tmp=$this->_tpl_vars['convenience_stores'][$this->_tpl_vars['convenience_store_no']]['detail'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<br />
<br />
<?php echo $this->_tpl_vars['payment_limit_date']; ?>
23:59までにお支払いください。<br />
<br />
<?php $_from = $this->_tpl_vars['convenience_store_item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
<?php echo $this->_tpl_vars['k']; ?>
:<?php echo $this->_tpl_vars['v']; ?>
<br />
<?php endforeach; endif; unset($_from); ?>
<br />
<?php if ($this->_tpl_vars['receipt_print_url']): ?>パソコンにて確認
<?php echo $this->_tpl_vars['receipt_print_url']; ?>

（ケータイからはうまく表示されませんのでご注意ください）<?php endif; ?>
<br />-->
確認メールは自動配信しております。届かない場合はすぐ下記お問い合わせまでご連絡ください。<br />
<br />
***総合お問い合わせ先***<br />
チケットに関するお問合わせは、ファンキー・ジャム内 バリバリクルーへお願い致します。<br />
TEL：03-3470-7709（平日15:00〜18:00以外はインフォメーションテープ）<br />
e-mail：ticket@funkyjam.com<br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<center><a href="index.php?<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
"><font color="#FF9E23" size="-1">他の公演を申し込む</font></a><br />
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<a href="/index.html"><font color="#333333" size="-1">FunkyJamトップページへ</font></a></center>
<img src="/images/common/dot.gif" width="1" height="10" /><br />

<hr color="#666666" size="1" noshade="noshade" />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#01"><font color="#333333" size="-1">ご注意</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#02"><font color="#333333" size="-1">お支払について</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#03"><font color="#333333" size="-1">送料について</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#06"><font color="#333333" size="-1">決済手数料について</font></a></td>
	</tr>
	<tr>
		<td align="center" valign="top"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#04"><font color="#333333" size="-1">チケットについてのお問い合わせ</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#05"><font color="#333333" size="-1">特定商取引に基づく表記</font></a></td>
	</tr>
</table>
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body></html>