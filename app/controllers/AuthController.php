<?php

class AuthController extends Controller
{
    public function login()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authService = new AuthService(new User());
            $result = $authService->login($_POST);

            $error = $result['error'] ?? '';

            if (!empty($result['success'])) {
                $_SESSION['user'] = $result['user'];
                header('Location: ' . BASE_URL . '/dashboard');
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
}
