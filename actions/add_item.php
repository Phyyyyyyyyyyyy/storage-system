<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

// Get and sanitize inputs
$item_name = trim($_POST['item_name'] ?? '');
$category_id = (int)($_POST['category_id'] ?? 0);
$supplier_id = (int)($_POST['supplier_id'] ?? 0);
$sku = trim($_POST['sku'] ?? '');
$quantity = (int)($_POST['quantity'] ?? 0);
$minimum_stock = (int)($_POST['minimum_stock'] ?? 0);

// FIX: Send NULL instead of empty string if unit is blank
$unit = !empty(trim($_POST['unit'] ?? '')) ? trim($_POST['unit']) : null;

$unit_price = (float)($_POST['unit_price'] ?? 0);
$description = trim($_POST['description'] ?? '');

// Validate required fields
if (empty($item_name) || empty($sku)) {
    header("Location: ../pages/add_item.php?error=Item name and SKU are required.");
    exit();
}

// Check if SKU already exists
$stmt = $pdo->prepare("SELECT id FROM items WHERE sku = ?");
$stmt->execute([$sku]);
if ($stmt->fetch()) {
    header("Location: ../pages/add_item.php?error=SKU already exists. Please use a different SKU.");
    exit();
}

// Insert into database
$sql = "
INSERT INTO items
(item_name, category_id, supplier_id, sku, quantity, minimum_stock, unit, unit_price, description)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $item_name,
        $category_id ?: null,
        $supplier_id ?: null,
        $sku,
        $quantity,
        $minimum_stock,
        $unit, // This will be NULL if empty
        $unit_price,
        $description
    ]);
} catch (PDOException $e) {
    // Show exact error on screen if something breaks
    die("Database Error: " . $e->getMessage());
}

// If successful, redirect back to items page
header("Location: ../pages/items.php?success=Item added successfully.");
exit();