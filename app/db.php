<?php

$pdo = new PDO(
    'mysql:host=localhost;dbname=ccdonuts;charset=utf8mb4',
    'ccStaff',
    'ccDonuts',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

?>