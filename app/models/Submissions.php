<?php

class Submissions
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Stub method untuk mendapatkan data penilaian karya oleh juri
    public function getAll()
    {
        $connection = $this->db->getConnection();
        if ($connection) {
            $stmt = $connection->query("SELECT * FROM assessments");
            return $stmt->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
    public function addSumbission($figmaLink,$gdocLink){

        $figmaLink = trim((string)$figmaLink);
        $gdocLink = trim((string)$gdocLink);

        $conn = $this->db->getConnection();

        if($conn){
            $query = $conn->prepare("INSERT INTO submission(figma_link, docs_link)
            VALUES (?,?)");
            $query->bind_param("ss",$figmaLink,$gdocLink);
            $execute = $query->execute();
            if($execute){
                $insertId = $conn->insert_id;
                $query->close();
                return $insertId > 0 ? (int) $insertId : null;
            }
            $query->close();
        }
        return null;
    }
    public function updateSubmission($id,$figmaLink,$gdocLink){

        $id = trim((int)$id);
        $figmaLink = trim((string)$figmaLink);
        $gdocLink = trim((string)$gdocLink);

        $conn = $this->db->getConnection();

        if($conn){
            $query = $conn->prepare("UPDATE sumbisssion
            SET figma_link = ?, docs_link = ?
            WHERE id = ? ");
            
            $query->bind_param("ssi",$figmaLink,$gdocLink,$id);
            $execute = $query->execute();

            if($execute){
                $query->close();
                return true;
            }
            else {
                return false;
            }
        }
    }
}
