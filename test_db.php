<?php

require "config/database.php";

echo "<h2>Database Connected</h2>";

$stmt = $pdo->query("SELECT * FROM users");

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    echo "<pre>";
    print_r($row);
}