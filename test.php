<?php

try {
    $pdo = new PDO(
        "mysql:host=127.0.0.1;port=3307",
        "root",
        ""
    );

    echo "Connected!";
} catch (PDOException $e) {
    die($e->getMessage());
}