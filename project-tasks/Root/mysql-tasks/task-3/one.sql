/*
a) Get users who placed more than 5 orders
*/

SELECT u.id, u.name, u.email, COUNT(o.id) AS total_orders
FROM users u
JOIN orders o ON u.id = o.user_id
GROUP BY u.id, u.name, u.email
HAVING COUNT(o.id) > 5;
