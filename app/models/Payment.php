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

    public function getPendingPaymentByTeamId($teamId)
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT * FROM payments WHERE team_id = ? AND status = 'pending' ORDER BY created_at DESC LIMIT 1");
            $stmt->bind_param("s", $teamId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result ? $result->fetch_assoc() : null;
            $stmt->close();

            return $row ?: null;
        }

        return null;
    }

    public function getLatestPaymentByTeamId($teamId)
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT * FROM payments WHERE team_id = ? ORDER BY created_at DESC, updated_at DESC LIMIT 1");
            $stmt->bind_param("s", $teamId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result ? $result->fetch_assoc() : null;
            $stmt->close();

            return $row ?: null;
        }

        return null;
    }

    public function addPaymentData($team_id, $amount, $sender_name, $sender_bank)
    {
        $this->conn->query("SET @new_id = UUID();");
        if ($this->conn) {
            $stmt = $this->conn->prepare("INSERT INTO payments(id, team_id, amount, sender_name, sender_bank)
            VALUES (@new_id, ?, ?, ?, ?);");
            $stmt->bind_param("siss", $team_id, $amount, $sender_name, $sender_bank);
            $execute = $stmt->execute();
            if ($execute) {
                $result = $this->conn->query("SELECT * FROM payments WHERE id = @new_id");
                $row = $result->fetch_assoc();
                $stmt->close();
                return (array) $row;
            }
            $stmt->close();
        }
        return null;
    }
}
