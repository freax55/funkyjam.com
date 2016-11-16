UPDATE mori_user

SET
pass = '{$password}'

WHERE account_no = '{$id}'
and delete_flg = '0';