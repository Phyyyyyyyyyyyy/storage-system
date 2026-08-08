<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$suppliers = $pdo->query("
SELECT *
FROM suppliers
ORDER BY id DESC
");

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Suppliers</title>

<link rel="stylesheet" href="../assets/css/dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<script src="../assets/js/theme.js"></script>

</head>

<body>

<?php require_once "../includes/sidebar.php"; ?>

<div class="main-content">

<div class="topbar">

<h1>Suppliers</h1>

<a href="add_supplier.php" class="btn">

<i class="fas fa-plus"></i>

Add Supplier

</a>

</div>

<table class="table">

<tr>

<th>ID</th>
<th>Supplier</th>
<th>Contact Person</th>
<th>Phone</th>
<th>Email</th>
<th>Actions</th>

</tr>

<?php while($row = $suppliers->fetch(PDO::FETCH_ASSOC)): ?>

<tr>

<td><?= $row["id"] ?></td>

<td><?= htmlspecialchars($row["supplier_name"]) ?></td>

<td><?= htmlspecialchars($row["contact_person"]) ?></td>

<td><?= htmlspecialchars($row["phone"]) ?></td>

<td><?= htmlspecialchars($row["email"]) ?></td>

<td>

<a class="btn"
href="edit_supplier.php?id=<?= $row["id"] ?>">

<i class="fas fa-edit"></i>

Edit

</a>

<a class="btn"
href="../actions/delete_supplier.php?id=<?= $row["id"] ?>"
onclick="return confirm('Delete this supplier?');">

<i class="fas fa-trash"></i>

Delete

</a>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</body>

</html>