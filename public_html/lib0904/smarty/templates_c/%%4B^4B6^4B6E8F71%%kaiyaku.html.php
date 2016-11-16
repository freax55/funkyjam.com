<?php /* Smarty version 2.6.18, created on 2014-11-21 04:26:43
         compiled from kaiyaku.html */ ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/common.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>Funky Jam</title>
<meta name="Keywords" content="Funky Jam" />
<meta name="Description" content="Funky Jam" />
</head>
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" lang="ja" xml:lang="ja" link="#FFFFFF">
<font size="-1" color="#FFFFFF">
<a name="pagetop"></a>
<center><!-- InstanceBeginEditable name="header" -->
<img src="images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="images/common/logo.gif" width="50" height="26" /></td>
		<td>&nbsp;<font size="1" color="#FFFFFF">Official mobile site</font></td>
	</tr>
</table>
<!-- InstanceEndEditable --></center>
<!-- InstanceBeginEditable name="main" -->
<img src="images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#333333" width="100%">
	<tr>
		<td><img src="images/common/dot.gif" width="1" height="5" /><br /><font color="#FFFFFF">解約</font><br /><img src="images/common/dot.gif" width="1" height="5" /></td>
	</tr>
</table>
<img src="images/common/dot.gif" width="1" height="10" /><br />
<font size="1">
<img src="images/common/dot.gif" width="1" height="5" /><br />
FunkyJam mobile siteの会員向けページでは、待受けFlashやオリジナルデコレーション用メールテンプレートなど
沢山のコンテンツをお届しています。<br />
何よりここでしか見られない沢山の貴重なオフショット！<br />
<br />
<?php if ($this->_tpl_vars['supportUA'] && $this->_tpl_vars['carrier'] != 'au'): ?>
<center><a href="/premium/artist/wallpaper/kubota_index.html">待受け</a> | <a href="/premium/artist/decoration/kubota_index.html">デコレーション</a><br /><a href="/premium/artist/offshot/kubota_index.html">オフショット</a></center>
<?php endif; ?>
</font>
<br />
<font size="1">ページ下の「解約する」より会員解除手続きを行ってください。<br />
<br />
※当サイトは月額制のサービスです。月のなかばで解約されても、1ヶ月のご利用料が請求されますのでご了承ください。<br />
<br />
<br />
解約しますがよろしいですか？<br />
<br />
<br />
<?php if ($this->_tpl_vars['carrier'] == 'docomo'): ?>
<form action="http://w1m.docomo.ne.jp/cp/regst" method="post">
<input type="hidden" name="ci" value="00003400401">
<input type="hidden" name="uid" value="NULLGWDOCOMO">
<input type="hidden" name="nl" value="">
<input type="hidden" name="rl" value="<?php echo $this->_tpl_vars['rl_url']; ?>
">
<input type="hidden" name="act" value="rel">
<center><input type="submit" name="submit" value="マイメニュー削除"></center>
</form>
<?php elseif ($this->_tpl_vars['carrier'] == 'softbank'): ?>
<form action="http://JPHONE/CONFOFF" method="get">
<input type="hidden" name="sid" value="ECBW">
<input type="hidden" name="nl" value="<?php echo $this->_tpl_vars['nl_url']; ?>
">
<input type="hidden" name="cl" value="<?php echo $this->_tpl_vars['cl_url']; ?>
">
<center><input type="submit" name="submit" value="解約する"></center>
</form>
<?php elseif ($this->_tpl_vars['carrier'] == 'au'): ?>
<form action="<?php echo $this->_tpl_vars['cancellationRequestURL']; ?>
" method="post">
<input type="hidden" name="cp_cd" value="<?php echo $this->_tpl_vars['cp_cd']; ?>
">
<input type="hidden" name="cp_srv_cd" value="<?php echo $this->_tpl_vars['cp_srv_cd']; ?>
">
<input type="hidden" name="item_cd" value="<?php echo $this->_tpl_vars['item_cd']; ?>
">
<input type="hidden" name="use_fin_page" value="1">
<input type="hidden" name="ok_url" value="<?php echo $this->_tpl_vars['ok_url']; ?>
">
<input type="hidden" name="ng_url" value="<?php echo $this->_tpl_vars['ng_url']; ?>
">
<center><input type="submit" name="submit" value="解約する"></center>
</form>
<?php endif; ?>
</font>
<img src="images/common/dot.gif" width="1" height="18" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="footer" -->
<!-- InstanceEndEditable -->
<img src="images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">■</font></td>
	<td>&nbsp;<a href="index.html"><font color="#FFFFFF" size="-1">トップページへ</font></a></td>
	</tr>
</table>
<img src="images/common/dot.gif" width="1" height="3" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body><!-- InstanceEnd --></html>