<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Pengumpulan Karya</h2>
    </div>

    <!-- Sub-menu navigasi khusus peserta -->
    <div class="flex space-x-4 mb-6 border-b border-gray-200 pb-2">
        <a href="<?= BASE_URL; ?>/dashboard" class="text-gray-500 hover:text-gray-700">Overview</a>
        <a href="<?= BASE_URL; ?>/payment" class="text-gray-500 hover:text-gray-700">Instruksi Pembayaran</a>
        <a href="<?= BASE_URL; ?>/submission" class="text-indigo-600 font-semibold border-b-2 border-indigo-600 pb-2">Pengumpulan Karya</a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Formulir Submisi Deliverables</h3>
        <div class="p-4 mb-4 bg-yellow-50 text-yellow-800 border-l-4 border-yellow-500 rounded text-sm">
            <strong>Catatan:</strong> Bagian ini hanya terbuka bagi tim yang status pembayarannya telah terverifikasi.
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
