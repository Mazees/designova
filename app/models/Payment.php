<?php

class Payment
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Stub method untuk mendapatkan data konfigurasi sistem global
    public function getPaymentData()
    {
        $connection = $this->db->getConnection();
        if ($connection) {
            $result = $connection->query("SELECT * FROM payments");
            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        }
        return [];
    }
    public function addPaymentData($team_id, $amount)
    {
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->prepare("INSERT INTO payments(team_id, amount)
            VALUES (?, ?);");
            $stmt->bind_param("si", $team_id, $amount);
            $execute = $stmt->execute();
            if ($execute) {
                $insertId = $connection->insert_id;
                $stmt->close();
                return $insertId > 0 ? (int) $insertId : null;
            }
            $stmt->close();
        }
        return [];
    }
}
