<?php
$host = '127.0.0.1';
$port = '3306';
$db   = 'sisreservadecitas';
$user = 'root';
$pass = '';

echo "Testing connection to $host:$port...\n";

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass);
    echo "SUCCESS: Connected to database successfully!\n";
} catch (\PDOException $e) {
    echo "FAILURE: " . $e->getMessage() . "\n";
}

echo "\nTesting connection to localhost:3307...\n";
try {
    $port = '3307';
    $dsn = "mysql:host=localhost;port=$port;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass);
    echo "SUCCESS: Connected to database via localhost:3307 successfully!\n";
} catch (\PDOException $e) {
    echo "FAILURE: " . $e->getMessage() . "\n";
}
