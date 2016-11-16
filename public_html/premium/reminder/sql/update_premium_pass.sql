UPDATE premium_users_pc

SET
pass = '{$pass}'

WHERE mail = '{$id}'
and delete_flg = '0';