SELECT i.*, p.name AS place_name
FROM item AS i
LEFT JOIN place AS p ON i.place_no = p.place_no
WHERE category_code = 'A011'
AND current_date <= p_date
AND p_release >= '2010-06-11'
AND p_release <= current_date
ORDER BY p_date
;