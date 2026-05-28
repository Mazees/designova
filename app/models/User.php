<?php

class User
{
    private Database $db;
    private $conn = null;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Stub method untuk mendapatkan data pengguna
    public function getAll(): array
    {
        if ($this->conn) {
            $stmt = $this->conn->query("SELECT * FROM users");
            return $stmt->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function findByEmail(string $email): ?array
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result ? $result->fetch_assoc() : null;
                $stmt->close();
                return $user ?: null;
            }
        }
        return null;
    }
    public function findById(string $id): ?array
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
            if ($stmt) {
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result ? $result->fetch_assoc() : null;
                $stmt->close();
                return $user ?: null;
            }
        }
        return null;
    }

    public function addUser($name, $email, $password)
    {
        $email = trim((string) $email);
        $name = trim((string) $name);
        $password = trim((string) $password);
        $pass = password_hash($password, PASSWORD_DEFAULT);
        if ($this->conn) {
            $stmt = $this->conn->prepare("INSERT INTO users(name, email, password)
            VALUES (?, ?, ?);");
            if ($stmt) {
                $stmt->bind_param("sss", $name, $email, $pass);
                $execute = $stmt->execute();
                if ($execute) {
                    $lookup = $this->conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
                    if ($lookup) {
                        $lookup->bind_param("s", $email);
                        $lookup->execute();
                        $result = $lookup->get_result();
                        $row = $result ? $result->fetch_assoc() : null;
                        $lookup->close();
                        $stmt->close();
                        return $row['id'] ?? null;
                    }
                }
                $stmt->close();
            }
        }
        return null;
    }
    public function addTeams($user_id, $team_name, $members)
    {
        $user_id = trim((string) $user_id);
        $team_name = trim((string) $team_name);
        if ($this->conn) {
            $stmt = $this->conn->prepare("INSERT INTO teams(user_id, team_name, members)
            VALUES (?, ?, ?);");
            if ($stmt) {
                $stmt->bind_param("sss", $user_id, $team_name, $members);
                $execute = $stmt->execute();
                if ($execute) {
                    $lookup = $this->conn->prepare("SELECT id FROM teams WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
                    if ($lookup) {
                        $lookup->bind_param("s", $user_id);
                        $lookup->execute();
                        $result = $lookup->get_result();
                        $row = $result ? $result->fetch_assoc() : null;
                        $lookup->close();
                        $stmt->close();
                        return $row['id'] ?? null;
                    }
                }
                $stmt->close();
            }
        }
        return null;
    }
}
