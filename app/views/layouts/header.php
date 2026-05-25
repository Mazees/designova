<?php
$request_uri = $_SERVER['REQUEST_URI'];
$is_auth = (strpos($request_uri, '/login') !== false || strpos($request_uri, '/register') !== false);
$is_payment = (strpos($request_uri, '/payment') !== false);
$is_dashboard = (strpos($request_uri, '/dashboard') !== false ||
    strpos($request_uri, '/submission') !== false ||
    strpos($request_uri, '/juri/') !== false ||
    strpos($request_uri, '/admin/') !== false);
?>
<!DOCTYPE html>
<html lang="id" data-theme="designova-pallet">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Designova'; ?></title>
    <!-- Compiled Tailwind CSS v4 + DaisyUI -->
    <link href="<?= BASE_URL; ?>/src/output.css" rel="stylesheet">
    <!-- Alpine.js for interactive UI state management -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<?php if ($is_auth || $is_payment): ?>

    <body class="bg-base-200 min-h-screen font-sans flex items-center justify-center p-4 sm:p-8">
        <main class="w-full">
        <?php elseif ($is_dashboard): ?>

            <body class="bg-base-200 min-h-screen font-sans">
                <div class="flex min-h-screen">
                    <?php require_once __DIR__ . '/sidebar.php'; ?>
                    <main class="flex-grow p-8 overflow-y-auto">
                    <?php else: ?>

                        <body class="bg-base-100 min-h-screen flex flex-col font-sans">
                            <!-- Navbar Premium dari Mockup -->
                            <header class="bg-accent text-accent-content shadow-md">
                                <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                                    <h1 class="text-2xl font-extrabold text-primary tracking-wider font-sans">
                                        <a href="<?= BASE_URL; ?>/">designova</a>
                                    </h1>
                                    <nav class="flex space-x-8 text-sm font-medium items-center">
                                        <a class="hover:text-primary transition-colors"
                                            href="<?= BASE_URL; ?>/">Kompetisi</a>
                                        <a class="hover:text-primary transition-colors"
                                            href="<?= BASE_URL; ?>/#timeline">Timeline</a>
                                        <a class="hover:text-primary transition-colors"
                                            href="<?= BASE_URL; ?>/#leaderboard">Leaderboard</a>
                                    </nav>
                                    <div class="flex items-center space-x-4">
                                        <a href="<?= BASE_URL; ?>/login"
                                            class="text-sm font-semibold hover:text-primary transition-colors px-4 py-2">Masuk</a>
                                        <a href="<?= BASE_URL; ?>/register"
                                            class="btn btn-primary px-5 py-2.5 rounded-lg font-bold text-sm shadow-md">Daftar
                                            Sekarang</a>
                                    </div>
                                </div>
                            </header>

                            <main class="flex-grow">
                            <?php endif; ?>