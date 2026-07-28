<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/header.php";
require_once "../includes/sidebar.php";

// Fetch all items with category and supplier names
$sql = "
SELECT
    items.*,
    categories.category_name,
    suppliers.supplier_name
FROM items
LEFT JOIN categories ON items.category_id = categories.id
LEFT JOIN suppliers ON items.supplier_id = suppliers.id
ORDER BY items.id DESC
";

$stmt = $pdo->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="main-content">

    <div class="topbar">
        <h1>Items</h1>
        <a href="add_item.php" class="btn">
            <i class="fas fa-plus"></i> Add Item
        </a>
    </div>

    <?php if(isset($_GET['success'])): ?>
        <p style="color: #16a34a; background: #e6f7e6; padding: 10px; border-radius: 5px;">
            <?= htmlspecialchars($_GET['success']) ?>
        </p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: #dc2626; background: #fde8e8; padding: 10px; border-radius: 5px;">
            <?= htmlspecialchars($_GET['error']) ?>
        </p>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>SKU</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Qty</th>
                <th>Min</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($items) > 0): ?>
            <?php foreach($items as $item): ?>
                <tr style="<?= ($item['quantity'] <= $item['minimum_stock']) ? 'background:#fff3cd;' : '' ?>">
                    <td><?= $item["id"] ?></td>
                    <td><?= htmlspecialchars($item["item_name"]) ?></td>
                    <td><?= htmlspecialchars($item["sku"]) ?></td>
                    <td><?= htmlspecialchars($item["category_name"] ?? "-") ?></td>
                    <td><?= htmlspecialchars($item["supplier_name"] ?? "-") ?></td>
                    <td><strong><?= $item["quantity"] ?></strong></td>
                    <td><?= $item["minimum_stock"] ?></td>
                    <td><?= htmlspecialchars($item["unit"] ?? "-") ?></td>
                    <td>$<?= number_format($item["unit_price"], 2) ?></td>
                    <td>
                        <a href="edit_item.php?id=<?= $item["id"] ?>" class="btn" style="background:#2563eb; padding:4px 10px; font-size:12px;">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="../actions/delete_item.php?id=<?= $item["id"] ?>"
                           onclick="return confirm('Delete this item?');"
                           class="btn" style="background:#dc2626; padding:4px 10px; font-size:12px;">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10" style="text-align:center; padding:30px; color:#666;">
                    No items found. <a href="add_item.php">Add your first item</a>.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

</div>

<?php require_once "../includes/footer.php"; ?>