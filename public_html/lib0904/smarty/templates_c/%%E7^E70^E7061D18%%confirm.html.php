<?php /* Smarty version 2.6.18, created on 2015-04-17 02:50:57
         compiled from shop/confirm.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'shop/confirm.html', 49, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/fjshop.dwt" codeOutsideHTMLIsLocked="false" -->
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
	<td align="center"><!-- InstanceBeginEditable name="header" -->
<font size="1" color="#FFFFFF">
		<img src="../images/common/dot.gif" width="1" height="5" /><br /><h3>FJ SHOP</h3>
		FUNKY JAM SHOPPING STORE</font><br /><img src="../images/common/dot.gif" width="1" height="5" />
<!-- InstanceEndEditable -->
	</td>
</tr>
</table>
<!-- InstanceBeginEditable name="main" -->
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FAE9BA" width="100%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br />入力内容確認<br /><img src="../images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<img src="../images/common/dot.gif" width="1" height="10" /><br />

<font color="#FFCC00">[お支払方法]</font><br />
<?php if ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP 代金引換'): ?>
代金引換<br />
<?php elseif ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP 郵便振替'): ?>
郵便振替<br />
<?php elseif ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP BariBariCrewCARD'): ?>
BariBariCrewｶｰﾄﾞ決済<br />
<?php elseif ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP コンビニ決済'): ?>
ｺﾝﾋﾞﾆ決済<br />
<?php elseif ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP カード決済（ペイジェント）'): ?>
ｸﾚｼﾞｯﾄｶｰﾄﾞ決済<br />
<?php elseif ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP 銀行ネット決済'): ?>
銀行ﾈｯﾄ決済<br />
<?php elseif ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP ATM決済'): ?>
ATM決済<br />
<?php endif; ?>
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[FC会員番号]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['member_no'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[お名前]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['last_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['first_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[お名前(カナ)]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['last_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['first_kana'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[郵便番号]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['zip1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['zip2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[住所]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['address1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['address2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['address3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[メールアドレス]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['mail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<font color="#FFCC00">[連絡先電話番号]</font><br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['tel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="20" /><br />
<br />
<form action="index.php" method="post">
<!--<input type="hidden" name="mb" value="1" />-->
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
<?php if ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP コンビニ決済'): ?>
<input type="hidden" name="action" value="cvs_input" />
<input type="hidden" name="convenience_store_no" value="" />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="コンビニ選択へ" /><br /><img src="../images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<?php elseif ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP カード決済（ペイジェント）'): ?>
<input type="hidden" name="action" value="card_input" />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="カード番号入力へ" /><br /><img src="../images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<?php elseif ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP 銀行ネット決済'): ?>
<font color="#FF0000">※銀行のサイトにてお支払を完了後、必ずFJSHOPサイトへお戻りください。</font>
<input type="hidden" name="action" value="net_input" />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="銀行ネットへ" /><br /><img src="../images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<?php else: ?>
<input type="hidden" name="action" value="process" />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="上記の内容で送信する" /><br /><img src="../images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<?php endif; ?>
</form>
<center>
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<a href="index.php?action=pay&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
">&lt;&lt;内容を修正する</a>
</center>
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">■</font></td>
	<td>&nbsp;<a href="../privacy.html"><font color="#333333" size="-1">個人情報保護方針</font></a></td>
	</tr>
</table>
<!-- InstanceEndEditable -->
<hr color="#666666" size="1" noshade="noshade" />
<img src="../images/common/dot.gif" width="1" height="3" /><br />
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
#04"><font color="#333333" size="-1">商品についてのお問い合わせ</font></a></td>
	</tr>
	<tr>
		<td align="center"><font color="#666666" size="1">■</font></td>
		<td><a href="index.php?action=attention&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
#05"><font color="#333333" size="-1">特定商取引に基づく表記</font></a></td>
	</tr>
</table>
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">■</font></td>
	<td>&nbsp;<a href="../index.html"><font color="#333333" size="-1">FunkyJamトップページへ</font></a></td>
	</tr>
</table>
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="../images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body><!-- InstanceEnd --></html>