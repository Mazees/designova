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

        $statusEvaluasi = 'Belum Dinilai';
        $classEvaluasi = 'text-info bg-info/10 border-info/20';
        $feedbackText = 'Belum Ada';
        $submissionUpdatedAt = '-';

        $settingModel = new Setting();
        $settings = $settingModel->getSystemSettings();
        $isWinnerPub = (isset($settings['is_winner_published']) && $settings['is_winner_published'] == 1);

        $topTeams = [];
        if ($isWinnerPub) {
            $subModel = new Submissions();
            $topTeams = $subModel->getTopTeams(5);
        }

        if ($submission) {
            $scoreUi  = (float)($submission['score_ui']);
            $scoreUx = (float)($submission['score_ux']);
            $scoreFigma = (float)($submission['score_figma']);

            if($scoreUi > 0 || $scoreUx > 0 || $scoreFigma > 0){
                $statusEvaluasi = 'Sudah Dinilai';
                $classEvaluasi = 'text-success bg-success/10 border-success/20';
            }
            
            if(!empty($submission['feedback'])){
                $feedbackText = $submission['feedback'];
            }
            
            if(!empty($submission['updated_at'])){
                $submissionUpdatedAt = date('d M Y - H:i', strtotime($submission['updated_at'])) . ' WIB';
            }
        }

        $this->view('participant/dashboard', [
            'title' => 'Overview Tim - Designova',
            'user' => $user,
            'hasSubmitted' => $hasSubmitted,
            'members' => $members,
            'teamName' => $teamName,
            'team' => $teamName,
            'statusEvaluasi' => $statusEvaluasi,
            'classEvaluasi' => $classEvaluasi,
            'feedbackText' => $feedbackText,
            'submissionUpdatedAt' => $submissionUpdatedAt,
            'isWinnerPub' => $isWinnerPub,
            'topTeams' => $topTeams
        ]);
    }

    public function submission()
    {
        $this->protectRoute(['peserta'], true);

        $team = $_SESSION['team'] ?? null;
        $sub = new Submissions();
        $error = '';
        $success = '';

        $figmaInvalid = false;
        $docsInvalid = false;

        
        $submission = $team ? $sub->getSubmission($team['id']) : null;

        $statusEvaluasi = 'Belum Dinilai';
        $classEvaluasi = 'text-info bg-info/10 border-info/20';
        $feedbackText = 'Belum Ada';
        $submissionUpdatedAt = '-';

    // Deadline Calculation
    $submissionModel = new Submissions();
    $deadline = $submissionModel->getSubmissionDeadline();
    $isDeadlinePassed = false;
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
                    $isDeadlinePassed = true;
                    $remainingText  = "Tenggat Waktu Habis";
                    $remainingClass = "text-error bg-error/10 border-error/20 font-black";
                }
                $formattedDeadline = date('d M Y - H:i', $deadlineTime) . ' WIB';
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $team) {
            if ($isDeadlinePassed) {
                $error = 'Batas waktu pengumpulan karya telah habis. Anda tidak dapat lagi mengirim atau mengubah karya.';
            } else {
                $figma_link = $_POST['figma_link'] ?? '';
                $docs_link = $_POST['docs_link'] ?? '';

                // Validasi Link figma dan docs
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
        }

        // Submission Status And Feedback
        if($submission){
            $scoreUi  = (float)($submission['score_ui']);
            $scoreUx = (float)($submission['score_ux']);
            $scoreFigma = (float)($submission['score_figma']);

            if($scoreUi > 0 || $scoreUx > 0 || $scoreFigma > 0){
                $statusEvaluasi = 'Sudah Dinilai';
                $classEvaluasi = 'text-success bg-success/10 border-success/20';
            }
            
            if(!empty($submission['feedback'])){
                $feedbackText = $submission['feedback'];
            }
            
            if(!empty($submission['updated_at'])){
                $submissionUpdatedAt = date('d M Y - H:i', strtotime($submission['updated_at'])) . ' WIB';
            }
        }

        $this->view('participant/submission', [
            'title' => 'Pengumpulan Karya - Designova',
            'submission' => $submission,
            'error' => $error,
            'success' => $success,
            'figmaInvalid' => $figmaInvalid,
            'docsInvalid' => $docsInvalid,
            'formattedDeadline' => $formattedDeadline,
            'remainingText' => $remainingText,
            'remainingClass' => $remainingClass,
            'statusEvaluasi' => $statusEvaluasi,
            'classEvaluasi' => $classEvaluasi,
            'feedbackText' => $feedbackText,
            'submissionUpdatedAt' => $submissionUpdatedAt,
            'isDeadlinePassed' => $isDeadlinePassed
        ]);
    }
}
