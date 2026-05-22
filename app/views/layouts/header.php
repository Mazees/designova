<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Designova'; ?></title>
    <!-- Tailwind CSS & DaisyUI (CDN untuk stub awal pengembangan) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.16.2/dist/full.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col font-sans">
    <!-- Navbar Navigasi Sistem Routing Stub -->
    <header class="bg-indigo-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-wide">
                <a href="<?= BASE_URL; ?>/">Designova</a>
            </h1>
            <nav class="flex space-x-4 text-sm font-medium">
                <a class="hover:underline" href="<?= BASE_URL; ?>/">Home</a>
                <a class="hover:underline" href="<?= BASE_URL; ?>/login">Login</a>
                <a class="hover:underline" href="<?= BASE_URL; ?>/register">Register</a>
                <a class="hover:underline" href="<?= BASE_URL; ?>/dashboard">Peserta</a>
                <a class="hover:underline" href="<?= BASE_URL; ?>/juri/dashboard">Juri</a>
                <a class="hover:underline" href="<?= BASE_URL; ?>/admin/dashboard">Admin</a>
            </nav>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-4 py-8">
