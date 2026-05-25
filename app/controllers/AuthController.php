<?php

class AuthController extends Controller
{
    public function login()
    {
        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authService = new AuthService(new User());
            $result = $authService->login($_POST);

            $errors = $result['errors'] ?? [];
            $old = $result['old'] ?? [];

            if (!empty($result['success'])) {
                $_SESSION['user'] = $result['user'];
                header('Location: ' . BASE_URL . '/dashboard');
                exit;
            }
        }

        $this->view('auth/login', [
            'title' => 'Login - Designova',
            'errors' => $errors,
            'old' => $old,
        ]);
    }

    public function register()
    {
        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authService = new AuthService(new User());
            $result = $authService->register($_POST);

            $errors = $result['errors'] ?? [];
            $old = $result['old'] ?? [];

            if (!empty($result['success'])) {
                header('Location: ' . BASE_URL . '/login');
                exit;
            }
        }

        $this->view('auth/register', [
            'title' => 'Register - Designova',
            'errors' => $errors,
            'old' => $old,
        ]);
    }
}
