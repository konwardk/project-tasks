


/* c) List users who placed their first order in the last 30 days*/

SELECT u.id, u.name, u.email
FROM users u
JOIN (
    SELECT user_id, MIN(order_date) AS first_order_date
    FROM orders
    GROUP BY user_id) o ON u.id = o.user_id
WHERE o.first_order_date >= CURRENT_DATE - INTERVAL 30 DAY;
