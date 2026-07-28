<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM suppliers WHERE id=?");
$stmt->execute([$id]);

$supplier = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$supplier){

    header("Location: suppliers.php");
    exit();

}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Edit Supplier</title>

<link rel="stylesheet" href="../assets/css/dashboard.css">

</head>

<body>

<?php require_once "../includes/sidebar.php"; ?>

<div class="main-content">

<h1>Edit Supplier</h1>

<form action="../actions/edit_supplier.php" method="POST">

<input
type="hidden"
name="id"
value="<?= $supplier["id"] ?>">

<p>Supplier Name</p>

<input
type="text"
name="supplier_name"
value="<?= htmlspecialchars($supplier["supplier_name"]) ?>"
required>

<p>Contact Person</p>

<input
type="text"
name="contact_person"
value="<?= htmlspecialchars($supplier["contact_person"]) ?>">

<p>Phone</p>

<input
type="text"
name="phone"
value="<?= htmlspecialchars($supplier["phone"]) ?>">

<p>Email</p>

<input
type="email"
name="email"
value="<?= htmlspecialchars($supplier["email"]) ?>">

<p>Address</p>

<textarea
name="address"
rows="5"><?= htmlspecialchars($supplier["address"]) ?></textarea>

<br><br>

<button class="btn">

Update Supplier

</button>

</form>

</div>

</body>

</html>