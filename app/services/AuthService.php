<?php
class AuthService
{
    private User $userModel;
    public function __construct(User $u)
    {
        $this->userModel = $u;
    }

    public function validateUser(string $email, string $password): ?array
    {
        $user = $this->userModel->findByEmail($email);

        if (is_array($user) && isset($user['password']) && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }

    public function login(array $data): array
    {
        $email = trim((string) ($data['email'] ?? ''));
        $password = trim((string) ($data['password'] ?? ''));

        $errors = [];

        if ($email === '') {
            $errors[] = 'Email wajib diisi.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Format email tidak valid.';
        }

        if ($password === '') {
            $errors[] = 'Password wajib diisi.';
        }

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        $user = $this->validateUser($email, $password);

        if ($user) {
            return [
                'success' => true,
                'user' => $user,
            ];
        }

        return [
            'success' => false,
            'errors' => ['Email atau password salah.'],
        ];
    }

    public function register(array $data): array
    {
        $name = trim((string) ($data['name'] ?? ''));
        $email = trim((string) ($data['email'] ?? ''));
        $password = trim((string) ($data['password'] ?? ''));

        $errors = [];

        if ($name === '') {
            $errors[] = 'Nama wajib diisi.';
        }

        if ($email === '') {
            $errors[] = 'Email wajib diisi.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Format email tidak valid.';
        }

        if ($password === '') {
            $errors[] = 'Password wajib diisi.';
        } elseif (strlen($password) < 6) {
            $errors[] = 'Password minimal 6 karakter.';
        }

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        if ($this->userModel->findByEmail($email)) {
            return [
                'success' => false,
                'errors' => ['Email sudah terdaftar.'],
            ];
        }

        $userId = $this->userModel->addUser($name, $email, $password);

        if ($userId) {
            return [
                'success' => true,
                'user_id' => $userId,
            ];
        }

        return [
            'success' => false,
            'errors' => ['Gagal mendaftarkan user. Silakan coba lagi.'],
            'old' => [
                'name' => $name,
                'email' => $email,
            ],
        ];
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
    }
}