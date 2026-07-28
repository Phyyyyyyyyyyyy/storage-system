<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$id = $_GET["id"];

$stmt = $pdo->prepare("
DELETE FROM suppliers
WHERE id=?
");

$stmt->execute([$id]);

header("Location: ../pages/suppliers.php");
exit();