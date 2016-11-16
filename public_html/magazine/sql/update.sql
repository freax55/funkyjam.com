UPDATE "magazine"
SET
	mail = '{$form.mail}',
	sex = '{$form.sex}',
	birthday = '{$form.birthday}',
	pref = '{$form.pref}',
	password = '',
	fav_kubota = {$form.fav_kubota|default:NULL},
	fav_urashima = {$form.fav_urashima|default:NULL},
	fav_mori = {$form.fav_mori|default:NULL},
	fav_bes = {$form.fav_bes|default:NULL},
	fav_takahashi = {$form.fav_takahashi|default:NULL},
	fav_shigemoto = {$form.fav_shigemoto|default:NULL},
	fav_shima = {$form.fav_shima|default:NULL},
	fav_wataru = {$form.fav_wataru|default:NULL},
	u_stamp = current_timestamp
WHERE
	account_no = {$account_no}
;
