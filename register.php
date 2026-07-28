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

    <title>Register - Storage Management System</title>

    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

<div class="login-box">

    <div class="img-logo">
        <img src="assets/images/carton-logo.png" alt="Logo">
    </div>

    <h1>Create Account</h1>

    <?php
    if(isset($_GET['error'])){
        echo "<p class='error'>" . htmlspecialchars($_GET['error']) . "</p>";
    }

    if(isset($_GET['success'])){
        echo "<p class='success'>Account created successfully. You may now login.</p>";
    }
    ?>

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

        <!-- Remove this if you don't want users choosing roles -->
        <select name="role">

            <option value="staff">Staff</option>
            <option value="admin">Admin</option>

        </select>

        <button type="submit">
            Register
        </button>

    </form>

    <p style="margin-top:20px;text-align:center;">
        Already have an account?
    </p>

    <a href="login.php" class="register-btn">
        Login
    </a>

</div>

</body>
</html>