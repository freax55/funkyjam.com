<?php /* Smarty version 2.6.18, created on 2014-11-21 16:49:29
         compiled from artist/kubota/ticket_reserve/cart.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'artist/kubota/ticket_reserve/cart.html', 25, false),array('modifier', 'number_format', 'artist/kubota/ticket_reserve/cart.html', 26, false),array('modifier', 'default', 'artist/kubota/ticket_reserve/cart.html', 27, false),)), $this); ?>
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
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<?php if ($this->_tpl_vars['cart']): ?>
<?php $this->assign('total', 0); ?>
<?php $this->assign('quantity', 0); ?>
<?php $_from = $this->_tpl_vars['cart']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cart'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cart']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['cart']['iteration']++;
?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
\<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

<div align="right">[<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['size'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
]<br />
<?php echo $this->_tpl_vars['item']['quantity']; ?>
点 <a href="index.php?action=remove&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
&item_code=<?php echo $this->_tpl_vars['item']['item_code']; ?>
">削除</a></div>
<?php $this->assign('total', $this->_tpl_vars['total']+$this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['price']*$this->_tpl_vars['item']['quantity']); ?>
<?php $this->assign('quantity', $this->_tpl_vars['quantity']+$this->_tpl_vars['item']['quantity']); ?>
<?php if (($this->_foreach['cart']['iteration'] == $this->_foreach['cart']['total'])): ?>
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<?php else: ?>
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<center><img src="images/dotline.gif" /></center>
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
<?php $this->assign('quantity', 0); ?>
※カートに商品がございません
<?php endif; ?>
<hr color="#CCCCCC" size="1" noshade="noshade" />
<img src="/images/common/dot.gif" width="1" height="10" /><br />
<div align="right">計<?php echo ((is_array($_tmp=$this->_tpl_vars['quantity'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
点 \<?php echo ((is_array($_tmp=$this->_tpl_vars['total'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
<br /><font color="#FF0000">発送梱包料(手数料)：別途記載</font></div>
<hr color="#CCCCCC" size="1" noshade="noshade" />
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<center>
<?php if ($this->_tpl_vars['cart']): ?>
<a href="index.php?action=pay&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
">注文手続きへ&gt;&gt;</a><br />
<!--<a href="index.php?<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
">&lt;&lt;他の公演を購入する</a><br />
<font color="#FF0000">※札幌公演のみ、プレミアムシート、ブロック指定を同時にご購入いただくことができます。</font><br />-->
<?php else: ?>
<a href="index.php?<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
">&lt;&lt;ショッピングを続ける</a><br />
<?php endif; ?>
</center>
<img src="/images/common/dot.gif" width="1" height="5" /><br />
<!--<hr color="#666666" size="1" noshade="noshade" />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
<font color="#FF0000">※カレンダー及び、カレンダーとその他グッズを同時購入されるお客様へ</font><br />
<img src="/images/common/dot.gif" width="1" height="3" /><br />
カレンダーは12月下旬の発送を予定しております。<br />
またその他グッズを同時購入の場合もカレンダーと同梱発送の為、通常グッズ発送日とは異なり12月下旬の発送となります。<br />
また12/4（土）以降にご入金の場合、年内に発送出来ない可能性がございます。予めご了承下さい。<br />
<img src="/images/common/dot.gif" width="1" height="5" /><br />-->

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