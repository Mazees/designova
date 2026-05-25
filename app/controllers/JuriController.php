<?php

class JuriController extends Controller {
    public function index() {
        $this->protectRoute(['juri']);
        $this->view('juri/dashboard', [
            'title' => 'Daftar Karya - Juri Designova'
        ]);
    }

    public function assessment($team_id) {
        $this->protectRoute(['juri']);
        $this->view('juri/assessment', [
            'title' => 'Form Penilaian Karya Tim #' . htmlspecialchars($team_id),
            'team_id' => $team_id
        ]);
    }
}
