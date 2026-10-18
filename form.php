<?php
include "config.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$emp = ['name' => '', 'email' => '', 'salary' => '', 'dept_id' => '', 'hire_date' => date('Y-m-d')];

// Handle submit (CREATE / UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    $dept_id = (int)$_POST['dept_id'];
    $hire_date = $_POST['hire_date'];

    if ($id > 0) {
        $stmt = $conn->prepare("UPDATE employees SET name=?, email=?, salary=?, dept_id=?, hire_date=? WHERE emp_id=?");
        $stmt->bind_param("ssdisi", $name, $email, $salary, $dept_id, $hire_date, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO employees (name, email, salary, dept_id, hire_date) VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssdis", $name, $email, $salary, $dept_id, $hire_date);
    }
    $stmt->execute();
    header("Location: index.php");
    exit;
}

// Load existing record for editing
if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM employees WHERE emp_id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $found = $stmt->get_result()->fetch_assoc();
    if ($found) $emp = $found;
}

$depts = $conn->query("SELECT * FROM departments");
include "header.php";
?>
<h2><?= $id ? 'Edit' : 'Add' ?> Employee</h2>
<form method="post">
    <label>Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($emp['name']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($emp['email']) ?>">

    <label>Salary</label>
    <input type="number" step="0.01" name="salary" value="<?= $emp['salary'] ?>" required>

    <label>Department</label>
    <select name="dept_id" required>
        <?php while ($d = $depts->fetch_assoc()): ?>
        <option value="<?= $d['dept_id'] ?>" <?= $d['dept_id'] == $emp['dept_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($d['dept_name']) ?>
        </option>
        <?php endwhile; ?>
    </select>

    <label>Hire Date</label>
    <input type="date" name="hire_date" value="<?= $emp['hire_date'] ?>">

    <button type="submit">Save</button>
</form>
<?php include "footer.php"; ?>
