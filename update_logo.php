<?php
$host = '127.0.0.1';
$port = '3306';
$db   = 'sisreservadecitas';
$user = 'root';
$pass = '';

$logoPath = 'logos/UP1kriJKCxA4tporzAMt5kjlIX6c5GyMLcW8GsVH.jpg';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE configuraciones SET logo = :logo WHERE logo IS NULL OR logo = ''";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':logo' => $logoPath]);
    
    echo "SUCCESS: Updated logo to '$logoPath'.\n";
} catch (\PDOException $e) {
    echo "FAILURE: " . $e->getMessage() . "\n";
}
