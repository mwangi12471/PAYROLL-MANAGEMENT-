<?php
require "auth.php";
require "db.php";

$sql = "SELECT payroll.*, employees.fullname 
        FROM payroll 
        JOIN employees ON payroll.employee_id = employees.id 
        ORDER BY payroll.created_at DESC";

$stmt = $pdo->query($sql);
$records = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payroll Records</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="list-container">

<h2>Payroll Records</h2>

<?php if (isset($_GET["success"])): ?>
    <p class="success">Payroll Generated Successfully!</p>
<?php endif; ?>

<table>
    <tr>
        <th>Employee</th>
        <th>Basic</th>
        <th>Allowance</th>
        <th>Deductions</th>
        <th>Net Pay</th>
        <th>Date</th>
    </tr>

    <?php foreach ($records as $row): ?>
    <tr>
        <td><?= $row['fullname'] ?></td>
        <td><?= $row['basic_salary'] ?></td>
        <td><?= $row['allowance'] ?></td>
        <td><?= $row['deductions'] ?></td>
        <td><b><?= $row['net_pay'] ?></b></td>
        <td><?= $row['created_at'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="dashboard.php">Back</a>
</div>

</body>
</html>
