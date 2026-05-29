<?php

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    echo "This script can only be run from the command line.\n";
    exit(1);
}

require_once __DIR__ . '/app/config/config.php';
require_once __DIR__ . '/app/core/Database.php';

$database = new Database();
$connection = $database->getConnection();

if (!$connection) {
    fwrite(STDERR, "Failed to connect to the database.\n");
    exit(1);
}

// Disable foreign key checks to make seeding clean
$connection->query("SET FOREIGN_KEY_CHECKS=0");

$participants = [
    [
        'name' => 'Ahmad Fauzi',
        'email' => 'peserta1@designova.local',
        'team_name' => 'Tim Falcon',
        'members' => json_encode(['Bambang Hermawan', 'Citra Kirana']),
        'is_active' => 1
    ],
    [
        'name' => 'Dewi Lestari',
        'email' => 'peserta2@designova.local',
        'team_name' => 'Tim Aurora',
        'members' => json_encode(['Eko Prasetyo', 'Fitri Handayani']),
        'is_active' => 1
    ],
    [
        'name' => 'Giri Wijaya',
        'email' => 'peserta3@designova.local',
        'team_name' => 'Tim Galaxy',
        'members' => json_encode(['Hendra Gunawan', 'Indah Permata']),
        'is_active' => 1
    ],
    [
        'name' => 'Joko Widodo',
        'email' => 'peserta4@designova.local',
        'team_name' => 'Tim JavaCoder',
        'members' => json_encode(['Kartika Sari', 'Luthfi Hakim']),
        'is_active' => 1
    ],
    [
        'name' => 'Mada Putra',
        'email' => 'peserta5@designova.local',
        'team_name' => 'Tim AeroUX',
        'members' => json_encode(['Novi Natalia', 'Oki Setiawan']),
        'is_active' => 1
    ],
    [
        'name' => 'Putri Ayu',
        'email' => 'peserta6@designova.local',
        'team_name' => 'Tim Phoenix',
        'members' => json_encode(['Qori Anggraini', 'Rian Hidayat']),
        'is_active' => 0
    ],
    [
        'name' => 'Siti Aminah',
        'email' => 'peserta7@designova.local',
        'team_name' => 'Tim Skyline',
        'members' => json_encode(['Taufik Hidayat', 'Umar Bakri']),
        'is_active' => 0
    ],
    [
        'name' => 'Vina Panduwinata',
        'email' => 'peserta8@designova.local',
        'team_name' => 'Tim Zenith',
        'members' => json_encode(['Wahyu Hidayat', 'Yusuf Habibie']),
        'is_active' => 0
    ],
    [
        'name' => 'Zulham Efendi',
        'email' => 'peserta9@designova.local',
        'team_name' => 'Tim Alpha',
        'members' => json_encode(['Aditya Pratama', 'Budi Santoso']),
        'is_active' => 0
    ],
    [
        'name' => 'Chandra Kirana',
        'email' => 'peserta10@designova.local',
        'team_name' => 'Tim Nebula',
        'members' => json_encode(['Dian Sastro', 'Erlangga']),
        'is_active' => 0
    ]
];

$passwordText = 'password123';
$hashedPassword = password_hash($passwordText, PASSWORD_DEFAULT);

echo "Starting bulk insert of 10 participants and teams...\n";

$connection->begin_transaction();

try {
    foreach ($participants as $p) {
        // 1. Insert user
        $userQuery = $connection->prepare("INSERT INTO users (id, name, email, password, role) VALUES (UUID(), ?, ?, ?, 'peserta') ON DUPLICATE KEY UPDATE name=VALUES(name), password=VALUES(password)");
        if (!$userQuery) {
            throw new Exception("Failed to prepare user query for " . $p['email']);
        }
        $userQuery->bind_param("sss", $p['name'], $p['email'], $hashedPassword);
        $userQuery->execute();
        $userQuery->close();
        
        // Get the inserted user's ID
        $getIdQuery = $connection->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
        $getIdQuery->bind_param("s", $p['email']);
        $getIdQuery->execute();
        $res = $getIdQuery->get_result();
        $userData = $res->fetch_assoc();
        $getIdQuery->close();
        
        if (!$userData) {
            throw new Exception("Failed to retrieve user ID for " . $p['email']);
        }
        
        $userId = $userData['id'];
        
        // 2. Insert team
        // Delete team if it exists (duplication safety)
        $delTeamQuery = $connection->prepare("DELETE FROM teams WHERE user_id = ?");
        $delTeamQuery->bind_param("s", $userId);
        $delTeamQuery->execute();
        $delTeamQuery->close();

        $teamQuery = $connection->prepare("INSERT INTO teams (id, user_id, team_name, members, is_active) VALUES (UUID(), ?, ?, ?, ?)");
        if (!$teamQuery) {
            throw new Exception("Failed to prepare team query for " . $p['team_name']);
        }
        $teamQuery->bind_param("sssi", $userId, $p['team_name'], $p['members'], $p['is_active']);
        $teamQuery->execute();
        $teamQuery->close();
        
        echo "Success: Created User '{$p['name']}' ({$p['email']}) -> Team '{$p['team_name']}' (is_active: {$p['is_active']})\n";
    }
    
    $connection->commit();
    echo "\nBulk insert completed successfully!\n";
    echo "All accounts use password: {$passwordText}\n";
    exit(0);
} catch (Exception $e) {
    $connection->rollback();
    fwrite(STDERR, "Transaction rolled back due to error: " . $e->getMessage() . "\n");
    exit(1);
} finally {
    $connection->query("SET FOREIGN_KEY_CHECKS=1");
}
