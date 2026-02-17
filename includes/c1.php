<?php
$config = require __DIR__ . '/db_config.php';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO(
    "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}",
    $config['user'],
    $config['pass'],
    $options
);
