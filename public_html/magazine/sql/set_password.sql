UPDATE "magazine"
SET
	password = '{$hash}'
WHERE
	account_no = {$account_no}
;
