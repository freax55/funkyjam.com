UPDATE premium_users_pc

SET
start_stamp = '{$u_start_stamp}',
end_stamp = '{$u_end_stamp}',
mail_stamp = '{$u_mail_stamp}',
order_no = '{$u_order_no}',
order_desc_no = '{$u_order_desc_no}',
u_start_stamp = NULL,
u_end_stamp = NULL,
u_mail_stamp = NULL,
u_order_no = NULL,
u_order_desc_no = NULL
where u_order_desc_no = {$order_id};