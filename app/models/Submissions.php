<?php

class Submissions
{
    private Database $db;
    private ?mysqli $conn = null;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // Stub method untuk mendapatkan data penilaian karya oleh juri
    public function getAll(): array
    {
        if ($this->conn) {
            $stmt = $this->conn->query("SELECT * FROM assessments");
            return $stmt ? $stmt->fetch_all(MYSQLI_ASSOC) : [];
        }
        return [];
    }

    public function addSubmission(string $teamId, string $figmaLink, string $gdocLink): ?string
    {
        $teamId = trim($teamId);
        $figmaLink = trim($figmaLink);
        $gdocLink = trim($gdocLink);

        if ($this->conn) {
            $this->conn->query("SET @new_id = UUID();");
            $query = $this->conn->prepare("INSERT INTO submissions(id, team_id, figma_link, docs_link)
            VALUES (@new_id, ?, ?, ?)");
            if ($query) {
                $query->bind_param("sss", $teamId, $figmaLink, $gdocLink);
                $execute = $query->execute();
                if ($execute) {
                    $result = $this->conn->query("SELECT * FROM submissions WHERE id = @new_id");
                    $row = $result ? $result->fetch_assoc() : null;
                    $insertId = $row ? $row['id'] : null;
                    $query->close();
                    return $insertId ? (string) $insertId : null;
                }
                $query->close();
            }
        }
        return null;
    }

    public function updateSubmission(string $id, string $figmaLink, string $gdocLink): bool
    {
        $id = trim($id);
        $figmaLink = trim($figmaLink);
        $gdocLink = trim($gdocLink);

        if ($this->conn) {
            $query = $this->conn->prepare("UPDATE submissions
            SET figma_link = ?, docs_link = ?
            WHERE id = ? ");

            if ($query) {
                $query->bind_param("sss", $figmaLink, $gdocLink, $id);
                $execute = $query->execute();
                if ($execute) {
                    $query->close();
                    return true;
                }
                $query->close();
            }
        }
        return false;
    }

    public function getSubmission(string $teamId): ?array
    {
        if ($this->conn) {
            $query = $this->conn->prepare("SELECT id FROM submissions WHERE team_id = ? LIMIT 1");
            if ($query) {
                $query->bind_param("s", $teamId);
                $query->execute();
                $hasil = $query->get_result();
                $existing = $hasil ? $hasil->fetch_assoc() : null;
                $query->close();
                return $existing;
            }
        }
        return null;
    }
}