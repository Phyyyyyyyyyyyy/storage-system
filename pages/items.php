<?php

require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/header.php";
require_once "../includes/sidebar.php";

$sql = "
SELECT
    items.*,
    categories.category_name,
    suppliers.supplier_name
FROM items
LEFT JOIN categories
    ON items.category_id = categories.id
LEFT JOIN suppliers
    ON items.supplier_id = suppliers.id
ORDER BY items.id DESC
";

$stmt = $pdo->query($sql);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="main-content">

    <div class="topbar">

        <h1>Items</h1>

        <a href="add_item.php" class="btn">
            + Add Item
        </a>

    </div>

    <table class="table">

        <thead>

            <tr>

                <th>ID</th>
                <th>Item</th>
                <th>SKU</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

        <?php foreach($items as $item): ?>

            <tr>

                <td><?= $item["id"] ?></td>

                <td><?= htmlspecialchars($item["item_name"]) ?></td>

                <td><?= htmlspecialchars($item["sku"]) ?></td>

                <td><?= htmlspecialchars($item["category_name"] ?? "-") ?></td>

                <td><?= htmlspecialchars($item["supplier_name"] ?? "-") ?></td>

                <td><?= $item["quantity"] ?></td>

                <td>$<?= number_format($item["unit_price"],2) ?></td>

                <td>

                    <a href="edit_item.php?id=<?= $item["id"] ?>">Edit</a>

                    |

                    <a
                    href="../actions/delete_item.php?id=<?= $item["id"] ?>"
                    onclick="return confirm('Delete this item?');">

                    Delete

                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php require_once "../includes/footer.php"; ?>