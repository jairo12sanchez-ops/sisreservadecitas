<?php
$host = '127.0.0.1';
$port = '3306';
$db   = 'sisreservadecitas';
$user = 'root';
$pass = '';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    
    $stmt = $pdo->query("SELECT id, nombre, logo, created_at, updated_at FROM configuraciones ORDER BY id DESC");
    $configs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Found " . count($configs) . " records:\n";
    foreach ($configs as $c) {
        echo "ID: {$c['id']} | Name: {$c['nombre']} | Logo: {$c['logo']} | Created: {$c['created_at']} | Updated: {$c['updated_at']}\n";
    }
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
