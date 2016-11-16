<?php /* Smarty version 2.6.18, created on 2014-11-21 16:49:21
         compiled from artist/kubota/ticket_reserve/list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strtotime', 'artist/kubota/ticket_reserve/list.html', 23, false),array('modifier', 'date_format', 'artist/kubota/ticket_reserve/list.html', 23, false),array('modifier', 'escape', 'artist/kubota/ticket_reserve/list.html', 37, false),array('modifier', 'default', 'artist/kubota/ticket_reserve/list.html', 38, false),array('modifier', 'number_format', 'artist/kubota/ticket_reserve/list.html', 38, false),array('modifier', 'nl2br', 'artist/kubota/ticket_reserve/list.html', 38, false),)), $this); ?>
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
		<img src="../../../images/common/dot.gif" width="1" height="5" /><br /><h3>FJ SHOP</h3>
		FUNKY JAM SHOPPING STORE</font><br /><img src="../../../images/common/dot.gif" width="1" height="5" />
	</td>
</tr>
</table>

<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<center>
<font color="#FF9E23"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('strtotime', true, $_tmp) : strtotime($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y年%m月') : smarty_modifier_date_format($_tmp, '%Y年%m月')); ?>
</font><br />
</center>
<img src="../../../images/common/dot.gif" width="1" height="5" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />

<?php if ($this->_tpl_vars['cart']): ?>
<center>
<font color="#FF0000">すでにカートに商品入っています</font><br />
<a href="index.php?action=cart&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
"><font color="#FF9E23">カートを確認する</font></a>
</center>
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<?php endif; ?>
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['item'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['item']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['item']['iteration']++;
?>
<a href="index.php?action=detail&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
&item_code=<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['item_code'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><font color="#333333"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font></a><br />
<div align="right">[<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['size'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
]<br />\<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
<br /><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['note'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</div>
<?php if (($this->_foreach['item']['iteration'] == $this->_foreach['item']['total'])): ?>
<img src="../../../images/common/dot.gif" width="1" height="5" /><br />
<?php else: ?>
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<hr color="#666666" size="1" noshade="noshade" />
<img src="../../../images/common/dot.gif" width="1" height="5" /><br />
<center><a href="index.php?<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
"><font color="#FF9E23" size="-1">お申込みトップページへ</font></a></center>
<img src="../../../images/common/dot.gif" width="1" height="5" /><br />

<hr color="#666666" size="1" noshade="noshade" />
<img src="../../../images/common/dot.gif" width="1" height="3" /><br />
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
<img src="../../../images/common/dot.gif" width="1" height="3" /><br />
<hr color="#666666" size="1" noshade="noshade" />
<img src="../../../images/common/dot.gif" width="1" height="3" /><br />
<center>(C)&nbsp;FUNKYJAM&nbsp;</center>
</font>
</body></html>