<?php /* Smarty version 2.6.18, created on 2015-02-27 11:00:57
         compiled from /home/funkyjam/public_html/mb/artist/kubota/ticket/sql/update_apply_date_order_desc.sql */ ?>
update order_desc
set apply_date = current_timestamp
where order_desc_no = <?php echo $this->_tpl_vars['order_desc_no']; ?>
