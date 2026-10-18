CREATE DATABASE IF NOT EXISTS employee_db;
USE employee_db;

DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS departments;

CREATE TABLE departments (
    dept_id INT AUTO_INCREMENT PRIMARY KEY,
    dept_name VARCHAR(50) NOT NULL
);

CREATE TABLE employees (
    emp_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    salary DECIMAL(10,2) NOT NULL,
    dept_id INT,
    hire_date DATE,
    FOREIGN KEY (dept_id) REFERENCES departments(dept_id)
);

INSERT INTO departments (dept_name) VALUES
('HR'), ('Engineering'), ('Finance'), ('Marketing');

INSERT INTO employees (name, email, salary, dept_id, hire_date) VALUES
('Arun Kumar',  'arun@example.com',  55000, 2, '2022-03-15'),
('Priya Devi',  'priya@example.com', 48000, 1, '2021-07-01'),
('Karthik Raj', 'karthik@example.com', 72000, 2, '2020-01-20'),
('Meena S',     'meena@example.com', 51000, 3, '2023-05-10'),
('Suresh B',    'suresh@example.com', 45000, 4, '2022-11-02'),
('Divya R',     'divya@example.com', 65000, 2, '2019-09-25');
