<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Dashboard Tim</h2>
        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Menunggu Verifikasi</span>
    </div>

    <!-- Sub-menu navigasi khusus peserta -->
    <div class="flex space-x-4 mb-6 border-b border-gray-200 pb-2">
        <a href="<?= BASE_URL; ?>/dashboard" class="text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2">Overview</a>
        <a href="<?= BASE_URL; ?>/payment" class="text-gray-500 hover:text-gray-700">Instruksi Pembayaran</a>
        <a href="<?= BASE_URL; ?>/submission" class="text-gray-500 hover:text-gray-700">Pengumpulan Karya</a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Statistik & Status Tim</h3>
        <p class="text-gray-600">Selamat datang di dashboard tim Designova. Saat ini status pendaftaran tim Anda sedang diverifikasi oleh admin. Silakan lengkapi pembayaran terlebih dahulu agar dapat mengunggah berkas karya.</p>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
