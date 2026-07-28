<?php

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../register.php");
    exit();

}

$full_name = trim($_POST["full_name"]);
$username = trim($_POST["username"]);
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

if (
    empty($full_name) ||
    empty($username) ||
    empty($password) ||
    empty($confirm_password)
) {

    header("Location: ../register.php?error=Please fill in all fields.");
    exit();

}

if ($password !== $confirm_password) {

    header("Location: ../register.php?error=Passwords do not match.");
    exit();

}

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);

if ($stmt->fetch()) {

    header("Location: ../register.php?error=Username already exists.");
    exit();

}

$hash = password_hash($password, PASSWORD_DEFAULT);

$role = "staff";

$stmt = $pdo->prepare("

INSERT INTO users
(
    full_name,
    username,
    password,
    role
)

VALUES
(
    ?,
    ?,
    ?,
    ?
)

");

$stmt->execute([

    $full_name,
    $username,
    $hash,
    $role

]);

header("Location: ../login.php?registered=1");
exit();