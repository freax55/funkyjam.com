<?php /* Smarty version 2.6.18, created on 2014-11-20 22:10:53
         compiled from /home/funkyjam/public_html/mb/../lib0904/util/mobile_premium/sql/auth.sql */ ?>
SELECT uid

FROM premium_users

WHERE uid = '<?php echo $this->_tpl_vars['uid']; ?>
'
AND d_stamp IS NULL
;