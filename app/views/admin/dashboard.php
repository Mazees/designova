<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Admin: Statistik Global</h2>

    <!-- Sub-menu navigasi khusus admin -->
    <div class="flex space-x-4 mb-6 border-b border-gray-200 pb-2">
        <a href="<?= BASE_URL; ?>/admin/dashboard" class="text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2">Statistik Global</a>
        <a href="<?= BASE_URL; ?>/admin/teams" class="text-gray-500 hover:text-gray-700">Manajemen Peserta</a>
        <a href="<?= BASE_URL; ?>/admin/leaderboard" class="text-gray-500 hover:text-gray-700">Papan Peringkat</a>
        <a href="<?= BASE_URL; ?>/admin/settings" class="text-gray-500 hover:text-gray-700">Konfigurasi Sistem</a>
    </div>

    <!-- Metrik Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow border border-gray-200 text-center">
            <span class="text-gray-500 uppercase text-xs font-bold tracking-wider">Total Tim Terdaftar</span>
            <div class="text-4xl font-extrabold text-indigo-600 mt-2">12</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow border border-gray-200 text-center">
            <span class="text-gray-500 uppercase text-xs font-bold tracking-wider">Karya Terkumpul</span>
            <div class="text-4xl font-extrabold text-green-600 mt-2">8</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow border border-gray-200 text-center">
            <span class="text-gray-500 uppercase text-xs font-bold tracking-wider">Progres Penilaian</span>
            <div class="text-4xl font-extrabold text-yellow-600 mt-2">66%</div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
