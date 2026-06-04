<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-5xl mx-auto space-y-8 pb-12" data-aos="fade-up">
    <!-- Header -->
    <div class="space-y-2">
        <h2 class="text-3xl font-black text-neutral-content tracking-tight">Evaluasi Tim</h2>
        <p class="text-xs text-gray-400 font-medium max-w-2xl leading-relaxed">
            Berikan nilai objektif dan konstruktif terbaik Anda untuk setiap karya yang dikumpulkan oleh tim peserta.
        </p>
    </div>

    <!-- Table Card -->
    <div class="card bg-base-100 border border-base-200 shadow-sm overflow-hidden rounded-2xl">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr class="bg-base-200 border-b border-base-300 text-gray-500 text-[10px] font-black uppercase tracking-wider">
                        <th class="py-4 pl-8">Nama Tim</th>
                        <th class="py-4">Status Penilian</th>
                        <th class="py-4">Skor Akhir</th>
                        <th class="py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-base-200 text-xs font-semibold text-gray-700">
                    <?php foreach($data['teams'] as $team): ?>
                        <tr class="hover:bg-base-200/40 transition-colors">
                            <!-- Menampilkan Nama Tim dari Database -->
                            <td class="py-5 pl-8">
                                <span class="font-extrabold text-neutral-content text-sm">
                                    <?= htmlspecialchars($team['team_name'] ?? 'Tim Tidak Diketahui'); ?>
                                </span>
                            </td>
                            
                            <!-- Logika Status Penilaian -->
                            <td class="py-5">
                                <?php if (isset($team['final_score']) && $team['final_score'] != 0): ?>
                                    <span class="badge bg-success/15 text-success font-bold px-3 py-1 rounded-full text-[10px]">Sudah Dinilai</span>
                                <?php else: ?>
                                    <span class="badge bg-warning/15 text-warning font-bold px-3 py-1 rounded-full text-[10px]">Belum Dinilai</span>
                                <?php endif; ?>
                            </td>
                            
                           
                            <td class="py-5 font-bold <?= (isset($team['final_score']) && $team['final_score'] != 0) ? 'text-primary' : 'text-gray-400' ?>">
                                <?= (isset($team['final_score']) && $team['final_score'] != 0) ? htmlspecialchars($team['final_score']) : '-' ?>
                            </td>
                            
                            <!-- Tombol Aksi -->
                            <td class="py-5 text-left">
                                <a href="<?= BASE_URL; ?>/juri/review/<?= $team['id']; ?>" 
                                   class="btn w-[200px] py-4 <?= (isset($team['final_score']) && $team['final_score'] != 0) ? 'btn-primary btn' : 'btn-primary text-white' ?> btn-xs px-4 rounded-lg">
                                   <?= (isset($team['final_score']) && $team['final_score'] != 0) ? 'Edit Nilai' : 'Nilai Sekarang' ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Table Footer/Pagination -->
        <div class="p-4 bg-base-200/60 border-t border-base-200 flex justify-between items-center px-8 text-[11px] text-gray-400 font-semibold">
            <span>Menampilkan 1-3 dari 3 tim terdaftar</span>
            <div class="flex items-center space-x-2">
                <button class="btn btn-ghost btn-xs p-1 text-gray-400 hover:text-gray-600 disabled:opacity-50" disabled>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="btn btn-ghost btn-xs p-1 text-gray-400 hover:text-gray-600 disabled:opacity-50" disabled>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
