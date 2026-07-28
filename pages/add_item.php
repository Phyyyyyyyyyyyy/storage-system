<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$sql = "
INSERT INTO items
(
item_name,
category_id,
supplier_id,
sku,
quantity,
minimum_stock,
unit_price,
description
)

VALUES

(?,?,?,?,?,?,?,?)
";

$stmt = $pdo->prepare($sql);

$stmt->execute([

$_POST["item_name"],
$_POST["category_id"],
$_POST["supplier_id"],
$_POST["sku"],
$_POST["quantity"],
$_POST["minimum_stock"],
$_POST["unit_price"],
$_POST["description"]

]);

header("Location: ../items.php");
exit();