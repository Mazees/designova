<?php

class DashboardController extends Controller {
    public function index() {
        $this->view('participant/dashboard', [
            'title' => 'Overview Tim - Designova'
        ]);
    }

    public function payment() {
        $this->view('participant/payment', [
            'title' => 'Instruksi Pembayaran - Designova'
        ]);
    }

    public function submission() {
        $this->view('participant/submission', [
            'title' => 'Pengumpulan Karya - Designova'
        ]);
    }
}
