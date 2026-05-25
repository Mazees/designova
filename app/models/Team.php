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
}
