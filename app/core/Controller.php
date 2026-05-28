<?php

class Controller
{
    /**
     * Render berkas view dengan data opsional
     * @param string $view Path file view relatif terhadap app/views/ (misal: 'home/index')
     * @param array $data Data yang akan diekstrak menjadi variabel di dalam view
     */
    public function view($view, $data = [])
    {
        // Ekstrak data array agar bisa diakses langsung sebagai variabel di view
        extract($data);

        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View file '$viewFile' tidak ditemukan.");
        }
    }

    /**
     * Protect routes based on user role and team active status
     * @param array $allowedRoles Array of allowed roles (e.g. ['admin', 'juri', 'peserta'])
     * @param bool|null $requireActiveTeam For peserta: true requires active team, false requires inactive team
     */
    public function protectRoute(array $allowedRoles, ?bool $requireActiveTeam = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 1. Cek Login
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        // Refresh data user & team dari database
        if (isset($_SESSION['user']['id'])) {
            $userId = $_SESSION['user']['id'];

            $userModel = new User();
            $latestUser = $userModel->findById($userId);
            if ($latestUser) {
                $_SESSION['user'] = $latestUser;
            }

            $teamModel = new Team();
            $latestTeam = $teamModel->findByUserId($userId);
            if ($latestTeam) {
                $_SESSION['team'] = $latestTeam;
            }
        }

        $user = $_SESSION['user'];
        $role = strtolower($user['role'] ?? 'peserta');

        // 2. Cek Otoritas Role
        if (!in_array($role, $allowedRoles)) {
            // Redirect ke halaman yang sesuai dengan role-nya
            if ($role === 'admin') {
                header('Location: ' . BASE_URL . '/admin/dashboard');
            } elseif ($role === 'juri') {
                header('Location: ' . BASE_URL . '/juri/dashboard');
            } else {
                // Peserta
                $isActive = (isset($_SESSION['team']['is_active']) && $_SESSION['team']['is_active'] == 1);
                if ($isActive) {
                    header('Location: ' . BASE_URL . '/dashboard');
                } else {
                    header('Location: ' . BASE_URL . '/payment');
                }
            }
            exit;
        }

        // 3. Cek Status Aktivasi Tim (Khusus Peserta)
        if ($role === 'peserta' && $requireActiveTeam !== null) {
            $isActive = (isset($_SESSION['team']['is_active']) && $_SESSION['team']['is_active'] == 1);

            if ($requireActiveTeam && !$isActive) {
                // Peserta tapi tim tidak aktif -> lempar ke payment
                header('Location: ' . BASE_URL . '/payment');
                exit;
            } elseif (!$requireActiveTeam && $isActive) {
                // Peserta tapi tim sudah aktif -> lempar ke dashboard
                header('Location: ' . BASE_URL . '/dashboard');
                exit;
            }
        }
    }
}
