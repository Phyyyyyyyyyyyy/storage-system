<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

if (!isset($_GET["id"])) {
    header("Location: categories.php");
    exit();
}

$id = (int) $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$id]);

$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    header("Location: categories.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Category</title>

<link rel="stylesheet" href="../assets/css/dashboard.css">

</head>

<body>

<?php require_once "../includes/sidebar.php"; ?>

<div class="main-content">

    <h1>Edit Category</h1>

    <form action="../actions/edit_category.php" method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= $category['id']; ?>">

        <input
            type="text"
            name="category_name"
            value="<?= htmlspecialchars($category['category_name']); ?>"
            required>

        <br><br>

        <button type="submit" class="btn">
            Update Category
        </button>

        <a href="categories.php" class="btn">
            Cancel
        </a>

    </form>

</div>

</body>

</html>