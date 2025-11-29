<?php
require "auth.php";
require "db.php";

// Fetch employees owned by logged-in employer
$emp_stmt = $pdo->prepare("SELECT * FROM employees WHERE user_id = ?");
$emp_stmt->execute([$_SESSION["user_id"]]);
$employees = $emp_stmt->fetchAll(PDO::FETCH_ASSOC);

$employee = null;
$deductions_total = 0;
$net_salary = 0;

if (isset($_GET['emp_id'])) {

    $emp_id = $_GET['emp_id'];

    // Fetch selected employee details
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE emp_id = ? AND user_id = ?");
    $stmt->execute([$emp_id, $_SESSION["user_id"]]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($employee) {
        // Fetch all deductions (advances, bills, breakages)
        $d = $pdo->prepare("SELECT SUM(amount) AS total FROM deductions WHERE emp_id = ?");
        $d->execute([$emp_id]);
        $result = $d->fetch(PDO::FETCH_ASSOC);

        $deductions_total = $result["total"] ?? 0;
        $net_salary = $employee["basic_salary"] - $deductions_total;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Process Salary</title>
</head>

<body style="font-family: Arial; background:#f4f4f4; padding:30px;">

<div style="
    width:700px; 
    margin:auto; 
    background:white; 
    padding:25px; 
    border-radius:10px; 
    box-shadow:0 0 10px rgba(0,0,0,0.1);
">

    <h2 style="text-align:center;">Process Salary</h2>

    <form method="GET" style="margin-bottom:20px;">

        <label style="font-weight:bold;">Select Employee:</label>
        <select name="emp_id" required
                style="width:100%; padding:10px; border:1px solid #ccc; border-radius:5px;">
            <option value="">-- Choose Employee --</option>

            <?php foreach ($employees as $emp): ?>
                <option value="<?php echo $emp['emp_id']; ?>"
                    <?php if (isset($_GET['emp_id']) && $_GET['emp_id'] == $emp['emp_id']) echo "selected"; ?>>
                    <?php echo $emp['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit"
                style="margin-top:15px; width:100%; padding:12px; background:#3498db; color:white;
                border:none; border-radius:6px; cursor:pointer;">
            Load Salary Details
        </button>
    </form>

    <?php if ($employee): ?>
    <hr><br>

    <h3>Employee Details</h3>

    <p><strong>Name:</strong> <?php echo $employee["name"]; ?></p>
    <p><strong>Position:</strong> <?php echo $employee["position"]; ?></p>
    <p><strong>Basic Salary:</strong> KES <?php echo number_format($employee["basic_salary"]); ?></p>

    <h3>Deductions</h3>

    <p><strong>Total Deductions:</strong> KES <?php echo number_format($deductions_total); ?></p>

    <h3>Net Salary</h3>

    <p style="font-size:20px; font-weight:bold; color:#27ae60;">
        KES <?php echo number_format($net_salary); ?>
    </p>

    <a href="salary_finalize.php?emp_id=<?php echo $employee['emp_id']; ?>"
       style="display:block; margin-top:20px; padding:12px; text-align:center; background:#2ecc71; 
       color:white; border-radius:6px; text-decoration:none;">
       Proceed to Finalize Salary
    </a>

    <?php endif; ?>

</div>

</body>
</html>
