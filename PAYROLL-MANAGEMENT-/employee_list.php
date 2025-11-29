<?php
require "auth.php";
require "db.php";

// Fetch employees for the logged-in employer
$stmt = $pdo->prepare("SELECT * FROM employees WHERE user_id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
</head>

<body style="font-family: Arial; background:#f4f4f4; padding:30px;">

<div style="
    width:80%; 
    margin:auto; 
    background:white; 
    padding:25px; 
    border-radius:10px; 
    box-shadow:0 0 10px rgba(0,0,0,0.1);
">

    <h2 style="text-align:center;">Employee Management</h2>

    <a href="employee_add.php" 
       style="display:inline-block; padding:10px 15px; background:#2ecc71; color:white; 
       border-radius:5px; margin-bottom:20px; text-decoration:none;">
       + Add Employee
    </a>

    <table style="width:100%; border-collapse:collapse;">
        <tr style="background:#3498db; color:white;">
            <th style="padding:10px;">Name</th>
            <th>Phone</th>
            <th>Position</th>
            <th>Basic Salary</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($employees as $emp): ?>
        <tr>
            <td style="padding:10px;"><?php echo $emp['name']; ?></td>
            <td><?php echo $emp['phone']; ?></td>
            <td><?php echo $emp['position']; ?></td>
            <td>KES <?php echo number_format($emp['basic_salary']); ?></td>

            <td>
                <a href="employee_edit.php?id=<?php echo $emp['emp_id']; ?>" 
                   style="color:#2980b9; margin-right:10px;">Edit</a>

                <a href="employee_delete.php?id=<?php echo $emp['emp_id']; ?>" 
                   style="color:#e74c3c;" 
                   onclick="return confirm('Delete this employee?');">
                    Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

</div>

</body>
</html>
