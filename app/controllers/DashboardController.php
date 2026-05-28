<?php

class DashboardController extends Controller
{
    public function index()
    {
        $this->protectRoute(['peserta'], true);

        $team = $_SESSION['team'] ?? null;
        $submission = null;
        if ($team) {
            $db = new Database();
            $conn = $db->getConnection();
            if ($conn) {
                $stmt = $conn->prepare("SELECT * FROM submissions WHERE team_id = ? LIMIT 1");
                $stmt->bind_param("i", $team['id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $submission = $result ? $result->fetch_assoc() : null;
                $stmt->close();
            }
        }
        $user = $_SESSION['user'] ?? null;
        $teamName = $team['team_name'] ?? 'Tim Anda';
        $members = json_decode($team['members'] ?? '[]', true);
        $isActive = (isset($team['is_active']) && $team['is_active'] == 1);
        $hasSubmitted = !empty($submission);

        $this->view('participant/dashboard', [
            'title' => 'Overview Tim - Designova',
            'user' => $user,
            'hasSubmitted' => $hasSubmitted,
            'members' => $members,
            'teamName' => $teamName,
            'team' => $teamName 
        ]);
    }

    public function submission()
    {
        $this->protectRoute(['peserta'], true);

        $team = $_SESSION['team'] ?? null;
        $db = new Database();
        $conn = $db->getConnection();
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $team) {
            $figma_link = $_POST['figma_link'] ?? '';
            $docs_link = $_POST['docs_link'] ?? '';

            if (empty($figma_link) || empty($docs_link)) {
                $error = 'Semua field wajib diisi!';
            } else {
                if ($conn) {
                    // Cek apakah sudah ada submisi
                    $stmt = $conn->prepare("SELECT id FROM submissions WHERE team_id = ? LIMIT 1");
                    $stmt->bind_param("i", $team['id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $existing = $result ? $result->fetch_assoc() : null;
                    $stmt->close();

                    if ($existing) {
                        // Update
                        $stmt = $conn->prepare("UPDATE submissions SET figma_link = ?, docs_link = ? WHERE team_id = ?");
                        $stmt->bind_param("ssi", $figma_link, $docs_link, $team['id']);
                        if ($stmt->execute()) {
                            $success = 'Karya Anda berhasil diperbarui!';
                        } else {
                            $error = 'Gagal menyimpan karya. Silakan coba lagi.';
                        }
                        $stmt->close();
                    } else {
                        // Insert
                        $stmt = $conn->prepare("INSERT INTO submissions (team_id, figma_link, docs_link) VALUES (?, ?, ?)");
                        $stmt->bind_param("iss", $team['id'], $figma_link, $docs_link);
                        if ($stmt->execute()) {
                            $success = 'Karya Anda berhasil dikirim!';
                        } else {
                            $error = 'Gagal mengirim karya. Silakan coba lagi.';
                        }
                        $stmt->close();
                    }
                }
            }
        }

        $submission = null;
        if ($team && $conn) {
            $stmt = $conn->prepare("SELECT * FROM submissions WHERE team_id = ? LIMIT 1");
            $stmt->bind_param("i", $team['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $submission = $result ? $result->fetch_assoc() : null;
            $stmt->close();
        }
            // Ambil deadline dari database settings
    $settingModel = new Setting();
    $deadline = $settingModel->getSubmissionDeadline();
    

        // Hitung sisa waktu dinamis
    $deadlineTime = strtotime($deadline);
    $now = time();
    $diff = $deadlineTime - $now;
    if ($diff > 0) {
        $daysRemaining = ceil($diff / (60 * 60 * 24));
        $remainingText = $daysRemaining . " Hari Tersisa";
        $remainingClass = "text-amber-500 bg-amber-500/10 border-amber-500/20";
        if ($daysRemaining <= 2) {
            $remainingClass = "text-error bg-error/10 border-error/20 animate-pulse";
        }
    } else {
        $remainingText = "Tenggat Waktu Habis";
        $remainingClass = "text-error bg-error/10 border-error/20 font-black";
    }
    $formattedDeadline = date('d M Y - H:i', $deadlineTime) . ' WIB';


        $this->view('participant/submission', [
            'title' => 'Pengumpulan Karya - Designova',
            'submission' => $submission,
            'error' => $error,
            'success' => $success,
            'formattedDeadline' => $formattedDeadline,
            'remainingText' => $remainingText,
            'remainingClass' => $remainingClass, 
        ]);
    }
}

