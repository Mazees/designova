<?php

class Setting {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Stub method untuk mendapatkan data konfigurasi sistem global
    public function getSystemSettings() {
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->query("SELECT * FROM settings WHERE id = 1 LIMIT 1");
            return $stmt->fetch();
        }
        return [];
    }
}
