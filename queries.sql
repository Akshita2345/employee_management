USE employee_db;

-- CREATE
INSERT INTO employees (name, email, salary, dept_id, hire_date)
VALUES ('New Person', 'new@example.com', 50000, 1, CURDATE());

-- READ
SELECT * FROM employees;

-- READ with JOIN
SELECT e.emp_id, e.name, e.salary, d.dept_name
FROM employees e
JOIN departments d ON e.dept_id = d.dept_id;

-- UPDATE
UPDATE employees SET salary = 60000 WHERE emp_id = 1;

-- DELETE
DELETE FROM employees WHERE emp_id = 7;

-- AGGREGATES
SELECT AVG(salary) AS avg_salary FROM employees;

SELECT d.dept_name,
       COUNT(e.emp_id) AS total_employees,
       AVG(e.salary)   AS avg_salary,
       MAX(e.salary)   AS max_salary,
       MIN(e.salary)   AS min_salary
FROM departments d
LEFT JOIN employees e ON d.dept_id = e.dept_id
GROUP BY d.dept_name;

-- Departments with avg salary above 50000
SELECT d.dept_name, AVG(e.salary) AS avg_salary
FROM employees e
JOIN departments d ON e.dept_id = d.dept_id
GROUP BY d.dept_name
HAVING AVG(e.salary) > 50000;
