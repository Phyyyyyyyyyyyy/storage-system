<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

// Validate ID
if (!isset($_GET["id"])) {
    header("Location: items.php");
    exit();
}

$id = (int) $_GET["id"];

// Fetch item data
$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    header("Location: items.php");
    exit();
}

// Fetch categories & suppliers for dropdowns
$categories = $pdo->query("SELECT id, category_name FROM categories ORDER BY category_name")->fetchAll();
$suppliers = $pdo->query("SELECT id, supplier_name FROM suppliers ORDER BY supplier_name")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
<script src="../assets/js/theme.js"></script>

</head>
<body>
<?php require "../includes/sidebar.php"; ?>

<div class="main-content">
    <div class="topbar">
        <h1>Edit Item</h1>
        <a href="items.php" class="btn" style="background:#6c757d;">Cancel</a>
    </div>

    <?php if(isset($_GET['error'])): ?>
        <p class="alert alert-error">
            <?= htmlspecialchars($_GET['error']) ?>
        </p>
    <?php endif; ?>

    <!-- Points to the exact same location as add_item -->
    <form action="../actions/edit_item.php" method="POST" style="max-width:600px;">

        <!-- HIDDEN ID FIELD -->
        <input type="hidden" name="id" value="<?= $item['id'] ?>">

        <p style="margin-top:15px; font-weight:bold;">Item Name *</p>
        <input type="text" name="item_name" required value="<?= htmlspecialchars($item['item_name']) ?>" style="width:100%; padding:10px;">

        <p style="margin-top:15px; font-weight:bold;">SKU *</p>
        <input type="text" name="sku" required value="<?= htmlspecialchars($item['sku']) ?>" style="width:100%; padding:10px;">

        <p style="margin-top:15px; font-weight:bold;">Category</p>
        <select name="category_id" style="width:100%; padding:10px;">
            <option value="">-- Select Category --</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $item['category_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['category_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <p style="margin-top:15px; font-weight:bold;">Supplier</p>
        <select name="supplier_id" style="width:100%; padding:10px;">
            <option value="">-- Select Supplier --</option>
            <?php foreach($suppliers as $sup): ?>
                <option value="<?= $sup['id'] ?>" <?= ($sup['id'] == $item['supplier_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($sup['supplier_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:15px; margin-top:15px;">
            <div>
                <p style="font-weight:bold;">Quantity</p>
                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="0" style="width:100%; padding:10px;">
            </div>
            <div>
                <p style="font-weight:bold;">Min Stock</p>
                <input type="number" name="minimum_stock" value="<?= $item['minimum_stock'] ?>" min="0" style="width:100%; padding:10px;">
            </div>
            <div>
                <p style="font-weight:bold;">Unit</p>
                <input type="text" name="unit" value="<?= htmlspecialchars($item['unit'] ?? '') ?>" placeholder="e.g. pcs, kg, box" style="width:100%; padding:10px;">
            </div>
        </div>

        <p style="margin-top:15px; font-weight:bold;">Unit Price ($)</p>
        <input type="number" step="0.01" name="unit_price" value="<?= $item['unit_price'] ?>" style="width:100%; padding:10px;">

        <p style="margin-top:15px; font-weight:bold;">Description</p>
        <textarea name="description" rows="4" style="width:100%; padding:10px;"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>

        <br><br>
        <button type="submit" class="btn" style="width:100%; padding:12px; font-size:16px;">
            <i class="fas fa-save"></i> Update Item
        </button>

    </form>
</div>
</body>
</html>