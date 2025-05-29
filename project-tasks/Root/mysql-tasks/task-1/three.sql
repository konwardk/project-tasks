
/*
c) Count how many sales happened in the last 7 days
*/

SELECT COUNT(*) AS last_7_day_sales
FROM sales
WHERE sale_date >= CURRENT_DATE - INTERVAL 7 DAY;

