<?php

require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/header.php";

?>

<?php require_once "../includes/sidebar.php"; ?>

<div class="main-content">

    <div class="topbar">

        <h1>Dashboard</h1>

        <div class="user">

            Welcome,
            <strong><?= htmlspecialchars($_SESSION["username"]) ?></strong>

        </div>

    </div>

    <div class="cards">

        <div class="card">

            <h2>Total Items</h2>

            <?php
            $totalItems = $pdo->query("SELECT COUNT(*) FROM items")->fetchColumn();
            ?>

            <p><?= $totalItems ?></p>

        </div>

        <div class="card">

            <h2>Categories</h2>

            <?php
            $totalCategories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
            ?>

            <p><?= $totalCategories ?></p>

        </div>

        <div class="card">

            <h2>Suppliers</h2>

            <?php
            $totalSuppliers = $pdo->query("SELECT COUNT(*) FROM suppliers")->fetchColumn();
            ?>

            <p><?= $totalSuppliers ?></p>

        </div>

        <div class="card">

            <h2>Users</h2>

            <?php
            $totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
            ?>

            <p><?= $totalUsers ?></p>

        </div>

    </div>

</div>

<?php require_once "../includes/footer.php"; ?>