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
