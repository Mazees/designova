<?php

class Assessment
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Stub method untuk mendapatkan data penilaian karya oleh juri
    public function getAll()
    {
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->query("SELECT * FROM assessments");
            return $stmt->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
}
