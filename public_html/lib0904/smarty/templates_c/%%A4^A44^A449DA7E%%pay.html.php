<?php /* Smarty version 2.6.18, created on 2015-04-15 18:18:17
         compiled from shop/pay.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'shop/pay.html', 36, false),)), $this); ?>
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
	<td align="center"><!-- InstanceBeginEditable name="header" --><font size="1" color="#FFFFFF">
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
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br />お支払い方法選択<br /><img src="../images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<form  action="index.php" method="post">
<input type="hidden" name="action" value="input" />
<!--<input type="hidden" name="mb" value="1" />-->
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
お支払方法を以下からお選びください。<br />
なお、各支払方法の詳細については<a href="#detail">コチラ</a><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<?php if ($this->_tpl_vars['errors']['payment']): ?><font color="#FF0000">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['payment'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
&nbsp;<input name="payment" type="radio" value="モバイル版FJSHOP 代金引換" <?php if ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP 代金引換'): ?> checked="checked"<?php endif; ?> id="pay01" /><label for="pay01"><font color="#A4272C">[代金引換]</font></label><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="お客様情報入力へ" /><br /><img src="../images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<hr color="#EEEEEE" size="1" noshade="noshade" />
<a name="detail"></a>
支払方法のご説明<br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
<font color="#FF9E23">●</font><a href="#substitution">代金引換</a><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<hr color="#EEEEEE" size="1" noshade="noshade" />
<a name="substitution"></a>
<center><font color="#FF9E23">◆</font>代金引換<font color="#FF9E23">◆</font></center>
<font size="1">商品お届け時に、商品の代金+\1,000(代引手数料／発送梱包料)を現金でお支払いください。<br />
※お支払い方法は「現金のみ」となっております。予めご了承ください。<br />
購入確認メールをご覧頂き、お申込み内容に誤りがあった場合、お申込み日の翌日中にメールにてご連絡下さい。<br />
期間内にご連絡がなかった時点でお申し込み完了とさせて頂き、商品を発送させて頂きます。<br />
尚、お支払いは現金のみとさせて頂きます。<br /></font>
</form>
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<center><a href="index.php?<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
"><font color="#FF9E23" size="-1">FJSHOPトップ</font></a></center>
<img src="../images/common/dot.gif" width="1" height="5" /><br />
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