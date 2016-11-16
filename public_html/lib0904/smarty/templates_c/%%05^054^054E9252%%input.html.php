<?php /* Smarty version 2.6.18, created on 2014-11-25 12:12:54
         compiled from artist/kubota/ticket_reserve/input.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'artist/kubota/ticket_reserve/input.html', 39, false),)), $this); ?>
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
	<td align="center"><font size="1" color="#FFFFFF">
		<img src="/images/common/dot.gif" width="1" height="5" /><br /><h3>FJ SHOP</h3>
		FUNKY JAM SHOPPING STORE</font><br /><img src="/images/common/dot.gif" width="1" height="5" />

	</td>
</tr>
</table>

<img src="/images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FAE9BA" width="100%">
	<tr>
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br />お客様情報入力画面<br /><img src="/images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<form  action="index.php" method="post">
<input type="hidden" name="action" value="confirm" />
<!--<input type="hidden" name="mb" value="1" />-->
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />

<?php if ($this->_tpl_vars['errors'] && ! $this->_tpl_vars['errors']['cart']): ?>
<font color="#FF0000">※下記、項目をご確認ください</font><br />
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<?php endif; ?>
<?php if ($this->_tpl_vars['errors']['cart']): ?>
<font color="#A4272C">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['cart'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br />
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<?php endif; ?>

<font color="#FF9E23">[FC会員番号]</font><br />
<?php if ($this->_tpl_vars['errors']['member_no']): ?><font color="#FF0000">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['member_no'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
<input type="text" istyle="4" MODE="numeric" name="member_no" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['member_no'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="9" maxlength="8" /><br />
<font size="1" color="#999999">(BBC封筒宛名の8ケタの数字です)</font><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />

<font color="#FF9E23">[お名前]</font>&nbsp;<font color="#A4272C">※必須</font><br />
<?php if ($this->_tpl_vars['errors']['name']): ?><font color="#FF0000">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
姓&nbsp;<input type="text" name="last_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['last_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="15" /><br />
<font size="1" color="#999999">(例：久保田)</font><br />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
名&nbsp;<input type="text" name="first_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['first_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="15" /><br />
<font size="1" color="#999999">(例：利伸)</font><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />

<font color="#FF9E23">[お名前(カナ)]</font>&nbsp;<font color="#A4272C">※必須</font><br />
<?php if ($this->_tpl_vars['errors']['kana']): ?><font color="#FF0000">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
セイ&nbsp;<input type="text" MODE="katakana" name="last_kana" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['last_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="15" /><br />
<font size="1" color="#999999">(例：クボタ)</font><br />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
メイ&nbsp;<input type="text" name="first_kana" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['first_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="15" /><br />
<font size="1" color="#999999">(例：トシノブ)</font><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />

<font color="#FF9E23">[郵便番号]</font>&nbsp;<font color="#A4272C">※必須</font><br />
<?php if ($this->_tpl_vars['errors']['zip']): ?><font color="#FF0000">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['zip'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
<input type="text" istyle="4" MODE="numeric" name="zip" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['zip'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="7" /><br />
<font size="1" color="#999999">(例：1060031)</font><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />

<font color="#FF9E23">[住所]</font><br />
住所1&nbsp;<font color="#A4272C">※必須</font><br />
<?php if ($this->_tpl_vars['errors']['address']): ?><font color="#FF0000">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['address'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
<input type="text" name="address1" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['address1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><br />
<font size="1" color="#999999">(例：東京都港区西麻布)</font><br />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
住所2<br />
<input type="text" name="address2" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['address2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
<font size="1" color="#999999">(例：1-2-3)</font><br />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
住所3<br />
<input type="text" name="address3" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['address3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
<font size="1" color="#999999">(例：久保田マンション100号室)</font><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />

<font color="#FF9E23">[メールアドレス]</font>&nbsp;<font color="#A4272C">※必須</font><br />
(こちらに入力されたアドレスに確認メールが届きます。)<br />
<?php if ($this->_tpl_vars['errors']['mail']): ?><font color="#FF0000">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['mail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
<input type="text" istyle="3" MODE="alphabet" name="mail" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['mail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
確認用<br />
<?php if ($this->_tpl_vars['errors']['confirm']): ?><font color="#FF0000">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['confirm'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
<input type="text" istyle="3" MODE="alphabet" name="confirm" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['confirm'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
<font size="1" color="#999999">(例：info@funkyjam.com)</font><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />

<font color="#FF9E23">[連絡先電話番号]</font>&nbsp;<font color="#A4272C">※必須</font><br />
<?php if ($this->_tpl_vars['errors']['tel']): ?><font color="#FF0000">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['tel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
<input type="text" istyle="4" MODE="numeric" name="tel" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['tel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
<font size="1" color="#999999">(日中ご連絡のつく電話番号をおいれください　例：03-1234-5678)</font><br />

<img src="/images/common/dot.gif" width="1" height="20" /><br /><center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="登録内容を確認" /><br /><img src="/images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
</form>

<img src="/images/common/dot.gif" width="1" height="18" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">■</font></td>
	<td>&nbsp;<a href="/privacy.html"><font color="#333333" size="-1">個人情報保護方針</font></a></td>
	</tr>
</table>

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