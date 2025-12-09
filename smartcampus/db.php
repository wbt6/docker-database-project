<?php // db.php
// db.php
// Database connection helper. Edit environment variables or Docker Compose to set these values.

function get_db() {
    static $pdo = null;
    if ($pdo) return $pdo;

    $host = getenv('DB_HOST') ?: 'db';
    $port = getenv('DB_PORT') ?: '5432';
    $db   = getenv('DB_NAME') ?: 'smartcampusdb';
    $user = getenv('DB_USER') ?: 'student';
    $pass = getenv('DB_PASS') ?: 'student123';

    $dsn = "pgsql:host={$host};port={$port};dbname={$db};";
    try {
        $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $pdo;
    } catch (PDOException $e) {
        throw new Exception('DB connection error: ' . $e->getMessage());
    }
}
