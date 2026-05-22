<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Instruksi Pembayaran</h2>
    </div>

    <!-- Sub-menu navigasi khusus peserta -->
    <div class="flex space-x-4 mb-6 border-b border-gray-200 pb-2">
        <a href="<?= BASE_URL; ?>/dashboard" class="text-gray-500 hover:text-gray-700">Overview</a>
        <a href="<?= BASE_URL; ?>/payment" class="text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2">Instruksi Pembayaran</a>
        <a href="<?= BASE_URL; ?>/submission" class="text-gray-500 hover:text-gray-700">Pengumpulan Karya</a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 text-center">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Metode Pembayaran (QRIS Dinamis)</h3>
        <p class="text-gray-600 mb-4">Scan kode QRIS di bawah ini untuk melakukan pelunasan administrasi pendaftaran lomba:</p>
        <div class="w-48 h-48 bg-gray-200 mx-auto flex items-center justify-center rounded border border-gray-300 mb-4">
            <span class="text-xs text-gray-500">[QRIS Placeholder]</span>
        </div>
        <p class="text-sm font-semibold text-gray-800">Total Tagihan: Rp 50.123 (termasuk kode unik)</p>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
