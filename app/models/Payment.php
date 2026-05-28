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

    public function getPaymentsWithTeams($search = '')
    {
        if ($this->conn) {
            $query = "SELECT payments.*, teams.team_name, payments.created_at AS payment_date 
                      FROM payments
                      JOIN teams ON payments.team_id = teams.id";
            
            $search = trim((string)$search);
            if ($search !== '') {
                $query .= " WHERE teams.team_name LIKE ? 
                             OR payments.sender_name LIKE ? 
                             OR payments.sender_bank LIKE ? 
                             OR payments.id LIKE ? 
                             OR payments.status LIKE ?";
            }
            
            $query .= " ORDER BY payments.created_at DESC";

            if ($search !== '') {
                $stmt = $this->conn->prepare($query);
                $likeSearch = "%" . $search . "%";
                $stmt->bind_param("sssss", $likeSearch, $likeSearch, $likeSearch, $likeSearch, $likeSearch);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
                $stmt->close();
                return $data;
            } else {
                $result = $this->conn->query($query);
                if ($result) {
                    return $result->fetch_all(MYSQLI_ASSOC);
                }
            }
        }
        return [];
    }

    public function approvePayment($paymentId)
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT team_id FROM payments WHERE id = ? LIMIT 1");
            $stmt->bind_param("s", $paymentId);
            $stmt->execute();
            $result = $stmt->get_result();
            $payment = $result ? $result->fetch_assoc() : null;
            $stmt->close();

            if ($payment) {
                $teamId = $payment['team_id'];
                
                $this->conn->begin_transaction();
                try {
                    $stmt1 = $this->conn->prepare("UPDATE payments SET status = 'confirmed' WHERE id = ?");
                    $stmt1->bind_param("s", $paymentId);
                    $stmt1->execute();
                    $stmt1->close();

                    $stmt2 = $this->conn->prepare("UPDATE teams SET is_active = 1 WHERE id = ?");
                    $stmt2->bind_param("s", $teamId);
                    $stmt2->execute();
                    $stmt2->close();

                    $this->conn->commit();
                    return true;
                } catch (\Exception $e) {
                    $this->conn->rollback();
                    return false;
                }
            }
        }
        return false;
    }

    public function rejectPayment($paymentId)
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT team_id FROM payments WHERE id = ? LIMIT 1");
            $stmt->bind_param("s", $paymentId);
            $stmt->execute();
            $result = $stmt->get_result();
            $payment = $result ? $result->fetch_assoc() : null;
            $stmt->close();

            if ($payment) {
                $teamId = $payment['team_id'];
                
                $this->conn->begin_transaction();
                try {
                    $stmt1 = $this->conn->prepare("UPDATE payments SET status = 'rejected' WHERE id = ?");
                    $stmt1->bind_param("s", $paymentId);
                    $stmt1->execute();
                    $stmt1->close();

                    $stmt2 = $this->conn->prepare("UPDATE teams SET is_active = 0 WHERE id = ?");
                    $stmt2->bind_param("s", $teamId);
                    $stmt2->execute();
                    $stmt2->close();

                    $this->conn->commit();
                    return true;
                } catch (\Exception $e) {
                    $this->conn->rollback();
                    return false;
                }
            }
        }
        return false;
    }

    public function getDashboardCounts()
    {
        if ($this->conn) {
            $confirmed = 0;
            $pending = 0;
            $income = 0;
            
            $res = $this->conn->query("SELECT COUNT(*) AS count FROM payments WHERE status = 'confirmed'");
            if ($res) {
                $row = $res->fetch_assoc();
                $confirmed = (int)$row['count'];
            }
            $res = $this->conn->query("SELECT COUNT(*) AS count FROM payments WHERE status = 'pending'");
            if ($res) {
                $row = $res->fetch_assoc();
                $pending = (int)$row['count'];
            }
            $res = $this->conn->query("SELECT SUM(amount) AS total FROM payments WHERE status = 'confirmed'");
            if ($res) {
                $row = $res->fetch_assoc();
                $income = (int)($row['total'] ?? 0);
            }
            return ['confirmed' => $confirmed, 'pending' => $pending, 'income' => $income];
        }
        return ['confirmed' => 0, 'pending' => 0, 'income' => 0];
    }

    public function getRecentPayments(int $limit = 5)
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT p.*, t.team_name 
                                          FROM payments p 
                                          JOIN teams t ON p.team_id = t.id 
                                          ORDER BY p.created_at DESC LIMIT ?");
            if ($stmt) {
                $stmt->bind_param("i", $limit);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
                $stmt->close();
                return $data;
            }
        }
        return [];
    }
}
