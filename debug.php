<?php

require "config/database.php";

$stmt = $pdo->query("SELECT id, username, password FROM users");

echo "<pre>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}