UPDATE premium_users_pc

SET
renew_stamp = current_timestamp,
start_stamp = '{$start}',
end_stamp = '{$end}',
mail_stamp = '{$start_mail}'

WHERE mail = '{$mail}'
and pass = '{$member_no}'
and delete_flg = 0;