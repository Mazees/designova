<?php

class Controller {
    /**
     * Render berkas view dengan data opsional
     * @param string $view Path file view relatif terhadap app/views/ (misal: 'home/index')
     * @param array $data Data yang akan diekstrak menjadi variabel di dalam view
     */
    public function view($view, $data = []) {
        // Ekstrak data array agar bisa diakses langsung sebagai variabel di view
        extract($data);
        
        $viewFile = '../app/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View file '$viewFile' tidak ditemukan.");
        }
    }
}
