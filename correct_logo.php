<?php
$host = '127.0.0.1';
$port = '3306';
$db   = 'sisreservadecitas';
$user = 'root';
$pass = '';

$logoPath = 'logos/3zx0pnEotacB8Hd54zyOaKj9F5BAYP3nFSXIxnYw.jpg';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE configuraciones SET logo = :logo";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':logo' => $logoPath]);
    
    echo "SUCCESS: Updated logo to '$logoPath'.\n";
} catch (\PDOException $e) {
    echo "FAILURE: " . $e->getMessage() . "\n";
}
