<?php

class AuthController extends Controller {
    public function login() {
        $this->view('auth/login', [
            'title' => 'Login - Designova'
        ]);
    }

    public function register() {
        $this->view('auth/register', [
            'title' => 'Register - Designova'
        ]);
    }

    public function googleSSO() {
        // Tampilan transisi SSO Google sementara
        echo "<h1>Google SSO Redirect</h1>";
        echo "<p>Mengarahkan pengguna kembali dari Google SSO ke sistem Designova...</p>";
        echo '<p><a href="' . BASE_URL . '/dashboard">Simulasi Login Peserta Berhasil (Klik untuk Lanjut ke Dashboard)</a></p>';
    }
}
