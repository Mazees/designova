<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Papan Peringkat</h2>

    <!-- Sub-menu navigasi khusus admin -->
    <div class="flex space-x-4 mb-6 border-b border-gray-200 pb-2">
        <a href="<?= BASE_URL; ?>/admin/dashboard" class="text-gray-500 hover:text-gray-700">Statistik Global</a>
        <a href="<?= BASE_URL; ?>/admin/teams" class="text-gray-500 hover:text-gray-700">Manajemen Peserta</a>
        <a href="<?= BASE_URL; ?>/admin/leaderboard" class="text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2">Papan Peringkat</a>
        <a href="<?= BASE_URL; ?>/admin/settings" class="text-gray-500 hover:text-gray-700">Konfigurasi Sistem</a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Klasemen Nilai Tertinggi</h3>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm font-semibold shadow">Ekspor CSV (Stub)</button>
        </div>
        <p class="text-gray-600">Urutan akumulasi skor tertinggi yang dihitung secara real-time dari database assessments akan ditampilkan di sini.</p>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
