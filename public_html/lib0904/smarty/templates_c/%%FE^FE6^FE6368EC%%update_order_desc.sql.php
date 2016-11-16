<?php /* Smarty version 2.6.18, created on 2015-02-27 11:00:57
         compiled from /home/funkyjam/public_html/mb/artist/kubota/ticket/sql/update_order_desc.sql */ ?>
update order_desc
set d_stamp = null,
	settlement_no = '<?php echo $this->_tpl_vars['settlement_no']; ?>
',
	recognition_no = '<?php echo $this->_tpl_vars['recognition_no']; ?>
'
where order_desc_no = <?php echo $this->_tpl_vars['order_desc_no']; ?>
