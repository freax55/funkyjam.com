UPDATE mori_user

SET
start_stamp = '{$start_stamp}',
end_stamp = '{$end_stamp}',
mail_stamp1 = '{$mail_stamp1}',
mail_stamp2 = '{$mail_stamp2}',
mail_stamp3 = '{$mail_stamp3}',
order_no = '{$order_no}',
order_desc_no = '{$order_desc_no}',
u_start_stamp = NULL,
u_end_stamp = NULL,
u_mail_stamp1 = NULL,
u_mail_stamp2 = NULL,
u_mail_stamp3 = NULL,
u_order_no = NULL,
u_order_desc_no = NULL,
cnt = cnt+1

WHERE account_no = '{$account_no}'
and delete_flg = 0;