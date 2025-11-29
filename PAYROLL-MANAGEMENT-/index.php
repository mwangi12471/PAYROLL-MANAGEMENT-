<?php
require "auth.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>

<body style="font-family:Arial, sans-serif; background:#eef2f3; margin:0; padding:0;">

<div style="
    width:400px;
    margin:80px auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 12px rgba(0,0,0,0.1);
    text-align:center;
">

    <h2 style="margin-bottom:20px; color:#333;">
        Welcome, <?php echo $_SESSION['fullname']; ?>
    </h2>

    <ul style="list-style:none; padding:0; margin-bottom:30px;">

        <li style="margin:8px 0;">
            <a href="employee_list.php" 
               style="
                    display:block;
                    background:#3498db;
                    color:white;
                    padding:12px;
                    border-radius:6px;
                    text-decoration:none;
                    font-weight:bold;
               ">
               Employee Management
            </a>
        </li>

        <li style="margin:8px 0;">
            <a href="process_salary.php" 
               style="
                    display:block;
                    background:#2ecc71;
                    color:white;
                    padding:12px;
                    border-radius:6px;
                    text-decoration:none;
                    font-weight:bold;
               ">
               Process Salaries
            </a>
        </li>

        <li style="margin:8px 0;">
            <a href="view_reports.php" 
               style="
                    display:block;
                    background:#9b59b6;
                    color:white;
                    padding:12px;
                    border-radius:6px;
                    text-decoration:none;
                    font-weight:bold;
               ">
               View Reports
            </a>
        </li>

        <li style="margin:8px 0;">
            <a href="subscription.php" 
               style="
                    display:block;
                    background:#e67e22;
                    color:white;
                    padding:12px;
                    border-radius:6px;
                    text-decoration:none;
                    font-weight:bold;
               ">
               Subscription Management
            </a>
        </li>

    </ul>

    <a href="logout.php" 
       style="
            display:inline-block;
            padding:10px 20px;
            background:#e74c3c;
            color:white;
            text-decoration:none;
            border-radius:6px;
            font-weight:bold;
       ">
       Logout
    </a>

</div>

</body>
</html>
