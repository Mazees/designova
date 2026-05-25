<?php

class Team
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Stub method untuk mendapatkan data tim peserta
    public function getAll()
    {
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->query("SELECT * FROM teams");
            return $stmt->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function findByUserId(int $userId): ?array
    {
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->prepare("SELECT * FROM teams WHERE user_id = ? LIMIT 1");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $team = $result ? $result->fetch_assoc() : null;
            $stmt->close();
            return $team ?: null;
        }
        return null;
    }
}
