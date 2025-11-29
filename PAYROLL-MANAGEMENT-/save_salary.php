<?php
require "auth.php";
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $employee_id = $_POST["employee_id"];
    $basic = $_POST["basic_salary"];
    $allowance = $_POST["allowance"];
    $deductions = $_POST["deductions"];

    $net = ($basic + $allowance) - $deductions;

    $stmt = $pdo->prepare("INSERT INTO payroll (employee_id, basic_salary, allowance, deductions, net_pay)
                           VALUES (?, ?, ?, ?, ?)");

    if ($stmt->execute([$employee_id, $basic, $allowance, $deductions, $net])) {
        header("Location: view_salary.php?success=1");
        exit();
    } else {
        echo "Error saving payroll!";
    }
}
?>
