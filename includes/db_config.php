<?php
/**
 * Centralized DB config loader.
 *
 * Priority:
 * 1) Local override file (includes/db.local.php) - NOT committed
 * 2) Environment variables (DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHARSET)
 */

$defaults = [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'db' => getenv('DB_NAME') ?: 'lunar',
    'user' => getenv('DB_USER') ?: 'root',
    'pass' => getenv('DB_PASS') ?: '',
    'charset' => getenv('DB_CHARSET') ?: 'utf8mb4',
];

$localFile = __DIR__ . '/db.local.php';
if (file_exists($localFile)) {
    $local = require $localFile;
    if (is_array($local)) {
        $defaults = array_merge($defaults, $local);
    }
}

return $defaults;
