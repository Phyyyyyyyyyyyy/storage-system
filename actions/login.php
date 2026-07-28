<?php

session_start();

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: ../login.php");
    exit();

}

$username = trim($_POST["username"]);
$password = $_POST["password"];

$stmt = $pdo->prepare("
SELECT *
FROM users
WHERE username = ?
LIMIT 1
");

$stmt->execute([$username]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {

    header("Location: ../login.php?error=1");
    exit();

}

if (!password_verify($password, $user["password"])) {

    header("Location: ../login.php?error=1");
    exit();

}

$_SESSION["user_id"] = $user["id"];
$_SESSION["username"] = $user["username"];
$_SESSION["role"] = $user["role"];

header("Location: ../pages/dashboard.php");
exit();