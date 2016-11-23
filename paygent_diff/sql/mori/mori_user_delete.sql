UPDATE mori_user

SET
delete_flg = 1,
delete_stamp = current_timestamp,
delete_reason = '{$reason}'
where order_desc_no = {$order_id};