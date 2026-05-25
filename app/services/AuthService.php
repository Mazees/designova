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

        if ($email === '') {
            $error = 'Email wajib diisi.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Format email tidak valid.';
        } elseif ($password === '') {
            $error = 'Password wajib diisi.';
        }

        if (isset($error)) {
            return [
                'success' => false,
                'error' => $error,
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
            'error' => 'Email atau password salah.',
        ];
    }

    public function register(array $data): array
    {
        $name = trim((string) ($data['name'] ?? ''));
        $email = trim((string) ($data['email'] ?? ''));
        $password = trim((string) ($data['password'] ?? ''));
        $team_name = trim((string) ($data['team_name'] ?? ''));
        $members = trim((string) ($data['members'] ?? ''));

        if ($name === '') {
            $error = 'Nama wajib diisi.';
        } elseif ($email === '') {
            $error = 'Email wajib diisi.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Format email tidak valid.';
        } elseif ($password === '') {
            $error = 'Password wajib diisi.';
        } elseif (strlen($password) < 6) {
            $error = 'Password minimal 6 karakter.';
        }

        if (isset($error)) {
            return [
                'success' => false,
                'error' => $error,
            ];
        }

        if ($this->userModel->findByEmail($email)) {
            return [
                'success' => false,
                'error' => 'Email sudah terdaftar.',
            ];
        }

        $userId = $this->userModel->addUser($name, $email, $password);

        if ($userId) {
            $this->userModel->addTeams($userId, $team_name, $members);
            return [
                'success' => true,
                'user_id' => $userId,
            ];
        }

        return [
            'success' => false,
            'error' => 'Gagal mendaftarkan user. Silakan coba lagi.',
        ];
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
    }
}