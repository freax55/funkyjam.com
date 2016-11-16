SELECT count(*) as total FROM item
WHERE d_stamp is null and category_code like 'A0_0'
{if $category_code}
 and category_code = '{$category_code}'
{/if}

;