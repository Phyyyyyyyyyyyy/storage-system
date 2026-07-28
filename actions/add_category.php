<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$name = trim($_POST["category_name"]);

$stmt = $pdo->prepare("
INSERT INTO categories(category_name)
VALUES(?)
");

$stmt->execute([$name]);

header("Location: ../pages/categories.php");
exit();