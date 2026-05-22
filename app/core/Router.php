<?php

class Router {
    private $routes = [];

    /**
     * Menambahkan rute baru ke daftar perutean
     * @param string $route Pola rute (misal: '/juri/assessment/{team_id}')
     * @param string $controller Nama kelas Controller
     * @param string $action Nama metode di dalam controller
     * @param array|string $methods Metode HTTP yang diizinkan (GET, POST, dll)
     */
    public function add($route, $controller, $action, $methods = ['GET']) {
        // Mengubah parameter dinamis {name} menjadi regex named capture group (?P<name>[^/]+)
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $route);
        $pattern = '#^' . $pattern . '$#';
        
        $this->routes[] = [
            'pattern' => $pattern,
            'controller' => $controller,
            'action' => $action,
            'methods' => array_map('strtoupper', (array)$methods)
        ];
    }

    /**
     * Menangani permintaan HTTP yang masuk
     * @param string $url Path URL yang diakses (misal: /dashboard atau /)
     * @param string $method Metode HTTP dari request
     */
    public function handle($url, $method) {
        // Normalisasi URL: hapus trailing slash kecuali jika root '/'
        $url = ($url !== '/') ? rtrim($url, '/') : '/';
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if (preg_match($route['pattern'], $url, $matches) && in_array($method, $route['methods'])) {
                // Saring hasil pencocokan regex untuk mengambil parameter bernama saja
                $params = array_filter($matches, function($key) {
                    return !is_int($key);
                }, ARRAY_FILTER_USE_KEY);

                $controllerName = $route['controller'];
                $actionName = $route['action'];

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $actionName)) {
                        call_user_func_array([$controller, $actionName], $params);
                        return;
                    }
                }
                
                $this->sendNotFound();
                return;
            }
        }

        $this->sendNotFound();
    }

    private function sendNotFound() {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "<p>Halaman yang Anda cari tidak ditemukan di server Designova.</p>";
    }
}
