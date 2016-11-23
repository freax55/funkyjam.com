SELECT id
FROM paygent_diff
WHERE id > {$last_id}
order by id
;
