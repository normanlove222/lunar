<?php 
// $host = 'lunar-ingress.norman-love.com';
// $db = "lunar";
// $user = 'lunar222';
// $pass = 'Norman144$';
// $charset = 'utf8mb4';

$host = 'localhost';
$db = "lunar";
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);
?>