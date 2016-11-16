UPDATE mori_user

SET
zip1 = '{$zip1}',
zip2 = '{$zip2}',
address1 = '{$address1}',
address2 = '{$address2}',
address3 = '{$address3}',
tel = '{$tel}',
mail = '{$mail}',
pass = '{$password}'

WHERE account_no = '{$account_no}'
and delete_flg = 0;