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
        <div
            class="card-body p-6 border-b border-base-200 flex flex-col sm:flex-row sm:justify-between sm:items-center bg-base-50/10 gap-4">
            <h3 class="card-title text-sm font-black text-neutral-content uppercase tracking-wider">Klasemen Nilai
                Teratas</h3>
            <div class="flex items-center gap-2">
                <!-- Refresh Button -->
                <button onclick="window.location.reload()"
                    class="btn btn-outline border-base-300 hover:border-primary btn-sm font-bold px-4 h-9 min-h-0 rounded-xl flex items-center gap-2 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path fill="currentColor"
                            d="M12 20q-3.35 0-5.675-2.325T4 12t2.325-5.675T12 4q1.725 0 3.3.712T18 6.75V4h2v7h-7V9h4.2q-.8-1.4-2.187-2.2T12 6Q9.5 6 7.75 7.75T6 12t1.75 4.25T12 18q1.925 0 3.475-1.1T17.65 14h2.1q-.7 2.65-2.85 4.325T12 20" />
                    </svg>

                    Refresh
                </button>
                <!-- Export CSV Button -->
                <button onclick="exportCSV()"
                    class="btn btn-primary btn-sm text-primary-content font-bold px-5 h-9 min-h-0 rounded-xl flex items-center gap-2">
                    Ekspor CSV
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr
                        class="bg-base-200 border-b border-base-300 text-gray-500 text-[10px] font-black uppercase tracking-wider">
                        <th class="py-4 pl-8 text-center w-16">Peringkat</th>
                        <th class="py-4">Nama Tim</th>
                        <th class="py-4 text-center">UI / Visual (50%)</th>
                        <th class="py-4 text-center">UX / Flow (40%)</th>
                        <th class="py-4 text-center">Figma (10%)</th>
                        <th class="py-4 pr-8 text-right w-32">Skor Akhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-base-200 text-xs font-semibold text-gray-700">
                    <?php if (empty($leaderboard)): ?>
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm font-semibold">Belum ada tim yang dinilai</p>
                                    <p class="text-xs text-gray-500">Nilai hasil karya tim akan muncul di sini setelah dewan
                                        juri memberikan penilaian.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php
                        $rank = 1;
                        foreach ($leaderboard as $row):
                            // Determine rank badge class
                            $badgeClass = match ($rank) {
                                1 => 'badge-primary text-primary-content shadow-sm',
                                2 => 'badge-secondary text-secondary-content shadow-sm',
                                3 => 'badge-accent text-accent-content shadow-sm',
                                default => 'bg-base-300 text-base-content/75 border-none'
                            };
                            ?>
                            <tr class="hover:bg-base-200/40 transition-colors">
                                <td class="py-5 pl-8 text-center">
                                    <div class="badge <?= $badgeClass; ?> font-black text-xs w-6 h-6 p-0 rounded-lg">
                                        <?= $rank++; ?>
                                    </div>
                                </td>
                                <td class="py-5">
                                    <span
                                        class="font-extrabold text-neutral-content text-sm"><?= htmlspecialchars($row['team_name'] ?? '-'); ?></span>
                                </td>
                                <td class="py-5 text-center font-mono font-medium">
                                    <?= number_format((float) ($row['score_ui'] ?? 0), 2); ?></td>
                                <td class="py-5 text-center font-mono font-medium">
                                    <?= number_format((float) ($row['score_ux'] ?? 0), 2); ?></td>
                                <td class="py-5 text-center font-mono font-medium">
                                    <?= number_format((float) ($row['score_figma'] ?? 0), 2); ?></td>
                                <td class="py-5 pr-8 text-right text-neutral-content font-black text-sm">
                                    <?= number_format((float) ($row['final_score'] ?? 0), 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function exportCSV() {
        const rows = [];
        const headers = ["Peringkat", "Nama Tim", "UI / Visual (50%)", "UX / Flow (40%)", "Figma (10%)", "Skor Akhir"];
        rows.push(headers.join(","));

        const tableRows = document.querySelectorAll("tbody tr");
        if (tableRows.length === 0 || tableRows[0].querySelector("td").colSpan > 1) {
            Swal.fire({
                title: 'Ekspor Gagal',
                text: 'Tidak ada data klasemen untuk diekspor.',
                icon: 'info',
                confirmButtonText: 'OK',
                buttonsStyling: false,
                customClass: {
                    popup: '!rounded-[24px] !p-6 !bg-neutral',
                    title: '!text-2xl !font-bold !text-white',
                    htmlContainer: '!text-white',
                    confirmButton: 'btn btn-primary px-6 !text-white'
                }
            });
            return;
        }

        tableRows.forEach(row => {
            const cols = row.querySelectorAll("td");
            const rank = cols[0].innerText.trim();
            const teamName = cols[1].innerText.trim();
            const ui = cols[2].innerText.trim();
            const ux = cols[3].innerText.trim();
            const figma = cols[4].innerText.trim();
            const finalScore = cols[5].innerText.trim();

            rows.push([rank, `"${teamName}"`, ui, ux, figma, finalScore].join(","));
        });

        const csvContent = "data:text/csv;charset=utf-8," + rows.join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "Leaderboard_Designova.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>