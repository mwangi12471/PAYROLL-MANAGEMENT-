<?php
require "db.php";
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["fullname"] = $user["fullname"];
        header("Location: index.php");
        exit();
    } else {
        $message = "Incorrect email or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f2f2f2; display:flex; justify-content:center; align-items:center; height:100vh;">

<div style="background:white; padding:30px; border-radius:8px; width:350px; box-shadow:0 0 10px rgba(0,0,0,0.1);">

    <h2 style="text-align:center; margin-bottom:20px;">Login</h2>

    <?php if ($message): ?>
        <p style="color:white; background:#e74c3c; padding:10px; border-radius:5px; text-align:center;">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <label style="font-weight:bold;">Email</label>
        <input type="email" name="email" required 
               style="width:100%; padding:10px; margin-top:5px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px;">

        <label style="font-weight:bold;">Password</label>
        <input type="password" name="password" required
               style="width:100%; padding:10px; margin-top:5px; margin-bottom:20px; border:1px solid #ccc; border-radius:5px;">

        <button type="submit" 
                style="width:100%; padding:10px; border:none; border-radius:5px; background:#3498db; color:white; font-size:16px; cursor:pointer;">
            Login
        </button>
    </form>

    <a href="register.php" 
       style="display:block; text-align:center; margin-top:15px; color:#3498db; text-decoration:none;">
        Create an account
    </a>
</div>

</body>
</html>
