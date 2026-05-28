<?php

class Payment
{
    private Database $db;
    private $conn = null;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Stub method untuk mendapatkan data konfigurasi sistem global
    public function getPaymentData()
    {
        if ($this->conn) {
            $result = $this->conn->query("SELECT * FROM payments");
            if ($result) {
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        }
        return [];
    }
    public function addPaymentData($team_id, $amount)
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("INSERT INTO payments(team_id, amount)
            VALUES (?, ?);");
            if ($stmt) {
                $stmt->bind_param("si", $team_id, $amount);
                $execute = $stmt->execute();
                if ($execute) {
                    $insertId = $this->conn->insert_id;
                    $stmt->close();
                    return $insertId > 0 ? (int) $insertId : null;
                }
                $stmt->close();
            }
        }
        return null;
    }
}
