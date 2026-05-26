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
                        <th class="py-4">Kategori</th>
                        <th class="py-4">Status Penilaian</th>
                        <th class="py-4">Skor Akhir</th>
                        <th class="py-4 pr-8 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-base-200 text-xs font-semibold text-gray-700">
                    <!-- Row 1 -->
                    <tr class="hover:bg-base-200/40 transition-colors">
                        <td class="py-5 pl-8">
                            <div class="flex items-center space-x-3">
                                <div class="avatar placeholder">
                                    <div class="w-8 h-8 rounded-xl bg-primary/10 text-primary font-black text-xs flex items-center justify-center">
                                        AC
                                    </div>
                                </div>
                                <span class="font-extrabold text-neutral-content text-sm">Alpha Creatives</span>
                            </div>
                        </td>
                        <td class="py-5">
                            <span class="badge bg-base-200 text-base-content/75 border-none font-extrabold text-[9px] py-2 px-3 rounded-lg">
                                UI/UX Design
                            </span>
                        </td>
                        <td class="py-5">
                            <span class="badge bg-warning/15 border border-warning/35 text-warning font-black text-[9px] uppercase tracking-wider py-2.5 px-3">
                                Belum Dinilai
                            </span>
                        </td>
                        <td class="py-5 text-gray-400 font-bold">-</td>
                        <td class="py-5 pr-8 text-right">
                            <a href="<?= BASE_URL; ?>/juri/assessment/1" 
                               class="btn btn-primary btn-xs font-black text-primary-content px-4 py-1.5 h-auto rounded-lg shadow-sm shadow-primary/10">
                               Nilai Sekarang
                            </a>
                        </td>
                    </tr>
                    
                    <!-- Row 2 -->
                    <tr class="hover:bg-base-200/40 transition-colors">
                        <td class="py-5 pl-8">
                            <div class="flex items-center space-x-3">
                                <div class="avatar placeholder">
                                    <div class="w-8 h-8 rounded-xl bg-primary/10 text-primary font-black text-xs flex items-center justify-center">
                                        BI
                                    </div>
                                </div>
                                <span class="font-extrabold text-neutral-content text-sm">Beta Innovators</span>
                            </div>
                        </td>
                        <td class="py-5">
                            <span class="badge bg-base-200 text-base-content/75 border-none font-extrabold text-[9px] py-2 px-3 rounded-lg">
                                UI/UX Design
                            </span>
                        </td>
                        <td class="py-5">
                            <span class="badge bg-success/15 border border-success/35 text-success font-black text-[9px] uppercase tracking-wider py-2.5 px-3">
                                Sudah Dinilai
                            </span>
                        </td>
                        <td class="py-5 text-neutral-content font-black text-sm">
                            92.40<span class="text-xs text-gray-400 font-bold">/100</span>
                        </td>
                        <td class="py-5 pr-8 text-right">
                            <a href="<?= BASE_URL; ?>/juri/assessment/2" 
                               class="btn btn-outline btn-xs font-bold px-4 py-1.5 h-auto rounded-lg">
                               Edit Nilai
                            </a>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="hover:bg-base-200/40 transition-colors">
                        <td class="py-5 pl-8">
                            <div class="flex items-center space-x-3">
                                <div class="avatar placeholder">
                                    <div class="w-8 h-8 rounded-xl bg-primary/10 text-primary font-black text-xs flex items-center justify-center">
                                        NS
                                    </div>
                                </div>
                                <span class="font-extrabold text-neutral-content text-sm">Nova Studios</span>
                            </div>
                        </td>
                        <td class="py-5">
                            <span class="badge bg-base-200 text-base-content/75 border-none font-extrabold text-[9px] py-2 px-3 rounded-lg">
                                UI/UX Design
                            </span>
                        </td>
                        <td class="py-5">
                            <span class="badge bg-warning/15 border border-warning/35 text-warning font-black text-[9px] uppercase tracking-wider py-2.5 px-3">
                                Belum Dinilai
                            </span>
                        </td>
                        <td class="py-5 text-gray-400 font-bold">-</td>
                        <td class="py-5 pr-8 text-right">
                            <a href="<?= BASE_URL; ?>/juri/assessment/3" 
                               class="btn btn-primary btn-xs font-black text-primary-content px-4 py-1.5 h-auto rounded-lg shadow-sm shadow-primary/10">
                               Nilai Sekarang
                            </a>
                        </td>
                    </tr>
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
