<?php

class User
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Stub method untuk mendapatkan data pengguna
    public function getAll(): array
    {
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->query("SELECT * FROM users");
            return $stmt->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function findByEmail(string $email): ?array
    {
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result ? $result->fetch_assoc() : null;
            $stmt->close();
            return $user ?: null;
        }
        return null;
    }

    public function addUser($name, $email, $password)
    {
        $email = trim((string) $email);
        $name = trim((string) $name);
        $password = trim((string) $password);
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->prepare("INSERT INTO users(name, email, password)
            VALUES (?, ?, ?);");
            $stmt->bind_param("sss", $name, $email, $pass);
            $execute = $stmt->execute();
            if ($execute) {
                $insertId = $connection->insert_id;
                $stmt->close();
                return $insertId > 0 ? (int) $insertId : null;
            }
            $stmt->close();
        }
        return null;
    }
    public function addTeams($user_id, $team_name, $members)
    {
        $user_id = trim((string) $user_id);
        $team_name = trim((string) $team_name);
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->prepare("INSERT INTO teams(user_id, team_name, members)
            VALUES (?, ?, ?);");
            $stmt->bind_param("sss", $user_id, $team_name, $members);
            $execute = $stmt->execute();
            if ($execute) {
                $insertId = $connection->insert_id;
                $stmt->close();
                return $insertId > 0 ? (int) $insertId : null;
            }
            $stmt->close();
        }
        return null;
    }
}
