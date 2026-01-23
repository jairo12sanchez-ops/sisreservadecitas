<?php
$host = '127.0.0.1';
$port = '3306';
$user = 'root';
$pass = '';

echo "Connecting to $host:$port...\n";

try {
    $dsn = "mysql:host=$host;port=$port";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $dbname = 'sisreservadecitas';
    $sql = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $pdo->exec($sql);
    
    echo "SUCCESS: Database '$dbname' created successfully.\n";
} catch (\PDOException $e) {
    echo "FAILURE: " . $e->getMessage() . "\n";
}
