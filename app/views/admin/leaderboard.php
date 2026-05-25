<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-5xl mx-auto space-y-8">
    <!-- Header -->
    <div class="space-y-1">
        <h2 class="text-3xl font-extrabold text-neutral-content tracking-tight">Papan Peringkat</h2>
        <p class="text-xs text-gray-400 font-medium">Akumulasi skor tertinggi peserta yang dihitung secara real-time
            berdasarkan penilaian juri.</p>
    </div>

    <!-- Navigation Tabs -->
    <div class="tabs tabs-bordered w-full">
        <a href="<?= BASE_URL; ?>/admin/dashboard" class="tab text-gray-450 hover:text-gray-700">Statistik Global</a>
        <a href="<?= BASE_URL; ?>/admin/teams" class="tab text-gray-450 hover:text-gray-700">Manajemen Peserta</a>
        <a href="<?= BASE_URL; ?>/admin/leaderboard"
            class="tab tab-active font-bold border-primary text-primary-content">Papan Peringkat</a>
        <a href="<?= BASE_URL; ?>/admin/settings" class="tab text-gray-450 hover:text-gray-700">Konfigurasi Sistem</a>
    </div>

    <!-- Leaderboard Table Card -->
    <div class="card bg-base-100 border border-base-200 shadow-md overflow-hidden">
        <!-- Card Header with Actions -->
        <div
            class="card-body p-6 border-b border-base-200 flex flex-row justify-between items-center bg-base-50/20 gap-0">
            <h3 class="card-title text-sm font-black text-neutral-content uppercase tracking-wider">Klasemen Nilai
                Teratas</h3>
            <button class="btn btn-primary btn-sm text-primary-content font-bold px-5 h-9 min-h-0">Ekspor CSV</button>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr
                        class="bg-base-200 border-b border-base-300 text-gray-500 text-[10px] font-bold uppercase tracking-wider">
                        <th class="py-4 pl-8 text-center w-16">Peringkat</th>
                        <th class="py-4">Nama Tim</th>
                        <th class="py-4 text-center">UI / Visual (50%)</th>
                        <th class="py-4 text-center">UX / Flow (40%)</th>
                        <th class="py-4 text-center">Figma (10%)</th>
                        <th class="py-4 pr-8 text-right w-32">Skor Akhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-base-200 text-xs font-semibold text-gray-700">
                    <!-- Rank 1 -->
                    <tr class="hover:bg-base-200/40 transition-colors">
                        <td class="py-5 pl-8 text-center">
                            <div
                                class="badge badge-primary font-bold text-xs w-6 h-6 p-0 text-primary-content shadow-sm">
                                1</div>
                        </td>
                        <td class="py-5">
                            <span class="font-extrabold text-neutral-content text-sm">Beta Innovators</span>
                        </td>
                        <td class="py-5 text-center font-mono">92.00</td>
                        <td class="py-5 text-center font-mono">94.00</td>
                        <td class="py-5 text-center font-mono">88.00</td>
                        <td class="py-5 pr-8 text-right text-neutral-content font-black text-sm">92.40</td>
                    </tr>

                    <!-- Rank 2 -->
                    <tr class="hover:bg-base-200/40 transition-colors">
                        <td class="py-5 pl-8 text-center">
                            <div
                                class="badge bg-base-300 text-primary-content border-none font-bold text-xs w-6 h-6 p-0 shadow-xs">
                                2</div>
                        </td>
                        <td class="py-5">
                            <span class="font-extrabold text-neutral-content text-sm">Alpha Creatives</span>
                        </td>
                        <td class="py-5 text-center font-mono">88.00</td>
                        <td class="py-5 text-center font-mono">90.00</td>
                        <td class="py-5 text-center font-mono">85.00</td>
                        <td class="py-5 pr-8 text-right text-neutral-content font-black text-sm">88.50</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>