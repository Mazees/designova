<?php

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Stub method untuk mendapatkan data pengguna
    public function getAll() {
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->query("SELECT * FROM users");
            return $stmt->fetchAll();
        }
        return [];
    }
}
