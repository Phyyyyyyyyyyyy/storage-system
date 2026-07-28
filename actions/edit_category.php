<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$id = (int) $_POST["id"];
$name = trim($_POST["category_name"]);

$stmt = $pdo->prepare("
UPDATE categories
SET category_name = ?
WHERE id = ?
");

$stmt->execute([$name, $id]);

header("Location: ../pages/categories.php");
exit();