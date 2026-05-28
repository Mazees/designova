<?php

class Team
{
    private Database $db;
    private $conn = null;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Stub method untuk mendapatkan data tim peserta
    public function getAll()
    {
        if ($this->conn) {
            $stmt = $this->conn->query("SELECT * FROM teams");
            return $stmt->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function findByUserId(string $userId): ?array
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT * FROM teams WHERE user_id = ? LIMIT 1");
            if ($stmt) {
                $stmt->bind_param("s", $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                $team = $result ? $result->fetch_assoc() : null;
                $stmt->close();
                return $team ?: null;
            }
        }
        return null;
    }
}
