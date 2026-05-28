<?php

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    echo "This script can only be run from the command line.\n";
    exit(1);
}

require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

$name = trim($argv[1] ?? 'Administrator');
$email = trim($argv[2] ?? 'admin@designova.local');
$password = trim($argv[3] ?? 'admin123');

if ($name === '') {
    fwrite(STDERR, "Name is required.\n");
    exit(1);
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    fwrite(STDERR, "A valid email is required.\n");
    exit(1);
}

if ($password === '') {
    fwrite(STDERR, "Password is required.\n");
    exit(1);
}

$database = new Database();
$connection = $database->getConnection();

if (!$connection) {
    fwrite(STDERR, "Failed to connect to the database.\n");
    exit(1);
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$statement = $connection->prepare(
    "INSERT INTO users (id, name, email, password, role)
     VALUES (UUID(), ?, ?, ?, 'admin')
     ON DUPLICATE KEY UPDATE
       name = VALUES(name),
       password = VALUES(password),
       role = 'admin'"
);

if (!$statement) {
    fwrite(STDERR, "Failed to prepare SQL statement.\n");
    exit(1);
}

$statement->bind_param('sss', $name, $email, $hashedPassword);
$statement->execute();

$lookup = $connection->prepare("SELECT id, name, email, role FROM users WHERE email = ? LIMIT 1");
if (!$lookup) {
    fwrite(STDERR, "Failed to verify created admin.\n");
    exit(1);
}

$lookup->bind_param('s', $email);
$lookup->execute();
$result = $lookup->get_result();
$admin = $result ? $result->fetch_assoc() : null;

if ($admin) {
    echo "Admin user ready:\n";
    echo "- ID: " . ($admin['id'] ?? '-') . "\n";
    echo "- Name: " . ($admin['name'] ?? '-') . "\n";
    echo "- Email: " . ($admin['email'] ?? '-') . "\n";
    echo "- Role: " . ($admin['role'] ?? '-') . "\n";
    exit(0);
}

fwrite(STDERR, "Admin user could not be verified after insert.\n");
exit(1);