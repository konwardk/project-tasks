/* task 1 : 

a) Fetch total sales amount per customer */

SELECT customer_id, SUM(amount) AS total_sales
FROM sales
GROUP BY customer_id;


/* 
b) Get top 5 customers by sales
*/

SELECT customer_id, SUM(amount) AS total_sales
FROM sales
GROUP BY customer_id
ORDER BY total_sales DESC
LIMIT 5;


/*
c) Count how many sales happened in the last 7 days
*/

SELECT COUNT(*) AS last_7_day_sales
FROM sales
WHERE sale_date >= CURRENT_DATE - INTERVAL 7 DAY;


/*
d) List customers who haven’t made any purchase in 2024
*/

SELECT c.id, c.name
FROM customers c
LEFT JOIN sales s ON c.id = s.customer_id 
  AND YEAR(s.sale_date) = 2024
WHERE s.id IS NULL;
