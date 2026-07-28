<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

// Get and sanitize inputs
$id = (int)($_POST['id'] ?? 0);
$item_name = trim($_POST['item_name'] ?? '');
$category_id = (int)($_POST['category_id'] ?? 0);
$supplier_id = (int)($_POST['supplier_id'] ?? 0);
$sku = trim($_POST['sku'] ?? '');
$quantity = (int)($_POST['quantity'] ?? 0);
$minimum_stock = (int)($_POST['minimum_stock'] ?? 0);

// Fix: Send NULL instead of empty string if unit is blank
$unit = !empty(trim($_POST['unit'] ?? '')) ? trim($_POST['unit']) : null;

$unit_price = (float)($_POST['unit_price'] ?? 0);
$description = trim($_POST['description'] ?? '');

// Validate required fields
if ($id <= 0 || empty($item_name) || empty($sku)) {
    header("Location: ../pages/items.php?error=Invalid data.");
    exit();
}

// Check if SKU already exists (excluding this item)
$stmt = $pdo->prepare("SELECT id FROM items WHERE sku = ? AND id != ?");
$stmt->execute([$sku, $id]);
if ($stmt->fetch()) {
    header("Location: ../pages/edit_item.php?id=$id&error=SKU already exists. Please use a different SKU.");
    exit();
}

// Update database
$sql = "
UPDATE items
SET item_name = ?, category_id = ?, supplier_id = ?, sku = ?, 
    quantity = ?, minimum_stock = ?, unit = ?, unit_price = ?, description = ?
WHERE id = ?
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
        $unit, // Will be NULL if empty
        $unit_price,
        $description,
        $id
    ]);
} catch (PDOException $e) {
    // Show exact error if something breaks
    die("Database Error: " . $e->getMessage());
}

header("Location: ../pages/items.php?success=Item updated successfully.");
exit();