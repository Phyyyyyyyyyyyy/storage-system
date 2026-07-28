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

    <title>Storage Management System</title>

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

    <h1>Storage Management</h1>

    <?php
    if(isset($_GET['error'])){
        echo "<p class='error'>Invalid username or password.</p>";
    }

    if(isset($_GET['registered'])){
        echo "<p class='success'>Registration successful! You may now log in.</p>";
    }
    ?>

    <form action="actions/login.php" method="POST">

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

        <button type="submit">
            Login
        </button>

    </form>

    <div class="login-link">

        Don't have an account?

        <a href="register.php">
            Register
        </a>

    </div>

</div>

</body>

</html>