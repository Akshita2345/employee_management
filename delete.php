<?php
include "config.php";
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $conn->prepare("DELETE FROM employees WHERE emp_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
header("Location: index.php");
exit;
