<?php
require "auth.php";
require "db.php";

// Fetch employees
$stmt = $pdo->query("SELECT * FROM employees ORDER BY fullname ASC");
$employees = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Process Salary</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-container">
    <h2>Process Employee Salary</h2>

    <form action="save_salary.php" method="POST">

        <label>Select Employee</label>
        <select name="employee_id" required>
            <option value="">-- select employee --</option>
            <?php foreach ($employees as $emp): ?>
                <option value="<?= $emp['id'] ?>"><?= $emp['fullname'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Basic Salary</label>
        <input type="number" name="basic_salary" step="0.01" required><br><br>

        <label>Allowances</label>
        <input type="number" name="allowance" step="0.01" value="0"><br><br>

        <label>Deductions</label>
        <input type="number" name="deductions" step="0.01" value="0"><br><br>

        <button type="submit">Generate Payroll</button>
    </form>

    <a href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>
