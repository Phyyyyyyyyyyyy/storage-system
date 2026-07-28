<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

// Check if ID is passed in the URL
if (!isset($_GET["id"])) {
    header("Location: ../pages/items.php");
    exit();
}

// Cast to integer for security
$id = (int) $_GET["id"];

// Delete the item from the database
$stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
$stmt->execute([$id]);

// Redirect back to items page with success message
header("Location: ../pages/items.php?success=Item deleted successfully.");
exit();