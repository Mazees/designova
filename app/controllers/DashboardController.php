<?php

class DashboardController extends Controller
{
    public function index()
    {
        $this->protectRoute(['peserta'], true);

        $team = $_SESSION['team'] ?? null;
        $submission = null;
        if ($team) {
            $sub = new Submissions();
            $submission = $sub->getSubmission($team['id']);
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
        $sub = new Submissions();
        $error = '';
        $success = '';
        $submission = $team ? $sub->getSubmission($team['id']) : null;

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $team) {
            $figma_link = $_POST['figma_link'] ?? '';
            $docs_link = $_POST['docs_link'] ?? '';

            if (empty($figma_link) || empty($docs_link)) {
                $error = 'Semua field wajib diisi!';
            } else {
              // Cek apakah sudah ada submisi
                    if ($submission) {
                        // Update
                        $update = $sub->updateSubmission($submission['id'], $figma_link, $docs_link);
                        if ($update) {
                            $success = 'Karya Anda berhasil diperbarui!';
                        } else {
                            $error = 'Gagal menyimpan karya. Silakan coba lagi.';
                        }
                    } else {
                        // Insert
                        $add = $sub->addSubmission($team['id'], $figma_link, $docs_link);
                        if ($add) {
                            $success = 'Karya Anda berhasil dikirim!';
                        } else {
                            $error = 'Gagal mengirim karya. Silakan coba lagi.';
                        }
                    }
            }
        }
           
    // Deadline Calculation
    $settingModel = new Setting();
    $deadline = $settingModel->getSubmissionDeadline();
        if (empty($deadline)) {
            $formattedDeadline = 'Tidak Ada Batas Waktu';
            $remainingText     = 'Tanpa Tenggat Waktu';
            $remainingClass    = 'text-success bg-success/10 border-success/20';
        } else {
            $deadlineTime = strtotime($deadline);
            if ($deadlineTime === false) {
                $formattedDeadline = 'Format Tidak Valid';
                $remainingText     = 'Format Tidak Valid';
                $remainingClass    = 'text-error bg-error/10 border-error/20';
            } else {
                $now  = time();
                $diff = $deadlineTime - $now;
                if ($diff > 0) {
                    $daysRemaining  = ceil($diff / (60 * 60 * 24));
                    $remainingText  = $daysRemaining . " Hari Tersisa";
                    $remainingClass = "text-amber-500 bg-amber-500/10 border-amber-500/20";
                    if ($daysRemaining <= 2) {
                        $remainingClass = "text-error bg-error/10 border-error/20 animate-pulse";
                    }
                } else {
                    $remainingText  = "Tenggat Waktu Habis";
                    $remainingClass = "text-error bg-error/10 border-error/20 font-black";
                }
                $formattedDeadline = date('d M Y - H:i', $deadlineTime) . ' WIB';
            }
        }


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

