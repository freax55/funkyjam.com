<?php /* Smarty version 2.6.18, created on 2014-11-20 21:54:55
         compiled from premium/artist/dl/detail.html */ ?>
<?php if ($this->_tpl_vars['carrier'] == 'au'): ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">
<?php else: ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<?php endif; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>Funky Jam Official mobile site</title>
<meta name="Keywords" content="Funky Jam" />
<meta name="Description" content="Funky Jam" />
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" lang="ja" xml:lang="ja" link="#AD0101" vlink="#AD0101">
<font size="-1" color="#2D0B0A">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#192720">
<tr><th scope="row"><font size="-1" color="#FFFFFF"><?php echo $this->_tpl_vars['name']; ?>
</font></th></tr>
</table>
</font>
<img src="/premium/images/common/dot.gif" height="10" /><br />
<center>
<?php if ($this->_tpl_vars['checkAuthResult']): ?>
<?php if ($this->_tpl_vars['image']): ?>
<img src="<?php echo $this->_tpl_vars['image']['mediumImage']; ?>
" /><br />
<?php elseif ($this->_tpl_vars['voice']): ?>
<font size="-1"><?php echo $this->_tpl_vars['voice']['text']; ?>
</font><br />
<?php elseif ($this->_tpl_vars['template']): ?>
<img src="<?php echo $this->_tpl_vars['template']['mediumImage']; ?>
" /><br />
<?php endif; ?>
<img src="/premium/images/common/dot.gif" height="5" /><br />
<?php endif; ?>
<?php if ($this->_tpl_vars['checkDLFileSupportDevice']): ?>
	<?php if ($this->_tpl_vars['checkAuthResult']): ?>
		<?php if ($this->_tpl_vars['image']): ?>
			<?php if ($this->_tpl_vars['carrier'] == 'docomo'): ?>
<font size="-1" color="#2D0B0A">[<a href="<?php echo $this->_tpl_vars['image']['DLURL']; ?>
">小さいサイズ</a>(<?php echo $this->_tpl_vars['image']['size']; ?>
)]</font><br />
			<?php elseif ($this->_tpl_vars['carrier'] == 'softbank'): ?>
<font size="-1" color="#2D0B0A">[<a href="<?php echo $this->_tpl_vars['image']['DLURL']; ?>
">小さいサイズ</a>(<?php echo $this->_tpl_vars['image']['size']; ?>
)]</font><br />
			<?php elseif ($this->_tpl_vars['carrier'] == 'au'): ?>
[<wml:anchor><wml:spawn href="<?php echo $this->_tpl_vars['image']['DLURL']; ?>
"/>小さいサイズ<wml:catch /></wml:spawn></wml:anchor>(<?php echo $this->_tpl_vars['image']['size']; ?>
) ]<br />
			<?php endif; ?>
<img src="/premium/images/common/dot.gif" height="5" /><br />
			<?php if ($this->_tpl_vars['image_l']): ?>
				<?php if ($this->_tpl_vars['carrier'] == 'docomo'): ?>
<font size="-1" color="#2D0B0A">[<a href="<?php echo $this->_tpl_vars['image_l']['DLURL']; ?>
">大きいサイズ</a>(<?php echo $this->_tpl_vars['image_l']['size']; ?>
)]</font><br />
				<?php elseif ($this->_tpl_vars['carrier'] == 'softbank'): ?>
<font size="-1" color="#2D0B0A">[<a href="<?php echo $this->_tpl_vars['image_l']['DLURL']; ?>
">大きいサイズ</a>(<?php echo $this->_tpl_vars['image_l']['size']; ?>
)]</font><br />
				<?php elseif ($this->_tpl_vars['carrier'] == 'au'): ?>
[<wml:anchor><wml:spawn href="<?php echo $this->_tpl_vars['image_l']['DLURL']; ?>
"/>大きいサイズ<wml:catch /></wml:spawn></wml:anchor>(<?php echo $this->_tpl_vars['image_l']['size']; ?>
) ]<br />
				<?php endif; ?>
			<?php endif; ?>
		<?php elseif ($this->_tpl_vars['voice']): ?>
			<?php if ($this->_tpl_vars['carrier'] == 'docomo'): ?>
<font size="-1" color="#2D0B0A">[<a href="<?php echo $this->_tpl_vars['voice']['DLURL']; ?>
">ダウンロード</a>(<?php echo $this->_tpl_vars['voice']['size']; ?>
)]</font><br />
			<?php elseif ($this->_tpl_vars['carrier'] == 'softbank'): ?>
<font size="-1" color="#2D0B0A">[<a href="http://TMS/DD?sid=EC9D&lid=<?php echo $this->_tpl_vars['voice']['lid']; ?>
&ol=<?php echo $this->_tpl_vars['voice']['DLURL']; ?>
">ダウンロード</a>(<?php echo $this->_tpl_vars['voice']['size']; ?>
)]</font><br />
			<?php elseif ($this->_tpl_vars['carrier'] == 'au'): ?>
[<wml:anchor><wml:spawn href="<?php echo $this->_tpl_vars['voice']['DLURL']; ?>
"/>ダウンロード<wml:catch /></wml:spawn></wml:anchor>(<?php echo $this->_tpl_vars['voice']['size']; ?>
) ]<br />
			<?php endif; ?>
		<?php elseif ($this->_tpl_vars['template']): ?>
			<?php if ($this->_tpl_vars['carrier'] == 'docomo'): ?>
<font size="-1" color="#2D0B0A">[<a href="<?php echo $this->_tpl_vars['template']['DLURL']; ?>
">ダウンロード</a>(<?php echo $this->_tpl_vars['template']['size']; ?>
)]</font><br />
			<?php elseif ($this->_tpl_vars['carrier'] == 'softbank'): ?>
<font size="-1" color="#2D0B0A">[<a href="<?php echo $this->_tpl_vars['template']['DLURL']; ?>
">ダウンロード</a>(<?php echo $this->_tpl_vars['template']['size']; ?>
)]</font><br />
			<?php elseif ($this->_tpl_vars['carrier'] == 'au'): ?>
[<wml:anchor><wml:spawn href="<?php echo $this->_tpl_vars['template']['DLURL']; ?>
"/>ダウンロード<wml:catch /></wml:spawn></wml:anchor>(<?php echo $this->_tpl_vars['template']['size']; ?>
) ]<br />
			<?php endif; ?>
		<?php endif; ?>
	<?php else: ?>
<font size="-1" color="#2D0B0A">ダウンロードするには、有料会員登録が必要となります。</font><br />
	<?php endif; ?>
<?php else: ?>
<font size="-1" color="#2D0B0A">ご利用の端末では、当コンテンツを使用することが出来ません。</font><br />
<?php endif; ?>
</center>
<font size="-1" color="#2D0B0A">
<?php if (! $this->_tpl_vars['checkAuthResult']): ?>
<img src="/premium/images/common/dot.gif" height="5" /><br />
<center><a href="/touroku.html"><font color="#000000" size="3">&lt;&lt;&nbsp;今すぐ入会&nbsp;&gt;&gt;</font></a></center>
<?php endif; ?>
<img src="/premium/images/common/dot.gif" height="5" /><br />
<?php if ($this->_tpl_vars['carrier'] == 'docomo'): ?>
<a href="http://docomo.ne.jp/imt/my/menu/03meyasu_ftop.htm">&gt;&gt;通信料の目安</a><br />
<?php elseif ($this->_tpl_vars['carrier'] == 'softbank'): ?>
<a href="http://mb.softbank.jp/mb/s/dl.html">&gt;&gt;通信料の目安</a><br />
<?php elseif ($this->_tpl_vars['carrier'] == 'au'): ?>
<a href="http://menu2001.ezweb.ne.jp/auinfo/chargeinfo.html">&gt;&gt;通信料の目安</a><br />
<?php endif; ?>
<img src="/premium/images/common/dot.gif" height="5" /><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#EDE8D3">
<tr><td colspan="2"><hr color="#AD864B" size="1" noshade="noshade" /></td></tr>
<tr><td valign="top" align="center" width="3%"><!--<img src="/premium/images/artist/<?php echo $this->_tpl_vars['artist_name']; ?>
/icon_kubota_brown.gif" />--></td><td width="97%"><a href="/premium/artist/kubota/index.html"><font color="#800000" size="-1">久保田利伸</font><font color="#333333" size="1">/日本のR&amp;Bはｺｺｶﾗ</font></a><br />
<tr><td valign="top" align="center" width="3%"><!--<img src="/premium/images/artist/<?php echo $this->_tpl_vars['artist_name']; ?>
/icon_mori_brown.gif" />--></td><td width="97%"><a href="/premium/artist/mori/index.html"><font color="#800000" size="-1">森大輔</font><font color="#333333" size="1">/実力派ｼﾝｶﾞｰｿﾝｸﾞﾗｲﾀｰ</font></a></td></tr>
<tr><td valign="top" align="center" width="3%"><!--<img src="/premium/images/artist/<?php echo $this->_tpl_vars['artist_name']; ?>
/icon_rinko_brown.gif" />--></td><td width="97%"><a href="/premium/artist/urashima/index.html"><font color="#800000" size="-1">浦嶋りんこ</font><font color="#333333" size="1">/舞台に歌に活躍</font></a></td></tr>
<tr><td colspan="2"><!--<font size="-1">
<hr color="#AD864B" size="1" noshade="noshade" />
<img src="/premium/images/artist/<?php echo $this->_tpl_vars['artist_name']; ?>
/arrow_s_right.gif" /><a href="#">週刊ワタル自身</a><br />
<img src="/premium/images/artist/<?php echo $this->_tpl_vars['artist_name']; ?>
/arrow_s_right.gif" /><a href="#">FUNKY社長Blog</a><br /></font>-->
</td></tr>
<tr><td colspan="2">
<div align="right"><a href="#pagetop">このページのTOPへ</a><!--<img src="/premium/images/artist/<?php echo $this->_tpl_vars['artist_name']; ?>
/arrow_up.gif" />--></div>
<hr color="#AD864B" size="1" noshade="noshade" />
<div align="right"><a href="/premium/index.html">会員プレミアムサイトTOPへ</a>&gt;&gt;</div>
<div align="right"><a href="/index.html">FJTOPへ</a>&gt;&gt;</div>
</td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#2D0B0A">
<tr><td><img src="/premium/images/common/dot.gif" height="5" /></td></tr>
<tr><td scope="row" align="center"><font color="#FFFFFF" size="-1">(C)&nbsp;FUNKYJAM</font></td></tr>
<tr><td><img src="/premium/images/common/dot.gif" height="5" /></td></tr>
</table>
</font>
</body></html>