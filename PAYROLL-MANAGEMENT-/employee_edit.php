<?php
require "auth.php";
require "db.php";

// If no ID is provided, return to list
if (!isset($_GET['id'])) {
    header("Location: employee_list.php");
    exit();
}

$emp_id = $_GET['id'];

// Fetch employee data
$stmt = $pdo->prepare("SELECT * FROM employees WHERE emp_id = ? AND user_id = ?");
$stmt->execute([$emp_id, $_SESSION["user_id"]]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employee) {
    echo "Employee not found!";
    exit();
}

$message = "";

// Update employee
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $position = $_POST["position"];
    $basic_salary = $_POST["basic_salary"];

    $update = $pdo->prepare("
        UPDATE employees 
        SET name = ?, phone = ?, position = ?, basic_salary = ? 
        WHERE emp_id = ? AND user_id = ?
    ");

    if ($update->execute([$name, $phone, $position, $basic_salary, $emp_id, $_SESSION["user_id"]])) {
        header("Location: employee_list.php?updated=1");
        exit();
    } else {
        $message = "Failed to update employee!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
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

    <h2 style="text-align:center;">Edit Employee</h2>

    <?php if ($message): ?>
        <p style="color:white; background:#e74c3c; padding:10px; border-radius:6px; text-align:center;">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <label style="font-weight:bold;">Name</label>
        <input type="text" name="name" value="<?php echo $employee['name']; ?>" required
               style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

        <label style="font-weight:bold;">Phone</label>
        <input type="text" name="phone" value="<?php echo $employee['phone']; ?>" required
               style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

        <label style="font-weight:bold;">Position</label>
        <input type="text" name="position" value="<?php echo $employee['position']; ?>" required
               style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

        <label style="font-weight:bold;">Basic Salary</label>
        <input type="number" name="basic_salary" value="<?php echo $employee['basic_salary']; ?>" required
               style="width:100%; padding:10px; margin-bottom:20px; border:1px solid #ccc; border-radius:5px;">

        <button type="submit"
                style="width:100%; padding:12px; background:#3498db; color:white; border:none; border-radius:6px; cursor:pointer;">
            Save Changes
        </button>
    </form>

    <a href="employee_list.php" 
       style="display:block; margin-top:15px; text-align:center; color:#3498db; text-decoration:none;">
       ← Back to Employee List
    </a>

</div>

</body>
</html>
