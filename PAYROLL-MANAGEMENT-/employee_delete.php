<?php
require "auth.php";
require "db.php";

// Ensure ID exists
if (!isset($_GET['id'])) {
    header("Location: employee_list.php");
    exit();
}

$emp_id = $_GET['id'];

// Delete employee only if they belong to this employer
$stmt = $pdo->prepare("DELETE FROM employees WHERE emp_id = ? AND user_id = ?");
$stmt->execute([$emp_id, $_SESSION["user_id"]]);

header("Location: employee_list.php?deleted=1");
exit();

?>
