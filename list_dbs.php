<?php
$host = '127.0.0.1';
$port = '3306';
$user = 'root';
$pass = '';

echo "Listing databases on $host:$port...\n";

try {
    $dsn = "mysql:host=$host;port=$port";
    $pdo = new PDO($dsn, $user, $pass);
    $stmt = $pdo->query("SHOW DATABASES");
    $dbs = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Databases found:\n";
    foreach ($dbs as $db) {
        echo "- $db\n";
    }
} catch (\PDOException $e) {
    echo "FAILURE: " . $e->getMessage() . "\n";
}
