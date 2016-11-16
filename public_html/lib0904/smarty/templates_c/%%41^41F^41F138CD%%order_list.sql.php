<?php /* Smarty version 2.6.18, created on 2015-02-27 11:00:56
         compiled from /home/funkyjam/public_html/mb/artist/kubota/ticket/sql/order_list.sql */ ?>
SELECT * FROM "order"WHERE order_desc_no = <?php echo $this->_tpl_vars['order_desc_no']; ?>
;