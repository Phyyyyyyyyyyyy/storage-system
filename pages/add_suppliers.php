<?php

require_once "../includes/auth.php";

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Add Supplier</title>

<link rel="stylesheet" href="../assets/css/dashboard.css">

</head>

<body>

<?php require_once "../includes/sidebar.php"; ?>

<div class="main-content">

<h1>Add Supplier</h1>

<form action="../actions/add_supplier.php" method="POST">

<p>Supplier Name</p>

<input
type="text"
name="supplier_name"
required>

<p>Contact Person</p>

<input
type="text"
name="contact_person">

<p>Phone</p>

<input
type="text"
name="phone">

<p>Email</p>

<input
type="email"
name="email">

<p>Address</p>

<textarea
name="address"
rows="5">
</textarea>

<br><br>

<button class="btn">

Save Supplier

</button>

</form>

</div>

</body>

</html>