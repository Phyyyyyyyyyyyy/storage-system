<?php
require_once "../includes/auth.php";
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Add Category</title>

<link rel="stylesheet" href="../assets/css/dashboard.css">

</head>

<body>

<?php require "../includes/sidebar.php"; ?>

<div class="main-content">

<h1>Add Category</h1>

<form action="../actions/add_category.php" method="POST">

<input
type="text"
name="category_name"
placeholder="Category Name"
required>

<br><br>

<button type="submit">

Save Category

</button>

</form>

</div>

</body>

</html>