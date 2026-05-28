<?php

class JuriController extends Controller
{
    public function index()
    {
        $this->protectRoute(['juri']);
        $this->view('juri/dashboard', [
            'title' => 'Daftar Karya - Juri Designova'
        ]);
    }

    public function review($team_id)
    {
        $this->protectRoute(['juri']);
        $this->view('juri/review', [
            'title' => 'Form Penilaian Karya Tim #' . htmlspecialchars($team_id),
            'team_id' => $team_id
        ]);
    }
}
