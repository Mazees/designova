<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Peserta</h2>

    <!-- Sub-menu navigasi khusus admin -->
    <div class="flex space-x-4 mb-6 border-b border-gray-200 pb-2">
        <a href="<?= BASE_URL; ?>/admin/dashboard" class="text-gray-500 hover:text-gray-700">Statistik Global</a>
        <a href="<?= BASE_URL; ?>/admin/teams" class="text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2">Manajemen Peserta</a>
        <a href="<?= BASE_URL; ?>/admin/leaderboard" class="text-gray-500 hover:text-gray-700">Papan Peringkat</a>
        <a href="<?= BASE_URL; ?>/admin/settings" class="text-gray-500 hover:text-gray-700">Konfigurasi Sistem</a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Verifikasi Transaksi Pendaftaran</h3>
        <p class="text-gray-600">Daftar tim pendaftar baru beserta status bukti pembayarannya akan ditampilkan di sini untuk aksi Approve/Reject secara manual.</p>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
