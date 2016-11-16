UPDATE mori_user

SET
delete_flg = '1',
delete_stamp = current_timestamp,
delete_reason = '{$reason}'

WHERE account_no = '{$id}'
and delete_flg = '0';