<?php /* Smarty version 2.6.18, created on 2014-11-21 18:15:08
         compiled from /home/funkyjam/public_html/mb/../lib0904/util/mobile_premium/sql/termination.sql */ ?>
UPDATE premium_users SET d_stamp = current_timestamp WHERE uid = '<?php echo $this->_tpl_vars['uid']; ?>
' AND d_stamp IS NULL