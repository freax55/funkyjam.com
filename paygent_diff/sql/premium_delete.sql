UPDATE premium_users_pc

SET
delete_flg = 1
where order_desc_no = {$order_id};