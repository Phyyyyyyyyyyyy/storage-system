<?php
require_once "../includes/auth.php";
require_once "../config/database.php";

// Fetch categories & suppliers for dropdowns
$categories = $pdo->query("SELECT id, category_name FROM categories ORDER BY category_name")->fetchAll();
$suppliers = $pdo->query("SELECT id, supplier_name FROM suppliers ORDER BY supplier_name")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Item</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
<script src="../assets/js/theme.js"></script>

</head>
<body>
<?php require "../includes/sidebar.php"; ?>

<div class="main-content">
    <div class="topbar">
        <h1>Add Item</h1>
        <a href="items.php" class="btn" style="background:#6c757d;">Cancel</a>
    </div>

    <?php if(isset($_GET['error'])): ?>
        <p style="color:#dc2626; background:#fde8e8; padding:10px; border-radius:5px;">
            <?= htmlspecialchars($_GET['error']) ?>
        </p>
    <?php endif; ?>

    <!-- FIXED: Points to ../actions/add_item.php (one folder up, then into actions) -->
    <form action="../actions/add_item.php" method="POST" style="max-width:600px;">

        <p style="margin-top:15px; font-weight:bold;">Item Name *</p>
        <input type="text" name="item_name" required placeholder="e.g. Office Chair" style="width:100%; padding:10px;">

        <p style="margin-top:15px; font-weight:bold;">SKU *</p>
        <input type="text" name="sku" required placeholder="e.g. CH-001" style="width:100%; padding:10px;">

        <p style="margin-top:15px; font-weight:bold;">Category</p>
        <select name="category_id" style="width:100%; padding:10px;">
            <option value="">-- Select Category --</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
            <?php endforeach; ?>
        </select>

        <p style="margin-top:15px; font-weight:bold;">Supplier</p>
        <select name="supplier_id" style="width:100%; padding:10px;">
            <option value="">-- Select Supplier --</option>
            <?php foreach($suppliers as $sup): ?>
                <option value="<?= $sup['id'] ?>"><?= htmlspecialchars($sup['supplier_name']) ?></option>
            <?php endforeach; ?>
        </select>

        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:15px; margin-top:15px;">
            <div>
                <p style="font-weight:bold;">Quantity</p>
                <input type="number" name="quantity" value="0" min="0" style="width:100%; padding:10px;">
            </div>
            <div>
                <p style="font-weight:bold;">Min Stock</p>
                <input type="number" name="minimum_stock" value="0" min="0" style="width:100%; padding:10px;">
            </div>
            <div>
                <p style="font-weight:bold;">Unit</p>
                <input type="text" name="unit" placeholder="e.g. pcs, kg, box" style="width:100%; padding:10px;">
            </div>
        </div>

        <p style="margin-top:15px; font-weight:bold;">Unit Price ($)</p>
        <input type="number" step="0.01" name="unit_price" value="0.00" style="width:100%; padding:10px;">

        <p style="margin-top:15px; font-weight:bold;">Description</p>
        <textarea name="description" rows="4" style="width:100%; padding:10px;"></textarea>

        <br><br>
        <button type="submit" class="btn" style="width:100%; padding:12px; font-size:16px;">
            <i class="fas fa-save"></i> Save Item
        </button>

    </form>
</div>
</body>
</html>