<?php
$host = '127.0.0.1';
$port = '3306';
$db   = 'sisreservadecitas';
$user = 'root';
$pass = '';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO configuraciones (nombre, direccion, telefono, correo, created_at, updated_at) VALUES (:nombre, :direccion, :telefono, :correo, NOW(), NOW())";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        ':nombre' => 'Sistema de Reservas',
        ':direccion' => 'Calle Principal 123',
        ':telefono' => '555-0000',
        ':correo' => 'contacto@clinica.com'
    ]);
    
    echo "SUCCESS: Default configuration inserted.\n";
} catch (\PDOException $e) {
    echo "FAILURE: " . $e->getMessage() . "\n";
}
