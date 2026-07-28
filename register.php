<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | Storage Management System</title>

    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

<div class="login-box">

    <div style="display:flex; justify-content:center; margin-bottom:20px;">
    <img
        src="assets/images/carton-logo.png"
        alt="Storage Logo"
        style="width:180px; height:auto;"
    >
</div>

    <h1>Create Account</h1>

    <?php if(isset($_GET['error'])): ?>

        <p class="error">
            <?= htmlspecialchars($_GET['error']) ?>
        </p>

    <?php endif; ?>

    <form action="actions/register.php" method="POST">

        <input
            type="text"
            name="full_name"
            placeholder="Full Name"
            required
        >

        <input
            type="text"
            name="username"
            placeholder="Username"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
        >

        <input
            type="password"
            name="confirm_password"
            placeholder="Confirm Password"
            required
        >

        <button type="submit">
            Register
        </button>

    </form>

    <div class="login-link">

        Already have an account?

        <a href="login.php">
            Login
        </a>

    </div>

</div>

</body>
</html>