<?php
// ============================================================
// Database Configuration
// Reads credentials from environment variables.
// If running without a .env loader, set the variables in your
// web server (Apache/Nginx) or XAMPP's php.ini.
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