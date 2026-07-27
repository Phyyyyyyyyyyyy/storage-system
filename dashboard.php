<?php

session_start();

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit();

}

require_once "config/database.php";

/*
|--------------------------------------------------------------------------
| Dashboard Statistics
|--------------------------------------------------------------------------
*/

$totalItems = $pdo->query("
    SELECT COUNT(*) FROM items
")->fetchColumn();

$totalCategories = $pdo->query("
    SELECT COUNT(*) FROM categories
")->fetchColumn();

$totalSuppliers = $pdo->query("
    SELECT COUNT(*) FROM suppliers
")->fetchColumn();

$lowStock = $pdo->query("
    SELECT COUNT(*)
    FROM items
    WHERE quantity <= minimum_stock
")->fetchColumn();

/*
|--------------------------------------------------------------------------
| Recent Stock Movements
|--------------------------------------------------------------------------
*/

$recentTransactions = $pdo->query("
    SELECT
        transactions.transaction_date,
        transactions.transaction_type,
        transactions.quantity,
        items.item_name,
        users.username

    FROM transactions

    INNER JOIN items
        ON transactions.item_id = items.id

    INNER JOIN users
        ON transactions.user_id = users.id

    ORDER BY transactions.transaction_date DESC

    LIMIT 5
");

include "includes/header.php";
?>

<div class="container">

    <?php include "includes/sidebar.php"; ?>

    <main class="content">

        <div class="topbar">

            <div>

                <h1>Dashboard</h1>

                <p>
                    Welcome back,
                    <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                </p>

            </div>

        </div>

        <!-- Statistics Cards -->

        <div class="cards">

            <div class="card">

                <h3>Total Items</h3>

                <h2><?php echo $totalItems; ?></h2>

            </div>

            <div class="card">

                <h3>Categories</h3>

                <h2><?php echo $totalCategories; ?></h2>

            </div>

            <div class="card">

                <h3>Suppliers</h3>

                <h2><?php echo $totalSuppliers; ?></h2>

            </div>

            <div class="card">

                <h3>Low Stock</h3>

                <h2><?php echo $lowStock; ?></h2>

            </div>

        </div>

        <!-- Recent Transactions -->

        <div class="table-card">

            <h2>Recent Stock Movements</h2>

            <table>

                <thead>

                    <tr>

                        <th>Item</th>

                        <th>Type</th>

                        <th>Quantity</th>

                        <th>User</th>

                        <th>Date</th>

                    </tr>

                </thead>

                <tbody>

                <?php if ($recentTransactions->rowCount() > 0): ?>

                    <?php while($row = $recentTransactions->fetch(PDO::FETCH_ASSOC)): ?>

                        <tr>

                            <td>
                                <?php echo htmlspecialchars($row['item_name']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['transaction_type']); ?>
                            </td>

                            <td>
                                <?php echo $row['quantity']; ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['username']); ?>
                            </td>

                            <td>
                                <?php echo $row['transaction_date']; ?>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="5" style="text-align:center;">
                            No transactions found.
                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </main>

</div>

<?php include "includes/footer.php"; ?>