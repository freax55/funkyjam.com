SELECT i.*,
to_char(i.p_date,'YYYY') || '-' || to_char(i.p_date,'MM') || '-01' AS date,
p.name AS place_name,
i.name || ' ' || p.name AS name
FROM item AS i
LEFT JOIN place AS p ON i.place_no = p.place_no
WHERE category_code = 'A011'
/*AND i.toursale_id = '{$toursaleId}'
AND current_date <= p_date*/
ORDER BY p_date
;