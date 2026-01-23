<?php
$host = '127.0.0.1';
$port = '3307';
$user = 'root';
$pass = '';

echo "Conectando a $host:$port...\n";

try {
    $dsn = "mysql:host=$host;port=$port";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $dbname = 'sisreservadecitas';
    $sql = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $pdo->exec($sql);
    
    echo "ÉXITO: Base de datos '$dbname' creada correctamente en el puerto $port.\n";
} catch (\PDOException $e) {
    echo "FALLO: " . $e->getMessage() . "\n";
}
