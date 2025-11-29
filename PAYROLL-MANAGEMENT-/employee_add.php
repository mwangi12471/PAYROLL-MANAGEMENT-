<?php
require "auth.php";
require "db.php";

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $position = $_POST["position"];
    $basic_salary = $_POST["basic_salary"];

    $insert = $pdo->prepare("
        INSERT INTO employees (user_id, name, phone, position, basic_salary)
        VALUES (?, ?, ?, ?, ?)
    ");

    if ($insert->execute([$_SESSION["user_id"], $name, $phone, $position, $basic_salary])) {
        header("Location: employee_list.php?added=1");
        exit();
    } else {
        $message = "Failed to add employee!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>

<body style="font-family: Arial; background:#f4f4f4; padding:30px;">

<div style="
    width:450px; 
    margin:auto; 
    background:white; 
    padding:25px; 
    border-radius:10px; 
    box-shadow:0 0 10px rgba(0,0,0,0.1);
">

    <h2 style="text-align:center;">Add New Employee</h2>

    <?php if ($message): ?>
        <p style="color:white; background:#e74c3c; padding:10px; border-radius:6px; text-align:center;">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <label style="font-weight:bold;">Name</label>
        <input type="text" name="name" required
               style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

        <label style="font-weight:bold;">Phone</label>
        <input type="text" name="phone" required
               style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

        <label style="font-weight:bold;">Position</label>
        <input type="text" name="position" required
               style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

        <label style="font-weight:bold;">Basic Salary</label>
        <input type="number" name="basic_salary" required
               style="width:100%; padding:10px; margin-bottom:20px; border:1px solid #ccc; border-radius:5px;">

        <button type="submit"
                style="width:100%; padding:12px; background:#2ecc71; color:white; border:none; border-radius:6px; cursor:pointer;">
            Add Employee
        </button>
    </form>

    <a href="employee_list.php" 
       style="display:block; margin-top:15px; text-align:center; color:#3498db; text-decoration:none;">
       ← Back to Employee List
    </a>

</div>

</body>
</html>
