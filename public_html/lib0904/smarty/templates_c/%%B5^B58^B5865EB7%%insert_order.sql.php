<?php /* Smarty version 2.6.18, created on 2015-04-17 02:51:09
         compiled from shop/sql/insert_order.sql */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'pg_escape_string', 'shop/sql/insert_order.sql', 1, false),)), $this); ?>
INSERT INTO "order"(	order_no,	order_desc_no,	item_code,	category_code,	name,	color,	size,	price,	quantity,	d_stamp) 	VALUES(	(SELECT coalesce(max(order_no), 0) + 1 FROM "order"),	<?php echo $this->_tpl_vars['p04']; ?>
,	'<?php echo $this->_tpl_vars['item']['item_code']; ?>
',	'<?php echo $this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['category_code']; ?>
',	'<?php echo ((is_array($_tmp=$this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['name'])) ? $this->_run_mod_handler('pg_escape_string', true, $_tmp) : pg_escape_string($_tmp)); ?>
',	'<?php echo $this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['color']; ?>
',	'<?php echo $this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['size']; ?>
',	'<?php echo $this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['price']; ?>
',	'<?php echo $this->_tpl_vars['item']['quantity']; ?>
',	null);