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
        $this->conn->query("SET @new_id = UUID();");
        if ($this->conn) {
            $stmt = $this->conn->prepare("INSERT INTO payments(id, team_id, amount)
            VALUES (@new_id, ?, ?);");
            $stmt->bind_param("si", $team_id, $amount);
            $execute = $stmt->execute();
            if ($execute) {
                $result = $this->conn->query("SELECT * FROM payments WHERE id = @new_id");
                $row = $result->fetch_assoc();
                $insertId = $row['id'];
                $stmt->close();
                return (string) $insertId;
            }
            $stmt->close();
        }
        return null;
    }
}
