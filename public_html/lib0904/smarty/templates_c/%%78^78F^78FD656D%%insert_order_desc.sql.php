<?php /* Smarty version 2.6.18, created on 2014-11-25 16:42:59
         compiled from artist/kubota/ticket_reserve/sql/insert_order_desc.sql */ ?>
INSERT INTO order_desc(	order_desc_no,	member_no,	payment,	name,	kana,	zip,	address1,	address2,	address3,	mail,	tel,	carriage,	d_stamp) 	VALUES(	<?php echo $this->_tpl_vars['p04']; ?>
,	'<?php echo $this->_tpl_vars['member_no']; ?>
',	'<?php echo $this->_tpl_vars['payment']; ?>
',	'<?php echo $this->_tpl_vars['last_name']; ?>
' || ' ' || '<?php echo $this->_tpl_vars['first_name']; ?>
',	'<?php echo $this->_tpl_vars['last_kana']; ?>
' || ' ' || '<?php echo $this->_tpl_vars['first_kana']; ?>
',	'<?php echo $this->_tpl_vars['zip1']; ?>
' || '-' || '<?php echo $this->_tpl_vars['zip2']; ?>
',	'<?php echo $this->_tpl_vars['address1']; ?>
',	'<?php echo $this->_tpl_vars['address2']; ?>
',	'<?php echo $this->_tpl_vars['address3']; ?>
',	'<?php echo $this->_tpl_vars['mail']; ?>
',	'<?php echo $this->_tpl_vars['tel']; ?>
',	<?php echo $this->_tpl_vars['carriageTotal']; ?>
,	current_timestamp);