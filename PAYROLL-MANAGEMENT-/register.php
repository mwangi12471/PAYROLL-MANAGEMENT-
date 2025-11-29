<?php
require "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check existing email
    $check = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $message = "Email already taken!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$fullname, $email, $password])) {
            header("Location: login.php?registered=1");
            exit();
        } else {
            $message = "Registration failed!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Payroll System</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f2f2f2; display:flex; justify-content:center; align-items:center; height:100vh;">

<div style="background:white; padding:30px; width:380px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1);">

    <h2 style="text-align:center; margin-bottom:20px;">Create Account</h2>

    <?php if ($message): ?>
        <p style="color:white; background:#e74c3c; padding:10px; text-align:center; border-radius:6px;">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <label style="font-weight:bold;">Full Name</label>
        <input type="text" name="fullname" required
               style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

        <label style="font-weight:bold;">Email</label>
        <input type="email" name="email" required
               style="width:100%; padding:10px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

        <label style="font-weight:bold;">Password</label>
        <input type="password" name="password" required
               style="width:100%; padding:10px; margin-bottom:20px; border:1px solid #ccc; border-radius:5px;">

        <button type="submit"
                style="width:100%; padding:12px; border:none; background:#2ecc71; color:white; font-size:16px; border-radius:6px; cursor:pointer;">
            Register
        </button>
    </form>

    <a href="login.php" 
       style="display:block; margin-top:15px; text-align:center; color:#3498db; text-decoration:none;">
       Already have an account? Login
    </a>

</div>

</body>
</html>
