<?php

class AuthController extends Controller
{
    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['is_logged_in']) && !empty($_SESSION['user'])) {
            $role = strtolower($_SESSION['user']['role'] ?? 'peserta');

            if ($role === 'admin') {
                header('Location: ' . BASE_URL . '/admin/dashboard');
            } elseif ($role === 'juri') {
                header('Location: ' . BASE_URL . '/juri/dashboard');
            } else {
                $team = $_SESSION['team'] ?? null;

                if (!$team) {
                    $teamModel = new Team();
                    $team = $teamModel->findByUserId($_SESSION['user']['id']);
                    $_SESSION['team'] = $team;
                }

                $isActive = (isset($team['is_active']) && $team['is_active'] == 1);
                header('Location: ' . BASE_URL . ($isActive ? '/dashboard' : '/payment'));
            }

            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authService = new AuthService(new User());
            $result = $authService->login($_POST);

            $error = $result['error'] ?? '';

            if (!empty($result['success'])) {
                $user = $result['user'];
                $_SESSION['user'] = $user;
                $_SESSION['is_logged_in'] = true;

                $role = strtolower($user['role'] ?? 'peserta');
                if ($role === 'admin') {
                    header('Location: ' . BASE_URL . '/admin/dashboard');
                } elseif ($role === 'juri') {
                    header('Location: ' . BASE_URL . '/juri/dashboard');
                } else {
                    // Peserta: Ambil data tim untuk cek status
                    $teamModel = new Team();
                    $team = $teamModel->findByUserId($user['id']);
                    $_SESSION['team'] = $team;
                    $_SESSION['is_logged_in'] = true;

                    $isActive = (isset($team['is_active']) && $team['is_active'] == 1);
                    if ($isActive) {
                        header('Location: ' . BASE_URL . '/dashboard');
                    } else {
                        header('Location: ' . BASE_URL . '/payment');
                    }
                }
                exit;
            }
        }
        $this->view('auth/login', [
            'title' => 'Login - Designova',
            'error' => $error,
        ]);
    }

    public function register()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authService = new AuthService(new User());
            $result = $authService->register($_POST);

            $error = $result['error'] ?? '';

            if (!empty($result['success'])) {
                header('Location: ' . BASE_URL . '/login');
                exit;
            }
        }

        $this->view('auth/register', [
            'title' => 'Register - Designova',
            'error' => $error,
        ]);
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $authService = new AuthService(new User());
        $authService->logout();

        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
