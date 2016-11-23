UPDATE mori_user

SET
start_stamp = '{$start_stamp}',
end_stamp = '{$end_stamp}',
mail_stamp1 = '{$mail_stamp1}',
mail_stamp2 = '{$mail_stamp2}',
mail_stamp3 = '{$mail_stamp3}'
where order_desc_no = {$order_id};