<?php
// Mulai sesi
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Muat berkas konfigurasi
require_once '../app/config/config.php';

// Registrasi Autoloader untuk core, controllers, dan models
spl_autoload_register(function ($class) {
    $paths = [
        '../app/core/',
        '../app/controllers/',
        '../app/models/',
        '../app/services/'
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Deteksi URL dan bersihkan dari subfolder (laragon / localhost subdirectory support)
$request_uri = $_SERVER['REQUEST_URI'];
// Hapus query string (?key=value) dari URI
$request_uri = explode('?', $request_uri)[0];

// Dapatkan base path script (misal: /designova/public)
$script_name = $_SERVER['SCRIPT_NAME'];
$base_dir = str_replace('\\', '/', dirname(dirname($script_name)));
if ($base_dir !== '/') {
    $base_dir = rtrim($base_dir, '/');
}

// Potong base_dir dari request_uri untuk mendapatkan routing path murni
if (!empty($base_dir) && strpos($request_uri, $base_dir) === 0) {
    $url = substr($request_uri, strlen($base_dir));
} else {
    $url = $request_uri;
}

// Normalisasi URL
$url = ($url !== '/') ? rtrim($url, '/') : '/';
if (empty($url)) {
    $url = '/';
}

$method = $_SERVER['REQUEST_METHOD'];

// Inisialisasi Router dan Daftarkan Rute sesuai rancangan sistem
$router = new Router();

// 1. Halaman Publik
$router->add('/', 'HomeController', 'index', ['GET']);
$router->add('/login', 'AuthController', 'login', ['GET', 'POST']);
$router->add('/register', 'AuthController', 'register', ['GET', 'POST']);
$router->add('/logout', 'AuthController', 'logout', ['POST']);

// 2. Halaman Peserta (Dashboard Tim)
$router->add('/dashboard', 'DashboardController', 'index', ['GET']);
$router->add('/payment', 'PaymentController', 'index', ['GET', 'POST']);
$router->add('/submission', 'DashboardController', 'submission', ['GET', 'POST']);

// 3. Halaman Juri (Dashboard Penilaian)
$router->add('/juri/dashboard', 'JuriController', 'index', ['GET']);
$router->add('/juri/assessment/{team_id}', 'JuriController', 'assessment', ['GET', 'POST']);

// 4. Halaman Pengelola (Dashboard Admin)
$router->add('/admin/dashboard', 'AdminController', 'index', ['GET']);
$router->add('/admin/teams', 'AdminController', 'teams', ['GET', 'POST']);
$router->add('/admin/leaderboard', 'AdminController', 'leaderboard', ['GET']);
$router->add('/admin/settings', 'AdminController', 'settings', ['GET', 'POST']);

// Jalankan perutean
$router->handle($url, $method);
