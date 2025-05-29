/* Task-5: Trigger to Track Deleted Records */


/* create table employees */
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emp_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
);



/* create table deleted_employees */
CREATE TABLE deleted_employees (
    id INT,
    emp_name VARCHAR(100),
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id) REFERENCES employees(id)
);


/* Create a trigger that will insert deleted employee records into the deleted_employees table */

CREATE TRIGGER after_employee_delete
AFTER DELETE ON employees
FOR EACH ROW
BEGIN
    INSERT INTO deleted_employees (id, emp_name, deleted_at)
    VALUES (OLD.id, OLD.emp_name, NOW());
END;
