<?php

class Assessment {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Stub method untuk mendapatkan data penilaian karya oleh juri
    public function getAll() {
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->query("SELECT * FROM assessments");
            return $stmt->fetchAll();
        }
        return [];
    }
}
