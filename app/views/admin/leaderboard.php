<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-5xl mx-auto space-y-8 pb-12" data-aos="fade-up">
    <!-- Header -->
    <div class="space-y-2">
        <h2 class="text-3xl font-black text-neutral-content tracking-tight">Papan Peringkat</h2>
        <p class="text-xs text-gray-400 font-medium max-w-2xl leading-relaxed">
            Akumulasi skor tertinggi peserta yang dihitung secara real-time berdasarkan penilaian parameter oleh juri.
        </p>
    </div>

    <!-- Leaderboard Table Card -->
    <div class="card bg-base-100 border border-base-200 shadow-sm overflow-hidden rounded-2xl">
        <!-- Card Header with Actions -->
        <div class="card-body p-6 border-b border-base-200 flex flex-col sm:flex-row sm:justify-between sm:items-center bg-base-50/10 gap-4">
            <h3 class="card-title text-sm font-black text-neutral-content uppercase tracking-wider">Klasemen Nilai Teratas</h3>
            <button class="btn btn-primary btn-sm text-primary-content font-bold px-5 h-9 min-h-0 rounded-xl">Ekspor CSV</button>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr class="bg-base-200 border-b border-base-300 text-gray-500 text-[10px] font-black uppercase tracking-wider">
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
                            <div class="badge badge-primary font-black text-xs w-6 h-6 p-0 text-primary-content shadow-sm rounded-lg">
                                1
                            </div>
                        </td>
                        <td class="py-5">
                            <span class="font-extrabold text-neutral-content text-sm">Beta Innovators</span>
                        </td>
                        <td class="py-5 text-center font-mono font-medium">92.00</td>
                        <td class="py-5 text-center font-mono font-medium">94.00</td>
                        <td class="py-5 text-center font-mono font-medium">88.00</td>
                        <td class="py-5 pr-8 text-right text-neutral-content font-black text-sm">92.40</td>
                    </tr>

                    <!-- Rank 2 -->
                    <tr class="hover:bg-base-200/40 transition-colors">
                        <td class="py-5 pl-8 text-center">
                            <div class="badge bg-base-300 text-base-content/75 border-none font-black text-xs w-6 h-6 p-0 rounded-lg">
                                2
                            </div>
                        </td>
                        <td class="py-5">
                            <span class="font-extrabold text-neutral-content text-sm">Alpha Creatives</span>
                        </td>
                        <td class="py-5 text-center font-mono font-medium">88.00</td>
                        <td class="py-5 text-center font-mono font-medium">90.00</td>
                        <td class="py-5 text-center font-mono font-medium">85.00</td>
                        <td class="py-5 pr-8 text-right text-neutral-content font-black text-sm">88.50</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>