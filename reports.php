<?php
include "config.php";
include "header.php";

$overall = $conn->query("SELECT COUNT(*) AS total, AVG(salary) AS avg_sal, MAX(salary) AS max_sal, MIN(salary) AS min_sal FROM employees")->fetch_assoc();

$dept = $conn->query("SELECT d.dept_name,
                             COUNT(e.emp_id) AS total,
                             AVG(e.salary) AS avg_sal,
                             MAX(e.salary) AS max_sal,
                             MIN(e.salary) AS min_sal
                      FROM departments d
                      LEFT JOIN employees e ON d.dept_id = e.dept_id
                      GROUP BY d.dept_name");
?>
<h2>Overall Summary</h2>
<div class="cards">
    <div class="card"><h3><?= $overall['total'] ?></h3><p>Employees</p></div>
    <div class="card"><h3><?= number_format($overall['avg_sal'], 2) ?></h3><p>Average Salary</p></div>
    <div class="card"><h3><?= number_format($overall['max_sal'], 2) ?></h3><p>Highest Salary</p></div>
    <div class="card"><h3><?= number_format($overall['min_sal'], 2) ?></h3><p>Lowest Salary</p></div>
</div>

<h2>Department-wise Analysis</h2>
<table>
    <tr><th>Department</th><th>Employees</th><th>Avg Salary</th><th>Max Salary</th><th>Min Salary</th></tr>
    <?php while ($r = $dept->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($r['dept_name']) ?></td>
        <td><?= $r['total'] ?></td>
        <td><?= number_format($r['avg_sal'] ?? 0, 2) ?></td>
        <td><?= number_format($r['max_sal'] ?? 0, 2) ?></td>
        <td><?= number_format($r['min_sal'] ?? 0, 2) ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<?php include "footer.php"; ?>
