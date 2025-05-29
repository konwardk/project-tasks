
/* b) Find users whose average order amount is more than $500 */

SELECT u.id, u.name, u.email, AVG(o.amount) AS avg_order_amount
FROM users u
JOIN orders o ON u.id = o.user_id
GROUP BY u.id, u.name, u.email
HAVING AVG(o.amount) > 500;
