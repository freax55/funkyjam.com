UPDATE "magazine"
SET
	password = '',
	d_stamp = NULL
WHERE
	account_no = {$account_no}
;
