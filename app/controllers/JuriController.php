<?php

class JuriController extends Controller
{
    public function index()
    {
        $this->protectRoute(['juri']);
        
        // Memanggil model dan mengambil data (Gunakan 'new Team()')
        $teamModel = new Team();
        $teams = $teamModel->getAll();
        
        // Memanggil View dan mengirimkan data '$teams' ke tampilan dashboard
        $this->view('juri/dashboard', [
            'title' => 'Daftar Karya - Juri Designova',
            'teams' => $teams
        ]);
    }

    public function review($team_id)
    {
        $this->protectRoute(['juri']);
        
        // 1. Inisialisasi Model yang dibutuhkan
        $teamModel = new Team();
        $userModel = new User();
        // Anda mungkin butuh ReviewModel jika menggunakan class model terpisah untuk penilaian
        // $reviewModel = new Review(); 

        // 2. JIKA ADA KIRIMAN FORM (METHOD POST)
        if (isset($_POST['submit-review'])) {
            // Ambil dan sanitasi data input
            $ui_score    = filter_input(INPUT_POST, 'ui_score', FILTER_VALIDATE_INT);
            $ux_score    = filter_input(INPUT_POST, 'ux_score', FILTER_VALIDATE_INT);
            $figma_score = filter_input(INPUT_POST, 'figma_score', FILTER_VALIDATE_INT);
            $feedback    = filter_input(INPUT_POST, 'feedback', FILTER_SANITIZE_SPECIAL_CHARS);

            // Validasi range nilai 0 - 100
            if ($ui_score === false || $ui_score < 0 || $ui_score > 100 ||
                $ux_score === false || $ux_score < 0 || $ux_score > 100 ||
                $figma_score === false || $figma_score < 0 || $figma_score > 100 || 
                empty($feedback)) {
                    
                $_SESSION['flash'] = 'Semua kolom nilai dan ulasan wajib diisi dengan benar!';
                header('Location: ' . BASE_URL . '/juri/review/' . $team_id);
                exit;
            }

            $submissionModel = new Submissions();
            $saveStatus = $submissionModel->reviewSubmission($team_id, $ui_score, $ux_score, $figma_score, $feedback);

            if ($saveStatus) {
                $_SESSION['flash'] = 'Penilaian berhasil disimpan!';
                header('Location: ' . BASE_URL . '/juri/dashboard');
            } else {
                $_SESSION['flash'] = 'Gagal menyimpan data ke database.';
                header('Location: ' . BASE_URL . '/juri/review/' . $team_id);
            }
            exit;
        }

        // 3. JIKA HANYA MEMBUKA HALAMAN (METHOD GET)
        // Ambil data spesifik tim berdasarkan ID untuk dikirim ke View
        $teamData = $teamModel->getById($team_id); 

        if (!$teamData) {
            // Jika ID tim tidak ditemukan di database, tendang kembali ke dashboard
            header('Location: ' . BASE_URL . '/juri/dashboard');
            exit;
        }
        
        $userData = $userModel->findById($teamData['user_id']);
        $leaderName = $userData['name'];
        // Mengubah string json '["Lola", "Lala"]' dari DB menjadi Array PHP asli

        $this->view('juri/review', [
            'title' => 'Form Penilaian Karya Tim #' . htmlspecialchars($team_id),
            'team'  => $teamData, // Mengirim array/object detail tim ke view
            'leaderName' => $leaderName,
        ]);
    }
}
