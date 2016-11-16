UPDATE mori_user

SET
update_stamp = current_timestamp,
u_start_stamp = '{$start_stamp}',
u_end_stamp = '{$end_stamp}',
u_mail_stamp1 = '{$mail_stamp1}',
u_mail_stamp2 = '{$mail_stamp2}',
u_mail_stamp3 = '{$mail_stamp3}',
u_order_no = '{$order_no}',
u_order_desc_no = '{$order_desc_no}'

WHERE account_no = '{$account_no}'
and delete_flg = 0;