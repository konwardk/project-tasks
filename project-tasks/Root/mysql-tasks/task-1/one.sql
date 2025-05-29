/* task 1 : 

a) Fetch total sales amount per customer */

SELECT customer_id, SUM(amount) AS total_sales
FROM sales
GROUP BY customer_id;


