<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$categories = $pdo->query("
SELECT *
FROM categories
ORDER BY id DESC
");

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Categories</title>

<link rel="stylesheet" href="../assets/css/dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<script src="../assets/js/theme.js"></script>

</head>

<body>

<?php require "../includes/sidebar.php"; ?>

<div class="main-content">

<div class="topbar">

<h1>Categories</h1>

<a href="add_category.php" class="btn">
<i class="fas fa-plus"></i>
Add Category
</a>

</div>

<table class="table">

<tr>

<th>ID</th>
<th>Category</th>
<th>Created</th>
<th>Actions</th>

</tr>

<?php while($row = $categories->fetch(PDO::FETCH_ASSOC)): ?>

<tr>

<td><?= $row["id"] ?></td>

<td><?= htmlspecialchars($row["category_name"]) ?></td>

<td><?= $row["created_at"] ?></td>

<td>

<a href="edit_category.php?id=<?= $row["id"] ?>">
Edit
</a>

|

<a href="../actions/delete_category.php?id=<?= $row["id"] ?>"
onclick="return confirm('Delete this category?')">

Delete

</a>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</body>

</html>