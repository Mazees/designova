<?php
$request_uri = $_SERVER['REQUEST_URI'];
$is_auth = (strpos($request_uri, '/login') !== false || strpos($request_uri, '/register') !== false);
$is_payment = (strpos($request_uri, '/payment') !== false);
$is_dashboard = (
    strpos($request_uri, '/dashboard') !== false ||
    strpos($request_uri, '/submission') !== false ||
    strpos($request_uri, '/juri/') !== false ||
    strpos($request_uri, '/admin/') !== false
);
?>
<!DOCTYPE html>
<html lang="id" data-theme="designova-pallet">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Designova — Platform kompetisi UI/UX nasional paling prestisius. Tunjukkan skill desainmu dan raih kesempatan karir di industri teknologi.">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Designova'; ?></title>
    <!-- Compiled Tailwind CSS v4 + DaisyUI -->
    <link href="<?= BASE_URL; ?>/src/output.css" rel="stylesheet">
    <!-- AOS (Animate on Scroll) -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Alpine.js for interactive UI state management -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({ duration: 650, once: true, offset: 60, easing: 'ease-out-cubic' });
        });
    </script>
</head>

<?php if ($is_auth || $is_payment): ?>

    <body class="bg-base-200 min-h-screen font-sans flex items-center justify-center p-4 sm:p-8">
        <main class="w-full">

        <?php elseif ($is_dashboard): ?>

            <body class="bg-base-200 min-h-screen font-sans">
                <!-- DaisyUI Drawer untuk responsive sidebar -->
                <div class="drawer lg:drawer-open min-h-screen">
                    <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />
                    <div class="drawer-content flex flex-col">
                        <!-- Mobile Top Bar (hamburger) -->
                        <div class="navbar bg-base-100 border-b border-base-200 lg:hidden px-4 sticky top-0 z-30 shadow-sm">
                            <div class="flex-none">
                                <label for="sidebar-drawer" class="btn btn-ghost btn-square" aria-label="Open sidebar">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </label>
                            </div>
                            <div class="flex-1 ml-2">
                                <span class="text-lg font-black text-accent">DESIGNOVA</span>
                            </div>
                            <div class="flex-none">
                                <div class="avatar placeholder">
                                    <div
                                        class="bg-primary text-primary-content rounded-full w-8 font-bold text-sm flex items-center justify-center">
                                        <?= strtoupper(substr($_SESSION['user']['name'] ?? 'U', 0, 1)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Main content -->
                        <main class="flex-1 p-6 lg:p-8 page-content">

                        <?php else: ?>

                            <body class="bg-base-100 min-h-screen flex flex-col font-sans">
                                <!-- Navbar Landing Page -->
                                <div class="navbar bg-base-100 h-16 text-base-content sticky sm:px-10 top-0 z-50 border-b border-base-200 transition-all duration-300"
                                    id="main-navbar">
                                    <div class="navbar-start">
                                        <!-- Mobile hamburger dropdown -->
                                        <div class="dropdown">
                                            <div tabindex="0" role="button"
                                                class="btn btn-ghost lg:hidden text-base-content">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 12h16M4 18h16" />
                                                </svg>
                                            </div>
                                            <ul tabindex="0"
                                                class="menu menu-sm dropdown-content bg-base-100 text-base-content rounded-box z-[1] mt-3 w-52 p-3 shadow-xl border border-base-200 gap-1">
                                                <li><a href="<?= BASE_URL; ?>/"
                                                        class="font-semibold hover:text-primary py-2 rounded-lg">Beranda</a>
                                                </li>
                                                <li><a href="<?= BASE_URL; ?>/#tema"
                                                        class="font-semibold hover:text-primary py-2 rounded-lg">Tema
                                                        Lomba</a></li>
                                                <li><a href="<?= BASE_URL; ?>/#timeline"
                                                        class="font-semibold hover:text-primary py-2 rounded-lg">Timeline</a>
                                                </li>
                                                <li><a href="<?= BASE_URL; ?>/#faq"
                                                        class="font-semibold hover:text-primary py-2 rounded-lg">FAQ</a>
                                                </li>
                                                <li class="mt-2 border-t border-base-200 pt-2">
                                                    <a href="<?= BASE_URL; ?>/login"
                                                        class="btn btn-outline btn-sm">Masuk</a>
                                                </li>
                                                <li class="mt-1">
                                                    <a href="<?= BASE_URL; ?>/register"
                                                        class="btn btn-primary btn-sm">Daftar
                                                        Sekarang</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Logo -->
                                        <a href="<?= BASE_URL; ?>/"
                                            class="text-2xl font-black tracking-wider text-primary">DESIGNOVA</a>
                                    </div>
                                    <div class="navbar-center hidden lg:flex">
                                        <ul class="menu menu-horizontal px-1 gap-1">
                                            <li><a href="<?= BASE_URL; ?>/"
                                                    class="font-semibold text-sm text-base-content/80 hover:text-primary hover:bg-base-200 rounded-lg transition-colors px-4 py-2">Beranda</a>
                                            </li>
                                            <li><a href="<?= BASE_URL; ?>/#tema"
                                                    class="font-semibold text-sm text-base-content/80 hover:text-primary hover:bg-base-200 rounded-lg transition-colors px-4 py-2">Tema
                                                    Lomba</a></li>
                                            <li><a href="<?= BASE_URL; ?>/#timeline"
                                                    class="font-semibold text-sm text-base-content/80 hover:text-primary hover:bg-base-200 rounded-lg transition-colors px-4 py-2">Timeline</a>
                                            </li>
                                            <li><a href="<?= BASE_URL; ?>/#faq"
                                                    class="font-semibold text-sm text-base-content/80 hover:text-primary hover:bg-base-200 rounded-lg transition-colors px-4 py-2">FAQ</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="navbar-end hidden lg:flex items-center gap-3">
                                        <a href="<?= BASE_URL; ?>/login"
                                            class="text-sm font-semibold text-base-content/80 hover:text-primary transition-colors px-4 py-2.5 rounded-lg hover:bg-base-200">Masuk</a>
                                        <a href="<?= BASE_URL; ?>/register"
                                            class="btn btn-primary btn-sm px-5 font-bold shadow-sm shadow-primary/20 hover:scale-[1.02] transition-transform duration-200 text-primary-content">Daftar
                                            Sekarang</a>
                                    </div>
                                </div>

                                <main class="flex-grow">

                                <?php endif; ?>