<?php
// ============================================================
// Database Configuration — backend-php/config/db.php
// Reads credentials from environment variables.
// Set these in your web server config or a .env loader.
// ============================================================

$host     = getenv('DB_HOST')     ?: 'localhost';
$user     = getenv('DB_USER')     ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$database = getenv('DB_NAME')     ?: 'edoc_platform';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Database connection failed']));
}

$conn->set_charset('utf8mb4');
