<?php

class AdminController extends Controller {
    public function index() {
        $this->protectRoute(['admin']);
        
        $teamModel = new Team();
        $paymentModel = new Payment();
        $submissionModel = new Submissions();
        $settingModel = new Setting();
        
        $teamStats = $teamModel->getDashboardCounts();
        $paymentStats = $paymentModel->getDashboardCounts();
        $submissionStats = $submissionModel->getDashboardCounts();
        $systemSettings = $settingModel->getSystemSettings();
        
        $recentTeams = $teamModel->getRecentTeams(5);
        $recentPayments = $paymentModel->getRecentPayments(5);
        $topTeams = $submissionModel->getTopTeams(3);
        
        // Calculate progress percentages
        $submissionProgress = 0;
        if ($teamStats['active'] > 0) {
            $submissionProgress = round(($submissionStats['total'] / $teamStats['active']) * 100);
        }
        
        $gradingProgress = 0;
        if ($submissionStats['total'] > 0) {
            $gradingProgress = round(($submissionStats['graded'] / $submissionStats['total']) * 100);
        }
        
        $this->view('admin/dashboard', [
            'title' => 'Statistik Global - Admin Designova',
            'metrics' => [
                'total_teams' => $teamStats['total'],
                'active_teams' => $teamStats['active'],
                'pending_teams' => $teamStats['pending'],
                'confirmed_payments' => $paymentStats['confirmed'],
                'pending_payments' => $paymentStats['pending'],
                'total_income' => $paymentStats['income'],
                'total_submissions' => $submissionStats['total'],
                'graded_submissions' => $submissionStats['graded'],
                'submission_progress' => $submissionProgress,
                'grading_progress' => $gradingProgress
            ],
            'recentTeams' => $recentTeams,
            'recentPayments' => $recentPayments,
            'topTeams' => $topTeams,
            'settings' => $systemSettings
        ]);
    }

    public function teams() {
        $this->protectRoute(['admin']);
        
        $search = isset($_GET['search']) ? trim((string)$_GET['search']) : '';
        $status = isset($_GET['status']) ? trim((string)$_GET['status']) : '';
        
        $teamModel = new Team();
        $rawTeams = $teamModel->getTeamsWithFilter($search, $status);
        
        $teams = [];
        foreach ($rawTeams as $t) {
            $date = date('d M Y H:i', strtotime($t['created_at']));
            $isActive = (int)$t['is_active'];
            $statusLabel = $isActive === 1 ? 'Verified & Aktif' : 'Menunggu Verifikasi';
            $statusBadgeClass = $isActive === 1 
                ? 'bg-success/15 border border-success/35 text-success' 
                : 'bg-warning/15 border border-warning/35 text-warning';
            
            $teams[] = [
                'id' => $t['id'],
                'team_name' => $t['team_name'] ?? 'Tidak Diketahui',
                'leader_name' => $t['leader_name'] ?? 'Tidak Diketahui',
                'leader_email' => $t['leader_email'] ?? '-',
                'date_formatted' => $date,
                'is_active' => $isActive === 1,
                'status_label' => $statusLabel,
                'status_badge_class' => $statusBadgeClass,
                'detail_url' => BASE_URL . '/admin/teams/' . $t['id']
            ];
        }

        $this->view('admin/teams', [
            'title' => 'Manajemen Peserta - Admin Designova',
            'teams' => $teams,
            'search' => $search,
            'statusFilter' => $status
        ]);
    }

    public function teamDetail(string $id) {
        $this->protectRoute(['admin']);
        
        $teamModel = new Team();
        
        // Handle POST update status
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isActive = isset($_POST['is_active']) ? (int)$_POST['is_active'] : 0;
            $teamModel->updateActiveStatus($id, $isActive);
            header('Location: ' . BASE_URL . '/admin/teams/' . $id);
            exit;
        }
        
        $team = $teamModel->findById($id);
        if (!$team) {
            header("HTTP/1.0 404 Not Found");
            echo "<h1>404 Not Found</h1>";
            echo "<p>Tim tidak ditemukan.</p>";
            exit;
        }
        
        $members = json_decode($team['members'] ?? '[]', true);
        if (!is_array($members)) {
            $members = [];
        }
        
        $this->view('admin/team_detail', [
            'title' => 'Detail Tim - Admin Designova',
            'team' => [
                'id' => $team['id'],
                'team_name' => $team['team_name'] ?? 'Tidak Diketahui',
                'leader_name' => $team['leader_name'] ?? 'Tidak Diketahui',
                'leader_email' => $team['leader_email'] ?? '-',
                'is_active' => (int)($team['is_active'] ?? 0) === 1
            ],
            'members' => $members
        ]);
    }

    public function leaderboard() {
        $this->protectRoute(['admin', 'juri']);
        $this->view('admin/leaderboard', [
            'title' => 'Papan Peringkat - Admin Designova'
        ]);
    }

    public function settings() {
        $this->protectRoute(['admin']);
        $this->view('admin/settings', [
            'title' => 'Konfigurasi Sistem - Admin Designova'
        ]);
    }

    public function payments() {
        $this->protectRoute(['admin']);
        
        $search = isset($_GET['search']) ? trim((string)$_GET['search']) : '';
        
        $paymentModel = new Payment();
        $rawPayments = $paymentModel->getPaymentsWithTeams($search);
        
        $payments = [];
        foreach ($rawPayments as $p) {
            $formattedAmount = 'Rp ' . number_format((int)$p['amount'], 0, ',', '.');
            $date = date('d M Y H:i', strtotime($p['created_at']));
            
            $status = strtolower($p['status'] ?? 'pending');
            $statusLabel = match ($status) {
                'confirmed' => 'Confirmed',
                'rejected' => 'Rejected',
                default => 'Pending'
            };
            
            $statusBadgeClass = match ($status) {
                'confirmed' => 'bg-success/15 border border-success/35 text-success',
                'rejected' => 'bg-error/15 border border-error/35 text-error',
                default => 'bg-warning/15 border border-warning/35 text-warning'
            };

            $payments[] = [
                'id' => $p['id'],
                'team_name' => $p['team_name'] ?? 'Tidak Diketahui',
                'sender_name' => $p['sender_name'] ?? '-',
                'sender_bank' => $p['sender_bank'] ?? '-',
                'amount_formatted' => $formattedAmount,
                'date_formatted' => $date,
                'status' => $status,
                'is_pending' => $status === 'pending',
                'status_label' => $statusLabel,
                'status_badge_class' => $statusBadgeClass,
                'approve_url' => BASE_URL . '/admin/payments/approve/' . $p['id'],
                'reject_url' => BASE_URL . '/admin/payments/reject/' . $p['id']
            ];
        }

        $this->view('admin/payments', [
            'title' => 'Verifikasi Pembayaran - Admin Designova',
            'payments' => $payments,
            'search' => $search
        ]);
    }
}
