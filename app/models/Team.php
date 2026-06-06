<?php

class Team
{
    private Database $db;
    private $conn = null;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Stub method untuk mendapatkan data tim peserta
    public function getAll()
    {
        if ($this->conn) {
            $stmt = $this->conn->query("SELECT * FROM teams");
            return $stmt->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function getAllWithSubmissions()
    {
        if ($this->conn) {
            $query = "SELECT t.*, s.final_score 
                      FROM teams t 
                      INNER JOIN submissions s ON t.id = s.team_id 
                      ORDER BY t.created_at DESC";
            $stmt = $this->conn->query($query);
            return $stmt ? $stmt->fetch_all(MYSQLI_ASSOC) : [];
        }
        return [];
    }

    public function findByUserId(string $userId): ?array
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT * FROM teams WHERE user_id = ? LIMIT 1");
            if ($stmt) {
                $stmt->bind_param("s", $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                $team = $result ? $result->fetch_assoc() : null;
                $stmt->close();
                return $team ?: null;
            }
        }
        return null;
    }

    public function findById(string $id): ?array
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT t.*, u.name AS leader_name, u.email AS leader_email 
                                          FROM teams t
                                          LEFT JOIN users u ON t.user_id = u.id 
                                          WHERE t.id = ? LIMIT 1");
            if ($stmt) {
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $team = $result ? $result->fetch_assoc() : null;
                $stmt->close();
                return $team ?: null;
            }
        }
        return null;
    }
    public function getById(string $id): ?array
    {
        if ($this->conn) {
            $query = "SELECT t.*, s.figma_link, s.docs_link, s.score_ui, s.score_ux, s.score_figma, s.feedback, s.final_score 
                    FROM teams t 
                    LEFT JOIN submissions s ON t.id = s.team_id 
                    WHERE t.id = ? LIMIT 1";
                    
            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("s", $id); // Berubah menjadi "s" karena ID menggunakan UUID (String)
                $stmt->execute();
                $result = $stmt->get_result();
                $team = $result ? $result->fetch_assoc() : null;
                $stmt->close();
                return $team ?: null;
            }
        }
        return null;
    }

    public function updateActiveStatus(string $id, int $isActive): bool
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("UPDATE teams SET is_active = ? WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("is", $isActive, $id);
                $result = $stmt->execute();
                $stmt->close();
                return $result;
            }
        }
        return false;
    }

    public function getTeamsWithFilter($search = '', $statusFilter = '')
    {
        if ($this->conn) {
            $query = "SELECT t.*, u.name AS leader_name, u.email AS leader_email 
                      FROM teams t
                      LEFT JOIN users u ON t.user_id = u.id";
            
            $whereClauses = [];
            $params = [];
            $types = "";
            
            $search = trim((string)$search);
            if ($search !== '') {
                $whereClauses[] = "(t.team_name LIKE ? OR u.name LIKE ? OR u.email LIKE ?)";
                $like = "%" . $search . "%";
                $params[] = $like;
                $params[] = $like;
                $params[] = $like;
                $types .= "sss";
            }
            
            $statusFilter = trim((string)$statusFilter);
            if ($statusFilter === '1' || $statusFilter === 'active') {
                $whereClauses[] = "t.is_active = 1";
            } elseif ($statusFilter === '0' || $statusFilter === 'pending') {
                $whereClauses[] = "t.is_active = 0";
            }
            
            if (!empty($whereClauses)) {
                $query .= " WHERE " . implode(" AND ", $whereClauses);
            }
            
            $query .= " ORDER BY t.created_at DESC";
            
            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                if (!empty($params)) {
                    $stmt->bind_param($types, ...$params);
                }
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
                $stmt->close();
                return $data;
            }
        }
        return [];
    }

    public function getDashboardCounts()
    {
        if ($this->conn) {
            $total = 0;
            $active = 0;
            $pending = 0;
            
            $res = $this->conn->query("SELECT COUNT(*) AS count FROM teams");
            if ($res) {
                $row = $res->fetch_assoc();
                $total = (int)$row['count'];
            }
            $res = $this->conn->query("SELECT COUNT(*) AS count FROM teams WHERE is_active = 1");
            if ($res) {
                $row = $res->fetch_assoc();
                $active = (int)$row['count'];
            }
            $res = $this->conn->query("SELECT COUNT(*) AS count FROM teams WHERE is_active = 0");
            if ($res) {
                $row = $res->fetch_assoc();
                $pending = (int)$row['count'];
            }
            return ['total' => $total, 'active' => $active, 'pending' => $pending];
        }
        return ['total' => 0, 'active' => 0, 'pending' => 0];
    }

    public function getRecentTeams(int $limit = 5)
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT t.*, u.name AS leader_name, u.email AS leader_email 
                                          FROM teams t 
                                          LEFT JOIN users u ON t.user_id = u.id 
                                          ORDER BY t.created_at DESC LIMIT ?");
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
    /**
     * Memperbarui nilai dan ulasan pada tabel submissions berdasarkan team_id
     */
    public function reviewSubmission($id,$uiScore,$uxScore,$figmaScore,$feedback){

        $id = trim((string)$id);
        $uiScore = trim((int)$uiScore);
        $uxScore = trim((int)$uxScore);
        $figmaScore = trim((int)$figmaScore);
        $feedback = trim((string)$feedback);

        if($this->conn){
            $query = $this->conn->prepare("UPDATE submission
            SET score_ui = ?, score_ux= ?, score_figma = ?, feedback = ?
            WHERE id = ? ");

            $query->bind_param("iiiss",$uiScore, $uxScore,$figmaScore,$feedback,$id);
            $execute = $query->execute();

            if($execute){
                $query->close();
                return true;
            }
        }
        return false;
    }
}
