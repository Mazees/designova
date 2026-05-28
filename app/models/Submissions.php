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
            $stmt = $connection->query("SELECT * FROM assessments");
            return $stmt->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
    public function addSumbission($figmaLink,$gdocLink){

        $figmaLink = trim((string)$figmaLink);
        $gdocLink = trim((string)$gdocLink);

        if($this->conn){
            $query = $this->conn->prepare("INSERT INTO submission(figma_link, docs_link)
            VALUES (?,?)");
            $query->bind_param("ss",$figmaLink,$gdocLink);
            $execute = $query->execute();
            if($execute){
                $insertId = $this->conn->insert_id;
                $query->close();
                return $insertId > 0 ? (int) $insertId : null;
            }
            $query->close();
        }
        return null;
    }
    public function updateSubmission($id,$figmaLink,$gdocLink){

        $id = trim((string)$id);
        $figmaLink = trim((string)$figmaLink);
        $gdocLink = trim((string)$gdocLink);

        if($this->conn){
            $query = $this->conn->prepare("UPDATE sumbisssion
            SET figma_link = ?, docs_link = ?
            WHERE id = ? ");

            $query->bind_param("sss",$figmaLink,$gdocLink,$id);
            $execute = $query->execute();

            if($execute){
                $query->close();
                return true;
            }
        }
        return false;
    }
    public function checkSubmission($teamId){
        if($this->conn){
            $query = $this->conn->prepare("SELECT id FROM submissions WHERE team_id = ? LIMIT 1");

            $query->bind_param("s", $teamId);
            $query->execute();

            $hasil = $query->get_result();
            $existing = $hasil ? $hasil->fetch_assoc():null;
            $query->close();
            return $existing;
    }
    return null;
    }
}