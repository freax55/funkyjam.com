<?php /* Smarty version 2.6.18, created on 2015-02-27 11:00:54
         compiled from artist/kubota/ticket/sql/insert_order.sql */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'pg_escape_string', 'artist/kubota/ticket/sql/insert_order.sql', 1, false),)), $this); ?>
INSERT INTO "order"(	order_no,	order_desc_no,	item_code,	category_code,	name,	price,	quantity,	p_date,	place,	d_stamp) 	VALUES(	(SELECT coalesce(max(order_no), 0) + 1 FROM "order"),	<?php echo $this->_tpl_vars['p04']; ?>
,	'<?php echo $this->_tpl_vars['item']['item_code']; ?>
',	'<?php echo $this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['category_code']; ?>
',	'<?php echo ((is_array($_tmp=$this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['name'])) ? $this->_run_mod_handler('pg_escape_string', true, $_tmp) : pg_escape_string($_tmp)); ?>
',	'<?php echo $this->_tpl_vars['itemList'][$this->_tpl_vars['item']['item_code']]['price']; ?>
',	'<?php echo $this->_tpl_vars['item']['quantity']; ?>
',	'<?php echo $this->_tpl_vars['item']['p_date']; ?>
',	'<?php echo $this->_tpl_vars['item']['place_name']; ?>
',	current_timestamp);