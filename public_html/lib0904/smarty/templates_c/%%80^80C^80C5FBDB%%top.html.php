<?php /* Smarty version 2.6.18, created on 2015-02-27 17:11:48
         compiled from artist/kubota/login_tour/top.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'artist/kubota/login_tour/top.html', 45, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>Funky Jam</title>
<meta name="Keywords" content="Funky Jam" />
<meta name="Description" content="Funky Jam" />
</head>
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" lang="ja" xml:lang="ja" link="#FFFFFF">
<font size="-1" color="#FFFFFF">
<a name="pagetop"></a>
<center>
<img src="../../../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="image/logo.jpg" width="200" height="61" /></td>
	</tr>
</table>
</center>
<img src="../../../images/common/dot.gif" width="1" height="3" /><br />
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#662312" width="100%">
	<tr>
		<td><img src="../../../images/common/dot.gif" width="4" height="1" /><img src="image/t_login.gif" width="57" height="26" /></td>
	</tr>
</table>
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<form action="index.php" method="post">
<input type="hidden" name="action" value="login" />
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
<center>
<!--<a href="#forBBC"><font color="#FFFFFF">チケット発送状況はコチラ</font></a><br /><br />-->
<font color="#FF9E23">◆</font>パスワード<font color="#FF9E23">◆</font><br />
<br />
久保田利伸アリーナ公演 L.O.K Supa Dupa<br />
Bari Bari Crew会員限定 チケット優先予約<br />
<br />
【受付期間】 2015年 3月 2日(月) 12：00〜 2015年 3月 13日(金) 23：59<br />
<br />
<font color="#FF0000">!!!お申込み前に必ずご使用いただくメールアドレスの受信設定をご確認ください!!!</font><br />
<br />
会報113号の9ページ記載のパスワードをご入力ください。<br />
(2015年2月にご入会の方は、新規特典に同封のご案内をご確認ください。)<br />
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<?php if ($this->_tpl_vars['errors']['time']): ?><font color="#A4272C">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['time'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
<?php if ($this->_tpl_vars['errors']['phrase']): ?><font color="#A4272C">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['phrase'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
<input type="text" name="form[phrase]" value="" width="100" /><br />※半角大文字<br /></center>
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="../../../images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="ログイン" /><br /><img src="../../../images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
</form>
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<hr>
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
「 郵便振込 」にてチケットをお申込みされる方は、会報113号10ページをご確認の上、<br />
必要事項を明記いただき受付期間内にお振込みください。<br />
<br />
※会報113号は2月25日に発送しております。<br />
<b>3月5日</b>を過ぎてもお手元に届かない場合は、至急バリバリクルーまでお問い合わせください。<br />
<br />
これからご入会の方は<a href="../fanclub/index.html">こちら</a>をクリック！<br />
<br />
<!--
<a name="forBBC"></a><center><font color="#FF9E23">◆</font>BARI BARI CREW会員の皆様へ<font color="#FF9E23">◆</font></center>
<br />
<font color="#FFCC00">▼</font>2010/7/22<br />
以下コンサートチケットを発送致しました。<br />
<br />
広島ALSOKホール(8/14)、岡山市民会館(8/15)、大阪国際会議場メインホール(8/17)、新潟県民会館(8/22)<br />
<br />
<font color="#FFCC00">▼</font>2010/7/16<br />
以下コンサートチケットを発送致しました。<br />
<br />
福岡市民会館(8/6、7)、鹿児島市民文化ホール第一(8/9)<br />
<br />
<font color="#FFCC00">▼</font>2010/7/9<br />
以下コンサートチケットを発送致しました。<br />
<br />
東京国際フォーラム ホールA(7/28、29)<br /><br />
<font color="#FFCC00">▼</font>2010/7/2<br />
以下コンサートチケットを発送致しました。<br />
<br />
大阪国際会議場メインホール(7/21、22)、松山市総合コミュニティーセンターキャメリアホール(7/24)<br />
<br />
お申込み公演10日前になってもチケットが届かない場合、PC/モバイルの方は購入内容ご確認メールに記載の『お申込み番号』にてバリバリクルーまでお問合せ下さい。郵便振込の方は『払込控え』のコピーをハガキに貼り、「チケット事故係」へ住所・氏名・会員番号・公演日・会場名を明記し、お送り下さい。<br />
&lt;お問い合せ先&gt;(株)ファンキー・ジャム内バリバリクルー<br />
〒106-8626　港区西麻布1-14-2-302<br />
TEL03-3470-7709(15〜18:00以外はインフォメーションテープ)<br />
<img src="../images/common/dot.gif" width="1" height="18" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="../../../images/common/dot.gif" width="1" height="3" /><br />
-->
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td><font color="#666666" size="-1">■</font></td>
	<td>&nbsp;<a href="../../../index.html"><font color="#FFFFFF" size="-1">トップページへ</font></a></td>
	</tr>
</table>
<img src="../../../images/common/dot.gif" width="1" height="3" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="../../../images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body></html>