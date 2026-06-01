<?php

class Submissions
{
    private Database $db;
    private $conn = null;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Stub method untuk mendapatkan data penilaian karya oleh juri
    public function getAll()
    {
        $connection = $this->db->getConnection();
        if ($this->conn) {
            $stmt = $connection->query("SELECT * FROM submissions");
            return $stmt->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
    public function addSubmission($teamId, $figmaLink, $gdocLink)
    {

        $teamId = trim((string) $teamId);
        $figmaLink = trim((string) $figmaLink);
        $gdocLink = trim((string) $gdocLink);

        if ($this->conn) {
            $this->conn->query("SET @new_id = UUID();");
            $query = $this->conn->prepare("INSERT INTO submissions(id, team_id, figma_link, docs_link)
            VALUES (@new_id,?,?,?)");
            $query->bind_param("sss", $teamId, $figmaLink, $gdocLink);
            $execute = $query->execute();
            if ($execute) {
                $result = $this->conn->query("SELECT * FROM submissions WHERE id = @new_id");
                $row = $result->fetch_assoc();
                $insertId = $row['id'];
                $query->close();
                return (string) $insertId;
            }
            $query->close();
        }
        return null;
    }
    public function updateSubmission($id, $figmaLink, $gdocLink)
    {

        $id = trim((string) $id);
        $figmaLink = trim((string) $figmaLink);
        $gdocLink = trim((string) $gdocLink);

        if ($this->conn) {
            $query = $this->conn->prepare("UPDATE submissions
            SET figma_link = ?, docs_link = ?
            WHERE id = ? ");

            $query->bind_param("sss", $figmaLink, $gdocLink, $id);
            $execute = $query->execute();

            if ($execute) {
                $query->close();
                return true;
            }
        }
        return false;
    }
    public function checkSubmission($teamId)
    {
        if ($this->conn) {
            $query = $this->conn->prepare("SELECT id FROM submissions WHERE team_id = ? LIMIT 1");

            $query->bind_param("s", $teamId);
            $query->execute();

            $hasil = $query->get_result();
            $existing = $hasil ? $hasil->fetch_assoc() : null;
            $query->close();
            return $existing;
        }
        return null;
    }

    public function getSubmission($teamId)
    {
        if ($this->conn) {
            $query = $this->conn->prepare("SELECT * FROM submissions WHERE team_id = ? LIMIT 1");
            $query->bind_param("s", $teamId);
            $query->execute();
            $result = $query->get_result();
            $row = $result ? $result->fetch_assoc() : null;
            $query->close();
            return $row;
        }
        return null;
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


    public function getDashboardCounts()
    {
        if ($this->conn) {
            $total = 0;
            $graded = 0;

            $res = $this->conn->query("SELECT COUNT(*) AS count FROM submissions");
            if ($res) {
                $row = $res->fetch_assoc();
                $total = (int) $row['count'];
            }
            $res = $this->conn->query("SELECT COUNT(*) AS count FROM submissions WHERE score_ui > 0 OR score_ux > 0 OR score_figma > 0");
            if ($res) {
                $row = $res->fetch_assoc();
                $graded = (int) $row['count'];
            }
            return ['total' => $total, 'graded' => $graded];
        }
        return ['total' => 0, 'graded' => 0];
    }

    public function getTopTeams(int $limit = 3)
    {
        if ($this->conn) {
            $stmt = $this->conn->prepare("SELECT t.team_name, s.final_score 
                                          FROM submissions s 
                                          JOIN teams t ON s.team_id = t.id 
                                          ORDER BY s.final_score DESC LIMIT ?");
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

    public function getLeaderboard()
    {
        if ($this->conn) {
            $sql = "SELECT t.team_name, s.score_ui, s.score_ux, s.score_figma, s.final_score 
                    FROM submissions s 
                    JOIN teams t ON s.team_id = t.id 
                    ORDER BY s.final_score DESC";
            $result = $this->conn->query($sql);
            return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
        }
        return [];
    }
}