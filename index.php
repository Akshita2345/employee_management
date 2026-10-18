<?php
include "config.php";
include "header.php";

$result = $conn->query("SELECT e.emp_id, e.name, e.email, e.salary, e.hire_date, d.dept_name
                        FROM employees e
                        LEFT JOIN departments d ON e.dept_id = d.dept_id
                        ORDER BY e.emp_id");
?>
<h2>All Employees</h2>
<table>
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Department</th><th>Salary</th><th>Hired</th><th>Actions</th></tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['emp_id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['dept_name'] ?? '-') ?></td>
        <td><?= number_format($row['salary'], 2) ?></td>
        <td><?= $row['hire_date'] ?></td>
        <td>
            <a class="btn edit" href="form.php?id=<?= $row['emp_id'] ?>">Edit</a>
            <a class="btn delete" href="delete.php?id=<?= $row['emp_id'] ?>" onclick="return confirm('Delete this employee?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php include "footer.php"; ?>
