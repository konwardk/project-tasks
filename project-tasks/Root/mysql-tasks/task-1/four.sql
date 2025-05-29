
/*
d) List customers who haven’t made any purchase in 2024
*/

SELECT c.id, c.name
FROM customers c
LEFT JOIN sales s ON c.id = s.customer_id 
  AND YEAR(s.sale_date) = 2024
WHERE s.id IS NULL;
