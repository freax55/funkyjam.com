UPDATE premium_users_pc

SET
start_stamp = '{$start}',
end_stamp = '{$end}',
mail_stamp = '{$start_mail}',
order_no = '{$order_no}',
order_desc_no = '{$order_desc_no}',
u_start_stamp = NULL,
u_end_stamp = NULL,
u_mail_stamp = NULL,
u_order_no = NULL,
u_order_desc_no = NULL

WHERE mail = '{$mail}'
and pass = '{$member_no}'
and delete_flg = 0;