<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center space-x-2 text-sm text-gray-500">
        <a href="<?= BASE_URL; ?>/juri/dashboard" class="hover:underline">Dashboard</a>
        <span>&rarr;</span>
        <span class="text-gray-800">Form Penilaian</span>
    </div>

    <h2 class="text-3xl font-bold text-gray-800 mb-6">Formulir Penilaian Karya</h2>

    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <h3 class="text-xl font-bold text-gray-800 mb-2">Penilaian Tim ID: #<?= htmlspecialchars($team_id); ?></h3>
        <p class="text-gray-500 mb-6 text-sm">Harap masukkan nilai dengan skala 1-100 dan berikan feedback konstruktif.</p>

        <!-- Parameter form simulation -->
        <div class="p-4 mb-4 bg-yellow-50 text-yellow-800 border-l-4 border-yellow-500 rounded text-sm">
            <strong>Parameter Bobot:</strong> UI/Visual (50%), UX/Flow (40%), Kerapian Figma (10%).
        </div>
        
        <p class="text-gray-600">Formulir input skor sesungguhnya belum diaktifkan.</p>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
