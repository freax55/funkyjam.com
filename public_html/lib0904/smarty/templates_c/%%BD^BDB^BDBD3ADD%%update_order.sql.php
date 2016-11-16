<?php /* Smarty version 2.6.18, created on 2015-02-27 11:00:57
         compiled from /home/funkyjam/public_html/mb/artist/kubota/ticket/sql/update_order.sql */ ?>
update "order"
set d_stamp = null
where order_no = <?php echo $this->_tpl_vars['order_no']; ?>
