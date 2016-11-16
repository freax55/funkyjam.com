UPDATE premium_users_pc

SET
renew_stamp = current_timestamp,
u_start_stamp = '{$start}',
u_end_stamp = '{$end}',
u_mail_stamp = '{$start_mail}',
u_order_no = '{$order_no}',
u_order_desc_no = '{$order_desc_no}'

WHERE mail = '{$mail}'
and pass = '{$member_no}'
and delete_flg = 0;