/* creating product table */

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2)
);

/* insert query */

INSERT INTO products (name, price) VALUES
('Laptop', 50000.00),
('Smartphone', 18000.00),
('Headphones', 1500.00),
('Monitor', 6000.00),
('Keyboard', 500.00),
('Mouse', 500.00);