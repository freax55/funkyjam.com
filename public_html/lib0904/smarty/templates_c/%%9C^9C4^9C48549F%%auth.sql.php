<?php /* Smarty version 2.6.18, created on 2014-11-20 20:52:01
         compiled from /home/funkyjam/public_html/lib0904/util/mobile_premium/docomo/../sql/auth.sql */ ?>
SELECT uid

FROM premium_users

WHERE uid = '<?php echo $this->_tpl_vars['uid']; ?>
'
AND d_stamp IS NULL
;