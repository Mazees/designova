<?php

class AdminController extends Controller {
    public function index() {
        $this->protectRoute(['admin']);
        $this->view('admin/dashboard', [
            'title' => 'Statistik Global - Admin Designova'
        ]);
    }

    public function teams() {
        $this->protectRoute(['admin']);
        $this->view('admin/teams', [
            'title' => 'Manajemen Peserta - Admin Designova'
        ]);
    }

    public function leaderboard() {
        $this->protectRoute(['admin']);
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
}
