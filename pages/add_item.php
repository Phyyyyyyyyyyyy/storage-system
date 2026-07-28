<?php

require_once "includes/auth.php";
require_once "config/database.php";

$categories = $pdo->query("SELECT * FROM categories ORDER BY category_name")->fetchAll();

$suppliers = $pdo->query("SELECT * FROM suppliers ORDER BY supplier_name")->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Add Item</title>

<link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<h1>Add Item</h1>

<form action="actions/add_item.php" method="POST">

<p>Item Name</p>
<input type="text" name="item_name" required>

<p>SKU</p>
<input type="text" name="sku">

<p>Category</p>

<select name="category_id">

<?php foreach($categories as $category): ?>

<option value="<?= $category["id"] ?>">

<?= htmlspecialchars($category["category_name"]) ?>

</option>

<?php endforeach; ?>

</select>

<p>Supplier</p>

<select name="supplier_id">

<?php foreach($suppliers as $supplier): ?>

<option value="<?= $supplier["id"] ?>">

<?= htmlspecialchars($supplier["supplier_name"]) ?>

</option>

<?php endforeach; ?>

</select>

<p>Quantity</p>
<input type="number" name="quantity" value="0">

<p>Minimum Stock</p>
<input type="number" name="minimum_stock" value="10">

<p>Unit Price</p>
<input type="number" step="0.01" name="unit_price">

<p>Description</p>

<textarea
name="description"
rows="5"
cols="50">
</textarea>

<br><br>

<button>

Save Item

</button>

</form>

</body>

</html>