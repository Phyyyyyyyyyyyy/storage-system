<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

if (!isset($_GET["id"])) {
    header("Location: ../pages/categories.php");
    exit();
}

$id = (int) $_GET["id"];

$stmt = $pdo->prepare("
DELETE FROM categories
WHERE id = ?
");

$stmt->execute([$id]);

header("Location: ../pages/categories.php");
exit();