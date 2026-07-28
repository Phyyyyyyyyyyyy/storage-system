<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$sql = "
INSERT INTO suppliers
(
supplier_name,
contact_person,
phone,
email,
address
)

VALUES

(?,?,?,?,?)
";

$stmt = $pdo->prepare($sql);

$stmt->execute([

$_POST["supplier_name"],
$_POST["contact_person"],
$_POST["phone"],
$_POST["email"],
$_POST["address"]

]);

header("Location: ../pages/suppliers.php");
exit();