<?php

class Setting
{
    private Database $db;
    private $conn = null;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Stub method untuk mendapatkan data konfigurasi sistem global
    public function getSystemSettings()
    {
        if ($this->conn) {
            $result = $this->conn->query("SELECT * FROM settings WHERE id = 1 LIMIT 1");
            if ($result) {
                return $result->fetch_assoc();
            }
        }
        return [];
    }

    public function getBasePrice()
    {
        if ($this->conn) {
            $result = $this->conn->query("SELECT base_price FROM settings WHERE id = 1 LIMIT 1");
            if ($result) {
                $result = $result->fetch_assoc();
                return $result['base_price'];
            }
        }
        return [];
    }

    public function getSubmissionDeadline()
    {
        if ($this->conn) {
            $result = $this->conn->query("SELECT submission_deadline FROM settings WHERE id = 1 LIMIT 1");
            if ($result) {
                $result = $result->fetch_assoc();
                return $result['submission_deadline'];
            }
        }
        return [];
    }
}
