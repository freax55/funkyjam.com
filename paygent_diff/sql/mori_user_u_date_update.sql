UPDATE mori_user

SET
order_no = '{$u_order_no}',
order_desc_no = '{$u_order_desc_no}',
start_stamp = '{$u_start_stamp}',
end_stamp = '{$u_end_stamp}',
mail_stamp1 = '{$u_mail_stamp1}',
mail_stamp2 = '{$u_mail_stamp2}',
mail_stamp3 = '{$u_mail_stamp3}',
u_order_no = NULL,
u_order_desc_no = NULL,
u_start_stamp = NULL,
u_end_stamp = NULL,
u_mail_stamp1 = NULL,
u_mail_stamp2 = NULL,
u_mail_stamp3 = NULL,
cnt = cnt+1
where u_order_desc_no = {$order_id};