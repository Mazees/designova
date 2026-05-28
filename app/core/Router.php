<?php

class Router
{
    private $routes = [];

    /**
     * Menambahkan rute baru ke daftar perutean
     */
    public function add($route, $controller, $action, $methods = ['GET'])
    {
        $this->routes[] = [
            'route' => $route,
            'controller' => $controller,
            'action' => $action,
            'methods' => $methods
        ];
    }

    /**
     * Menangani permintaan HTTP yang masuk
     */
    public function handle($url, $method)
    {
        // Normalisasi URL: hapus trailing slash kecuali jika root '/'
        $url = ($url !== '/') ? rtrim($url, '/') : '/';
        $method = strtoupper($method);

        // Pecah URL yang diakses menjadi array/segmen
        // Contoh: "/juri/review/24" -> ["juri", "assessment", "24"]
        $urlSegments = explode('/', trim($url, '/'));

        foreach ($this->routes as $route) {
            // 1. Cek apakah HTTP Method cocok (GET/POST)
            if (!in_array($method, $route['methods'])) {
                continue;
            }

            // Pecah Pola Rute menjadi array/segmen
            // Contoh: "/juri/review/{team_id}" -> ["juri", "assessment", "{team_id}"]
            $routeSegments = explode('/', trim($route['route'], '/'));

            // 2. Cek apakah jumlah segmen sama. Jika beda, pasti tidak cocok.
            if (count($urlSegments) !== count($routeSegments)) {
                continue;
            }

            $isMatch = true;
            $params = [];

            // 3. Cocokkan segmen per segmen
            for ($i = 0; $i < count($routeSegments); $i++) {
                $routeSeg = $routeSegments[$i];
                $urlSeg = $urlSegments[$i];

                // Cek apakah segmen rute ini adalah parameter dinamis, misal: {team_id}
                if (str_starts_with($routeSeg, '{') && str_ends_with($routeSeg, '}')) {
                    // Ambil nama parameter tanpa kurung kurawal
                    $paramName = trim($routeSeg, '{}');
                    // Simpan nilainya dari URL
                    $params[$paramName] = $urlSeg;
                }
                // Jika bukan parameter, teksnya harus sama persis
                elseif ($routeSeg !== $urlSeg) {
                    $isMatch = false;
                    break;
                }
            }

            // 4. Jika cocok semua, jalankan Controller & Method-nya
            if ($isMatch) {
                $controllerName = $route['controller'];
                $actionName = $route['action'];

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $actionName)) {
                        // Jalankan fungsi controller dan kirim parameter dinamisnya
                        call_user_func_array([$controller, $actionName], $params);
                        return;
                    }
                }

                $this->sendNotFound();
                return;
            }
        }

        // Jika tidak ada satupun rute yang cocok
        $this->sendNotFound();
    }

    private function sendNotFound()
    {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "<p>Halaman yang Anda cari tidak ditemukan di server Designova.</p>";
    }
}
