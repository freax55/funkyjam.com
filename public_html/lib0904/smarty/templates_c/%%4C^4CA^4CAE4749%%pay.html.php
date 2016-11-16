<?php /* Smarty version 2.6.18, created on 2014-11-21 16:57:33
         compiled from artist/kubota/ticket_reserve/pay.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'artist/kubota/ticket_reserve/pay.html', 36, false),array('modifier', 'nl2br', 'artist/kubota/ticket_reserve/pay.html', 84, false),)), $this); ?>
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
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br />お支払い方法選択画面<br /><img src="/images/common/dot.gif" width="1" height="3" /></td>
	</tr>
</table>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<form  action="index.php" method="post">
<input type="hidden" name="action" value="input" />
<!--<input type="hidden" name="mb" value="1" />-->
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
<a name="payment"></a>お支払方法を以下からお選びください。<br />
各支払方法の詳細については<a href="#detail">コチラ</a><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<?php if ($this->_tpl_vars['errors']['payment']): ?><font color="#FF0000">※<?php echo ((is_array($_tmp=$this->_tpl_vars['errors']['payment'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br /><?php endif; ?>
<!--&nbsp;<input name="payment" type="radio" value="モバイル版FJSHOP BariBariCrewCARD" <?php if ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP BariBariCrewCARD'): ?> checked="checked"<?php endif; ?> id="pay03" /><label for="pay03"><font color="#A4272C">[BariBariCrewｶｰﾄﾞ決済]</font></label><br />
&nbsp;<input name="payment" type="radio" value="モバイル版FJSHOP コンビニ決済" <?php if ($this->_tpl_vars['payment'] == 'モバイル版FJSHOP コンビニ決済'): ?> checked="checked"<?php endif; ?> id="pay04" /><label for="pay04"><font color="#A4272C">[ｺﾝﾋﾞﾆ決済]</font></label><br />-->
&nbsp;<input name="payment" type="radio" value="モバイル版FJSHOP 予約" checked="checked" id="pay02" /><label for="pay02"><font color="#A4272C">[BARI BARI CREWカード決済（予約）]</font></label><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<center>
<table border="1" cellspacing="0" cellpadding="0" bordercolor="#FFCC00" bgcolor="#FAE9BA" width="70%">
	<tr>
		<td align="center"><img src="/images/common/dot.gif" width="1" height="3" /><br /><input type="submit" value="お客様情報入力へ" /><br /><img src="/images/common/dot.gif" width="1" height="3" /><br /></td>
	</tr>
</table>
</center>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<hr color="#EEEEEE" size="1" noshade="noshade" />
<a name="detail"></a>
支払方法のご説明<br />
<!--<img src="/images/common/dot.gif" width="1" height="5" /><br />
<font color="#FF9E23">●</font><a href="#cardBBC">BariBariCrewカード決済</a><br />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<font color="#FF9E23">●</font><a href="#conveni">コンビニ決済</a><br />-->
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<font color="#FF9E23">●</font><a href="#yubin">BARI BARI CREWカード決済（予約）</a><br />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<hr color="#EEEEEE" size="1" noshade="noshade" />
<!--<a name="cardBBC"></a>
<center><font color="#FF9E23">◆</font>BariBariCrewカード決済<font color="#FF9E23">◆</font></center>
<font size="1">・一括払いのみのお取り扱いとなります。<br />
・引落時カードの有効期限が切れている場合、決済が出来ませんので<font color="#A4272C">お申込みは無効</font>となります。<br />
・BARI BARI CREWカード決済につきましては、システム上、お申込み完了時点でご購入確定とさせて頂きます。ご注意下さい。<br />
・購入内容確認画面を保存されることをお勧め致します。<br /></font>
<div align="right"><a href="#payment">↑お支払い方法選択へ</a></div>
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<a name="conveni"></a>
<center><font color="#FF9E23">◆</font>コンビニ決済<font color="#FF9E23">◆</font></center>
<font size="1">■お支払いいただけるコンビニエンスストア<br />
セブンイレブン・ローソン・ファミリーマート・セイコーマート・サークルKサンクス・デイリーヤマザキ（ヤマザキデイリーストア・タイムリー）<br />
<br />
・コンビニエンスストアからのご入金確認後、購入完了となります。<br />
・支払期限内にお振込み下さい。<br />
※支払期限が切れた場合はシステムで自動的にキャンセルされ、<font color="#A4272C">お申込みは無効</font>となります。<br />
※支払い先を間違えますと<font color="#A4272C">チケットはご用意出来ません</font>。<br />
・振込合計金額（チケット代＋送料）の他に決済手数料※が必要です。<br />
※決済手数料の詳細は「<a href="attention.html#06">決済手数料について</a>」をご確認下さい。<br />
・専用振替用紙は送付致しておりません。<br />
・購入内容確認画面及び申込み完了画面を保存されることをお勧め致します。<br />
<?php $_from = $this->_tpl_vars['units']['convenience_stores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['n'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['n']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['n']['iteration']++;
?>
<a name="convenience_store_<?php echo $this->_tpl_vars['k']; ?>
_detail"></a>
<font color="#FF9E23">・</font><?php echo $this->_tpl_vars['v']['name']; ?>
<br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['detail'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<br />
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<?php endforeach; endif; unset($_from); ?>
</font>-->

<a name="yubin"></a>
<center><font color="#FF9E23">◆</font>BARI BARI CREWカード決済（予約）<font color="#FF9E23">◆</font></center>
<font size="1">
*購入内容確認メールが自動配信されます。<br />
（例：2公演お申込みの場合、購入内容確認メールは2通届きます。）<strong>必ずすべてのメールをご確認ください。</strong><br />
<strong>・チケットの購入、抽選3,000席分最前列ふくむ良席の抽選対象になる為には<font color="#FF0000">2014年1月10日まで</font>にBARI BARI CREW CARDが発行されていることが条件です。</strong><br />
・一括払いのみのお取り扱いとなります。<br />
・引落時カードの有効期限が切れている場合、決済が出来ませんので<b>お申込みは無効</b>となります。<br />
・BARI BARI CREWカード決済（予約）につきましては、お申込み完了後、BARI BARI CREWカードが発行された時点でご購入確定とさせて頂きます。<br />
・チケットお申し込み後、受付期間内にカードが発行された場合、再度手続きの必要はございません。<br />
・2014年1月10日までにBARI BARI CREWカードが発行されなかった場合、別途お支払い方法をご案内させていただきます。お電話やメールにてお知らせいたしますので必ず連絡のつくご連絡先をご入力ください<br />
・購入内容確認画面を保存されることをお勧め致します。<br />
</font>
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<!--<a name="atm"></a>
<center><font color="#FF9E23">◆</font>ATM決済<font color="#FF9E23">◆</font></center>
<font size="1">ペイジーマークのあるATMにてお支払い頂けます。<br />
申込み完了後に送信されます購入内容確認メール記載の「収納機関番号」「お客様番号」「確認番号」をメモして、下記の銀行のATMへ行き、お支払い下さい。<br />
<img src="/images/common/dot.gif" width="1" height="5" /><br />
■お支払いいただける銀行<br />
ゆうちょ銀行・三井住友銀行・りそな銀行・埼玉りそな銀行・千葉銀行・京葉銀行・みずほ銀行<br />
<br />
・ATMからのご入金確認後、購入完了となります。<br />
・支払期限内にお振込み下さい。(支払期限は購入内容確認メールに記載しております。)<br />
※支払期限が切れた場合はシステムで自動的にキャンセルされ、<font color="#A4272C">お申込みは無効</font>となります。<br />
※複数公演お申込みの場合、<font color="#A4272C">支払いに必要な番号はお申込み毎に異なります</font>。1件ずつお支払い下さい。支払い先を間違えますと<font color="#A4272C">チケットはご用意出来ません</font>。<br />
・振込合計金額（チケット代＋送料）の他に決済手数料※が必要です。<br />
※決済手数料の詳細は「<a href="attention.html#06">決済手数料について</a>」をご確認下さい。<br />
・購入内容確認画面及び申込み完了画面を保存されることをお勧め致します。<br />

</font>-->
<div align="right"><a href="#payment">↑お支払い方法選択へ</a></div>
<img src="/images/common/dot.gif" width="1" height="10" /><br />

</form>
<img src="/images/common/dot.gif" width="1" height="5" /><br />
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