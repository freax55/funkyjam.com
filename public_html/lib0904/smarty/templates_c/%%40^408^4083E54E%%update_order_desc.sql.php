<?php /* Smarty version 2.6.18, created on 2014-11-25 16:43:01
         compiled from artist/kubota/ticket_reserve/sql/update_order_desc.sql */ ?>
update order_desc
set d_stamp = null,
	settlement_no = '<?php echo $this->_tpl_vars['settlement_no']; ?>
',
	recognition_no = '<?php echo $this->_tpl_vars['recognition_no']; ?>
'
where order_desc_no = <?php echo $this->_tpl_vars['order_desc_no']; ?>
