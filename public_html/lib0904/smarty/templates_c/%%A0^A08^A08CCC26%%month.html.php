<?php /* Smarty version 2.6.18, created on 2014-11-21 16:49:18
         compiled from artist/kubota/ticket_reserve/month.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strtotime', 'artist/kubota/ticket_reserve/month.html', 72, false),array('modifier', 'date_format', 'artist/kubota/ticket_reserve/month.html', 72, false),array('modifier', 'escape', 'artist/kubota/ticket_reserve/month.html', 72, false),)), $this); ?>
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
		<img src="/images/common/dot.gif" width="1" height="5" /><br /><img src="images/logo.jpg" /><br />
		<font size="1" color="#FFFFFF">FUNKY JAM SHOPPING STORE</font><br />
		<img src="/images/common/dot.gif" width="1" height="5" />
	</td>
</tr>
</table>

<img src="/images/common/dot.gif" width="1" height="5" /><br />
ページ一番下より、ご希望の月を選択し、チケット購入画面に進んでください。<br />
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<font size="1">※ご購入完了後に確認のメールをパソコンからお送りします。ドメイン指定受信を行っている方は
<form action="get"><center><input type="text" name="funkyjam" value="@funkyjam.com" size="12" /><br /></center></form>
のドメイン登録をお願いいたします。<br />
申込完了後メールが届きます。届かない場合は至急バリバリクルーまでご連絡ください。<br />
お申込み後に設定の変更をされても確認メールは届きませんのでご注意下さい。</font><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<center>
<table width="95%" border="1" cellspacing="0" cellpadding="0">
<tr><td><font size="-1"><font color="#FF9E23">◆</font>チケット代金<br />
<font color="#48484A"><font color="#A4272C">1枚8,100円</font>(税込)<br /></font>
<font color="#FF9E23">◆</font>送料<br />
<font color="#48484A">1公演日につき<font color="#A4272C">400円</font>(税込)</font><br />
</font></td></tr>
</table>
</center>
<img src="/images/common/dot.gif" width="1" height="3" /><br />
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
<center>
<font color="#A4272C">■お申込みはこちらから■</font><br />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<?php $_from = $this->_tpl_vars['monthList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['monthList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['monthList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['monthList']['iteration']++;
?>
【<a href="index.php?action=list&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
&date=<?php echo $this->_tpl_vars['item']['date']; ?>
"><font color="#333333"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['date'])) ? $this->_run_mod_handler('strtotime', true, $_tmp) : strtotime($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y年%m月') : smarty_modifier_date_format($_tmp, '%Y年%m月')))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
公演分</font></a>】<br />
<img src="/images/common/dot.gif" width="1" height="8" /><br />
<?php endforeach; endif; unset($_from); ?>
</center>
<hr color="#666666" size="1" noshade="noshade" />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body></html>