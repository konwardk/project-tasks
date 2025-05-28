/* Task-5: */

CREATE TRIGGER after_employee_delete
AFTER DELETE ON employees
FOR EACH ROW
BEGIN
    INSERT INTO deleted_employees (id, emp_name, deleted_at)
    VALUES (OLD.id, OLD.emp_name, NOW());
END;
