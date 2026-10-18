HOW TO RUN (XAMPP)
1. Start Apache and MySQL in the XAMPP Control Panel.
2. Copy the folder "employee_system" into C:\xampp\htdocs\
3. Open http://localhost/phpmyadmin -> Import -> choose database.sql -> Go
4. Open http://localhost/employee_system/

Files:
- database.sql : creates database, tables, sample data
- queries.sql  : CRUD, JOIN, and aggregate queries (run in phpMyAdmin SQL tab)
- *.php        : pages that run the SQL queries
- style.css    : styling

If your MySQL root has a password, edit config.php.
