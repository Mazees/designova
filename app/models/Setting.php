<?php

class Setting
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Stub method untuk mendapatkan data konfigurasi sistem global
    public function getSystemSettings()
    {
        $connection = $this->db->getConnection();
        if ($connection) {
            $result = $connection->query("SELECT * FROM settings WHERE id = 1 LIMIT 1");
            if ($result) {
                return $result->fetch_assoc();
            }
        }
        return [];
    }
    public function getBasePrice()
    {
        $connection = $this->db->getConnection();
        if ($connection) {
            $result = $connection->query("SELECT base_price FROM settings WHERE id = 1 LIMIT 1");
            if ($result) {
                $result = $result->fetch_assoc();
                return $result['base_price'];
            }
        }
        return [];
    }
    public function getSubmissionDeadline()
    {
        $connection = $this->db->getConnection();
        if ($connection) {
            $result = $connection->query("SELECT submission_deadline FROM settings WHERE id = 1 LIMIT 1");
            if ($result) {
                $result = $result->fetch_assoc();
                return $result['submission_deadline'];
            }
        }
        return [];
    }
}
