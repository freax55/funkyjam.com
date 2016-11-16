<?php /* Smarty version 2.6.18, created on 2015-02-27 10:55:37
         compiled from artist/kubota/ticket/detail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'artist/kubota/ticket/detail.html', 23, false),array('modifier', 'date_format', 'artist/kubota/ticket/detail.html', 26, false),array('modifier', 'number_format', 'artist/kubota/ticket/detail.html', 32, false),array('modifier', 'nl2br', 'artist/kubota/ticket/detail.html', 34, false),array('modifier', 'count', 'artist/kubota/ticket/detail.html', 48, false),)), $this); ?>
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
<font color="#FF9E23"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</font><br />
<img src="../../../images/common/dot.gif" width="1" height="5" /><br />
</center>
開場：<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['open_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M') : smarty_modifier_date_format($_tmp, '%H:%M')); ?>
<br />
開演：<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['start_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M') : smarty_modifier_date_format($_tmp, '%H:%M')); ?>
<br />
<center>
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<img src="images/dotline.gif" /><br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
[料金]\<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['price'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
<br />
[商品コード]<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['item_code'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['note'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<br />
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />

<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FAE9BA" width="100%">
<tr><td align="center"><font size="-1">


<?php if ($this->_tpl_vars['item']['item_code'] == 'KT20130914' || $this->_tpl_vars['item']['item_code'] == 'KT20130914p'): ?>

	<?php if ($this->_tpl_vars['cart'][$this->_tpl_vars['item']['item_code']]): ?>
	<img src="../../../images/common/dot.gif" width="1" height="4" /><br />
	<center><font color="#FF0000">すでにカートに入っています</font><br />
	<img src="../../../images/common/dot.gif" width="1" height="4" /><br />
	<a href="index.php?action=cart&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
"><font color="#FF9E23">カートを確認する</font></a></center>
	<?php elseif (((is_array($_tmp=$this->_tpl_vars['cart'])) ? $this->_run_mod_handler('count', true, $_tmp) : count($_tmp))): ?>


		<?php if ($this->_tpl_vars['cart']['KT20130914']['item_code']): ?>
			<?php if ($this->_tpl_vars['item']['item_code'] == 'KT20130914p'): ?>
<img src="../../../images/common/dot.gif" width="1" height="8" /><br />
<form  action="index.php" method="get">
<input type="hidden" name="action" value="add" />
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
<input type="hidden" name="p_date" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['p_date'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<input type="hidden" name="place_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['place_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<select name="quantity">
<?php unset($this->_sections['stock']);
$this->_sections['stock']['name'] = 'stock';
$this->_sections['stock']['loop'] = is_array($_loop=$this->_tpl_vars['item']['buy_limit']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<input type="submit" value="カートにいれる" /><br />
</form>
			<?php endif; ?>
		<?php elseif ($this->_tpl_vars['cart']['KT20130914p']['item_code']): ?>
			<?php if ($this->_tpl_vars['item']['item_code'] == 'KT20130914'): ?>
<img src="../../../images/common/dot.gif" width="1" height="8" /><br />
<form  action="index.php" method="get">
<input type="hidden" name="action" value="add" />
<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
<input type="hidden" name="p_date" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['p_date'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<input type="hidden" name="place_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['place_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<select name="quantity">
<?php unset($this->_sections['stock']);
$this->_sections['stock']['name'] = 'stock';
$this->_sections['stock']['loop'] = is_array($_loop=$this->_tpl_vars['item']['buy_limit']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
<input type="submit" value="カートにいれる" /><br />
</form>
			<?php endif; ?>
		<?php else: ?>
			<img src="../../../images/common/dot.gif" width="1" height="4" /><br />
			<center><font color="#FF0000">他のチケットがカートに入っています</font><br />
			<img src="../../../images/common/dot.gif" width="1" height="4" /><br />
			<a href="index.php?action=cart&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
"><font color="#FF9E23">カートを確認する</font></a></center>
		<?php endif; ?>












	<?php else: ?>
	<img src="../../../images/common/dot.gif" width="1" height="8" /><br />
	<form  action="index.php" method="get">
	<input type="hidden" name="action" value="add" />
	<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
	<input type="hidden" name="p_date" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['p_date'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	<input type="hidden" name="place_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['place_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	<select name="quantity">
	<?php unset($this->_sections['stock']);
$this->_sections['stock']['name'] = 'stock';
$this->_sections['stock']['loop'] = is_array($_loop=$this->_tpl_vars['item']['buy_limit']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
	<input type="submit" value="カートにいれる" /><br />
	</form>
	<?php endif; ?>

<?php else: ?>

	<?php if ($this->_tpl_vars['cart'][$this->_tpl_vars['item']['item_code']]): ?>
	<img src="../../../images/common/dot.gif" width="1" height="4" /><br />
	<center><font color="#FF0000">すでにカートに入っています</font><br />
	<img src="../../../images/common/dot.gif" width="1" height="4" /><br />
	<a href="index.php?action=cart&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
"><font color="#FF9E23">カートを確認する</font></a></center>
	<?php elseif (((is_array($_tmp=$this->_tpl_vars['cart'])) ? $this->_run_mod_handler('count', true, $_tmp) : count($_tmp))): ?>
	<img src="../../../images/common/dot.gif" width="1" height="4" /><br />
	<center><font color="#FF0000">他のチケットがカートに入っています</font><br />
	<img src="../../../images/common/dot.gif" width="1" height="4" /><br />
	<a href="index.php?action=cart&<?php echo $this->_tpl_vars['sname']; ?>
=<?php echo $this->_tpl_vars['sid']; ?>
"><font color="#FF9E23">カートを確認する</font></a></center>
	<?php else: ?>	<img src="../../../images/common/dot.gif" width="1" height="8" /><br />
	<form  action="index.php" method="get">
	<input type="hidden" name="action" value="add" />
	<input type="hidden" name="<?php echo $this->_tpl_vars['sname']; ?>
" value="<?php echo $this->_tpl_vars['sid']; ?>
" />
	<input type="hidden" name="p_date" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['p_date'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	<input type="hidden" name="place_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['place_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	<select name="quantity">
	<?php unset($this->_sections['stock']);
$this->_sections['stock']['name'] = 'stock';
$this->_sections['stock']['loop'] = is_array($_loop=$this->_tpl_vars['item']['buy_limit']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
	<input type="submit" value="カートにいれる" /><br />
	</form>
	<?php endif; ?>

<?php endif; ?>









<img src="../../../images/common/dot.gif" width="1" height="8" /><br />
</font>
</td></tr>
</table>
</center>
<img src="../../../images/common/dot.gif" width="1" height="10" /><br />
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