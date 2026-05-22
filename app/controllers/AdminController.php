<?php

class AdminController extends Controller {
    public function index() {
        $this->view('admin/dashboard', [
            'title' => 'Statistik Global - Admin Designova'
        ]);
    }

    public function teams() {
        $this->view('admin/teams', [
            'title' => 'Manajemen Peserta - Admin Designova'
        ]);
    }

    public function leaderboard() {
        $this->view('admin/leaderboard', [
            'title' => 'Papan Peringkat - Admin Designova'
        ]);
    }

    public function settings() {
        $this->view('admin/settings', [
            'title' => 'Konfigurasi Sistem - Admin Designova'
        ]);
    }
}
