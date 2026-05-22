<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Penilaian Juri</h2>
    
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Daftar Karya Tim Peserta</h3>
        
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                        <th class="p-3 border-b">ID Tim</th>
                        <th class="p-3 border-b">Nama Tim</th>
                        <th class="p-3 border-b">Status Penilaian</th>
                        <th class="p-3 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600">
                    <tr>
                        <td class="p-3 border-b">#101</td>
                        <td class="p-3 border-b font-medium text-gray-800">Tim UIUX Mantap</td>
                        <td class="p-3 border-b"><span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-semibold">Belum Dinilai</span></td>
                        <td class="p-3 border-b">
                            <a href="<?= BASE_URL; ?>/juri/assessment/101" class="text-indigo-600 hover:underline">Mulai Nilai</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-3 border-b">#102</td>
                        <td class="p-3 border-b font-medium text-gray-800">Tim Kreatif Jaya</td>
                        <td class="p-3 border-b"><span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">Sudah Dinilai</span></td>
                        <td class="p-3 border-b">
                            <a href="<?= BASE_URL; ?>/juri/assessment/102" class="text-indigo-600 hover:underline">Edit Nilai</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
