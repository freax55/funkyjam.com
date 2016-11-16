<?php /* Smarty version 2.6.18, created on 2015-10-06 14:02:18
         compiled from shop/detail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'shop/detail.html', 23, false),array('modifier', 'nl2br', 'shop/detail.html', 29, false),array('modifier', 'default', 'shop/detail.html', 34, false),array('modifier', 'number_format', 'shop/detail.html', 36, false),)), $this); ?>
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
		FUNKY JAM SHOPPING STORE</font><br /><img src="../images/common/dot.gif" width="1" height="5" /><!-- InstanceEndEditable -->
	</td>
</tr>
</table>
<!-- InstanceBeginEditable name="main" -->
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<center>
<img src="index.php?action=image&path=<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['image'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&size=200" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<a href="index.php?action=list&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
&category_code=<?php echo $this->_tpl_vars['item']['category_code']; ?>
&page=1"><?php echo ((is_array($_tmp=$this->_tpl_vars['orderList'][$this->_tpl_vars['category_code']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a><br />
<font color="#FF9E23"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br />
<img src="../images/common/dot.gif" width="1" height="5" /><br />
</center>
<?php if ($this->_tpl_vars['item']['note']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['note'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<?php else: ?>&nbsp;<?php endif; ?><?php if ($this->_tpl_vars['item']['item_code'] == 'TKTL0180' || $this->_tpl_vars['item']['item_code'] == 'TKTL0152' || $this->_tpl_vars['item']['item_code'] == 'TKTL0153'): ?><br /><br /><center><strong style="color: #FF0000; font-size:137%;"> SOLD OUT </strong></center><br /><?php endif; ?>
<center>
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<img src="images/dotline.gif" /><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
[色]<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['color'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
<br />
[サイズ]<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['size'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
<br />
[料金]\<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
<br />
[商品コード]<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['item_code'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />

<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FAE9BA" width="100%">
<tr><td align="center"><font size="-1">
<?php if ($this->_tpl_vars['item']['item_code'] == 'TKTL0180' || $this->_tpl_vars['item']['item_code'] == 'TKTL0152' || $this->_tpl_vars['item']['item_code'] == 'TKTL0153'): ?>
&nbsp;
<?php elseif ($this->_tpl_vars['cart'][$this->_tpl_vars['item']['item_code']]): ?>
<img src="../../../images/common/dot.gif" width="1" height="4" /><br />
<center><font color="#FF0000">すでにカートに入っています</font><br />
<img src="../../../images/common/dot.gif" width="1" height="4" /><br />
<a href="index.php?action=cart&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
"><font color="#FF9E23">カートを確認する</font></a></center>
<?php else: ?>
<img src="../images/common/dot.gif" width="1" height="8" /><br />
<form  action="index.php" method="get">
<input type="hidden" name="action" value="add" />
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />

<?php if ($this->_tpl_vars['item']['item_code'] == 'TKTL0140' || $this->_tpl_vars['item']['item_code'] == 'TKTL0151' || $this->_tpl_vars['item']['item_code'] == 'TKTL0152' || $this->_tpl_vars['item']['item_code'] == 'TKTL0153' || $this->_tpl_vars['item']['item_code'] == 'TKTL0160' || $this->_tpl_vars['item']['item_code'] == 'TKTL0170' || $this->_tpl_vars['item']['item_code'] == 'TKTL0180'): ?>
												<?php $this->assign('max_quantity', 3); ?>
											<?php else: ?>
												<?php $this->assign('max_quantity', 10); ?>
											<?php endif; ?>

<select name="quantity">
<?php unset($this->_sections['stock']);
$this->_sections['stock']['name'] = 'stock';
$this->_sections['stock']['loop'] = is_array($_loop=$this->_tpl_vars['max_quantity']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['stock']['show'] = true;
$this->_sections['stock']['max'] = $this->_sections['stock']['loop'];
$this->_sections['stock']['step'] = 1;
$this->_sections['stock']['start'] = $this->_sections['stock']['step'] > 0 ? 0 : $this->_sections['stock']['loop']-1;
if ($this->_sections['stock']['show']) {
    $this->_sections['stock']['total'] = $this->_sections['stock']['loop'];
    if ($this->_sections['stock']['total'] == 0)
        $this->_sections['stock']['show'] = false;
} else
    $this->_sections['stock']['total'] = 0;
if ($this->_sections['stock']['show']):

            for ($this->_sections['stock']['index'] = $this->_sections['stock']['start'], $this->_sections['stock']['iteration'] = 1;
                 $this->_sections['stock']['iteration'] <= $this->_sections['stock']['total'];
                 $this->_sections['stock']['index'] += $this->_sections['stock']['step'], $this->_sections['stock']['iteration']++):
$this->_sections['stock']['rownum'] = $this->_sections['stock']['iteration'];
$this->_sections['stock']['index_prev'] = $this->_sections['stock']['index'] - $this->_sections['stock']['step'];
$this->_sections['stock']['index_next'] = $this->_sections['stock']['index'] + $this->_sections['stock']['step'];
$this->_sections['stock']['first']      = ($this->_sections['stock']['iteration'] == 1);
$this->_sections['stock']['last']       = ($this->_sections['stock']['iteration'] == $this->_sections['stock']['total']);
?>
<option value="<?php echo $this->_sections['stock']['iteration']; ?>
"><?php echo $this->_sections['stock']['iteration']; ?>
</option>
<?php endfor; endif; ?>
</select><br />
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<input type="submit" value="カートにいれる" /><br />
</form>
<?php endif; ?>
<img src="../images/common/dot.gif" width="1" height="8" /><br />
</font>
</td></tr>
</table>
</center>
<img src="../images/common/dot.gif" width="1" height="10" /><br />
<center><a href="index.php?<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
"><font color="#FF9E23" size="-1">FJSHOPトップ</font></a></center>
<img src="../images/common/dot.gif" width="1" height="5" /><br />
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