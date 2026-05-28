<?php require_once '../app/views/layouts/header.php'; ?>

<?php
$metrics = $metrics ?? [];
$recentTeams = $recentTeams ?? [];
$recentPayments = $recentPayments ?? [];
$topTeams = $topTeams ?? [];
$settings = $settings ?? [];

$isRegOpen = (isset($settings['is_registration_open']) && (int) $settings['is_registration_open'] === 1);
$deadline = $settings['submission_deadline'] ?? null;
$deadlineFormatted = $deadline ? date('d M Y H:i', strtotime($deadline)) : 'Tidak ditentukan';
?>

<div class="max-w-5xl mx-auto space-y-8 pb-12" data-aos="fade-up">
    <!-- Header & Event Status Quick Info -->
    <div
        class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-base-100 border border-base-200 p-6 rounded-3xl shadow-sm">
        <div class="space-y-1">
            <h2 class="text-3xl font-black text-neutral-content tracking-tight">Statistik Global</h2>
            <p class="text-xs text-gray-400 font-medium leading-relaxed max-w-xl">
                Pantau progres pendaftaran kompetisi, verifikasi transaksi pembayaran, serta progres penilaian karya
                secara real-time.
            </p>
        </div>
        <div class="flex justify-end flex-wrap items-center gap-3">
            <!-- Registration Status Badge -->
            <div class="flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-base-200 border border-base-300">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 <?= $isRegOpen ? 'bg-success' : 'bg-error'; ?>"></span>
                    <span
                        class="relative inline-flex rounded-full h-2 w-2 <?= $isRegOpen ? 'bg-success' : 'bg-error'; ?>"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-wider text-neutral-content">
                    Registrasi: <?= $isRegOpen ? 'DIBUKA' : 'DITUTUP'; ?>
                </span>
            </div>
        </div>
    </div>

    <!-- Metrik Grid Utama -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: Pendaftaran -->
        <div class="card bg-base-100 border border-base-200 shadow-sm rounded-3xl overflow-hidden p-6 space-y-4">
            <div class="flex justify-between items-start">
                <div class="space-y-1">
                    <span class="text-[10px] font-black uppercase tracking-wider text-gray-400">Pendaftaran
                        Peserta</span>
                    <div class="text-3xl font-black text-accent">
                        <?= htmlspecialchars((string) ($metrics['total_teams'] ?? 0), ENT_QUOTES); ?></div>
                    <p class="text-[10px] text-gray-400 font-medium">Tim terdaftar kompetisi</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-accent/10 text-accent flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="pt-2 border-t border-base-200 grid grid-cols-2 gap-4">
                <div>
                    <span class="text-[9px] font-bold text-gray-450 uppercase block">Tim Aktif</span>
                    <span
                        class="text-sm font-extrabold text-success"><?= htmlspecialchars((string) ($metrics['active_teams'] ?? 0), ENT_QUOTES); ?></span>
                </div>
                <div>
                    <span class="text-[9px] font-bold text-gray-450 uppercase block">Tim Pending</span>
                    <span
                        class="text-sm font-extrabold text-warning"><?= htmlspecialchars((string) ($metrics['pending_teams'] ?? 0), ENT_QUOTES); ?></span>
                </div>
            </div>
        </div>

        <!-- Card 2: Keuangan -->
        <div class="card bg-base-100 border border-base-200 shadow-sm rounded-3xl overflow-hidden p-6 space-y-4">
            <div class="flex justify-between items-start">
                <div class="space-y-1">
                    <span class="text-[10px] font-black uppercase tracking-wider text-gray-400">Total Pendapatan</span>
                    <div class="text-3xl font-black text-success">
                        Rp <?= number_format((int) ($metrics['total_income'] ?? 0), 0, ',', '.'); ?>
                    </div>
                    <p class="text-[10px] text-gray-400 font-medium">Berdasarkan transaksi yang disetujui</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-success/10 text-success flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="pt-2 border-t border-base-200 grid grid-cols-2 gap-4">
                <div>
                    <span class="text-[9px] font-bold text-gray-450 uppercase block">Pembayaran Sukses</span>
                    <span
                        class="text-sm font-extrabold text-success"><?= htmlspecialchars((string) ($metrics['confirmed_payments'] ?? 0), ENT_QUOTES); ?></span>
                </div>
                <div>
                    <span class="text-[9px] font-bold text-gray-450 uppercase block">Pembayaran Pending</span>
                    <span
                        class="text-sm font-extrabold text-warning"><?= htmlspecialchars((string) ($metrics['pending_payments'] ?? 0), ENT_QUOTES); ?></span>
                </div>
            </div>
        </div>

        <!-- Card 3: Karya & Evaluasi -->
        <div class="card bg-base-100 border border-base-200 shadow-sm rounded-3xl overflow-hidden p-6 space-y-4">
            <div class="flex justify-between items-start">
                <div class="space-y-1">
                    <span class="text-[10px] font-black uppercase tracking-wider text-gray-400">Pengumpulan Karya</span>
                    <div class="text-3xl font-black text-info">
                        <?= htmlspecialchars((string) ($metrics['total_submissions'] ?? 0), ENT_QUOTES); ?></div>
                    <p class="text-[10px] text-gray-400 font-medium">Progres Penilaian Juri: <span
                            class="text-info font-black"><?= htmlspecialchars((string) ($metrics['grading_progress'] ?? 0), ENT_QUOTES); ?>%</span>
                    </p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-info/10 text-info flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
            <div class="pt-2 border-t border-base-200">
                <div class="flex justify-between items-center text-[9px] font-bold text-gray-450 uppercase mb-1">
                    <span>Progres Pengumpulan Karya</span>
                    <span><?= htmlspecialchars((string) ($metrics['submission_progress'] ?? 0), ENT_QUOTES); ?>%</span>
                </div>
                <progress class="progress progress-info w-full"
                    value="<?= htmlspecialchars((string) ($metrics['submission_progress'] ?? 0), ENT_QUOTES); ?>"
                    max="100"></progress>
            </div>
        </div>
    </div>

    <!-- Kolom Ganda: Aktivitas Terbaru vs Klasemen / Aksi -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri: Riwayat Aktivitas & Transaksi -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Tabel Pendaftaran Terbaru -->
            <div class="card bg-base-100 border border-base-200 shadow-sm rounded-3xl overflow-hidden">
                <div class="p-5 border-b border-base-200 flex justify-between items-center">
                    <h3 class="text-xs font-black text-neutral-content uppercase tracking-wider">Tim Pendaftar Terbaru
                    </h3>
                    <a href="<?= BASE_URL; ?>/admin/teams"
                        class="text-[10px] font-extrabold text-primary hover:underline">Kelola Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table w-full text-xs">
                        <thead>
                            <tr
                                class="bg-base-200/50 text-[10px] font-black uppercase text-gray-400 border-b border-base-200">
                                <th class="py-3 pl-6">Nama Tim</th>
                                <th class="py-3">Email Ketua</th>
                                <th class="py-3 pr-6 text-right">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-200 font-semibold text-gray-650">
                            <?php if (!empty($recentTeams)): ?>
                                <?php foreach ($recentTeams as $team): ?>
                                    <tr class="hover:bg-base-200/30 transition-colors">
                                        <td class="py-3.5 pl-6 font-extrabold text-neutral-content">
                                            <a href="<?= BASE_URL; ?>/admin/teams/<?= $team['id']; ?>"
                                                class="hover:text-primary transition-colors">
                                                <?= htmlspecialchars((string) ($team['team_name'] ?? '-'), ENT_QUOTES); ?>
                                            </a>
                                        </td>
                                        <td class="py-3.5 text-gray-450">
                                            <?= htmlspecialchars((string) ($team['leader_email'] ?? '-'), ENT_QUOTES); ?></td>
                                        <td class="py-3.5 pr-6 text-right text-gray-400 font-mono text-[10px]">
                                            <?= date('d M Y H:i', strtotime($team['created_at'])); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="py-6 text-center text-gray-400 font-medium">Belum ada pendaftaran
                                        tim baru.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabel Transaksi Terbaru -->
            <div class="card bg-base-100 border border-base-200 shadow-sm rounded-3xl overflow-hidden">
                <div class="p-5 border-b border-base-200 flex justify-between items-center">
                    <h3 class="text-xs font-black text-neutral-content uppercase tracking-wider">Transaksi Pembayaran
                        Terbaru</h3>
                    <a href="<?= BASE_URL; ?>/admin/payments"
                        class="text-[10px] font-extrabold text-primary hover:underline">Verifikasi Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="table w-full text-xs">
                        <thead>
                            <tr
                                class="bg-base-200/50 text-[10px] font-black uppercase text-gray-400 border-b border-base-200">
                                <th class="py-3 pl-6">Nama Tim</th>
                                <th class="py-3">Nominal</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 pr-6 text-right">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-200 font-semibold text-gray-650">
                            <?php if (!empty($recentPayments)): ?>
                                <?php foreach ($recentPayments as $pay): ?>
                                    <?php
                                    $payStatus = strtolower($pay['status'] ?? 'pending');
                                    $badgeClass = match ($payStatus) {
                                        'confirmed' => 'bg-success/15 text-success border border-success/35',
                                        'rejected' => 'bg-error/15 text-error border border-error/35',
                                        default => 'bg-warning/15 text-warning border border-warning/35'
                                    };
                                    $label = match ($payStatus) {
                                        'confirmed' => 'Sukses',
                                        'rejected' => 'Ditolak',
                                        default => 'Pending'
                                    };
                                    ?>
                                    <tr class="hover:bg-base-200/30 transition-colors">
                                        <td class="py-3.5 pl-6 font-extrabold text-neutral-content">
                                            <?= htmlspecialchars((string) ($pay['team_name'] ?? '-'), ENT_QUOTES); ?></td>
                                        <td class="py-3.5 font-bold text-neutral-content">Rp
                                            <?= number_format((int) $pay['amount'], 0, ',', '.'); ?></td>
                                        <td class="py-3.5">
                                            <span
                                                class="badge badge-xs font-black text-[9px] uppercase py-2 px-2.5 rounded-lg <?= $badgeClass; ?>">
                                                <?= $label; ?>
                                            </span>
                                        </td>
                                        <td class="py-3.5 pr-6 text-right text-gray-400 font-mono text-[10px]">
                                            <?= date('d M Y H:i', strtotime($pay['created_at'])); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-400 font-medium">Belum ada transaksi
                                        pembayaran.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Leaderboard Sementara & Quick Actions -->
        <div class="space-y-6">
            <!-- Top 3 Leaderboard -->
            <div class="card bg-base-100 border border-base-200 shadow-sm rounded-3xl overflow-hidden p-6 space-y-4">
                <h3
                    class="text-xs font-black text-neutral-content uppercase tracking-wider border-b border-base-200 pb-3">
                    Leaderboard Sementara</h3>

                <div class="space-y-3">
                    <?php if (!empty($topTeams)): ?>
                        <?php foreach ($topTeams as $index => $item): ?>
                            <?php
                            $rank = $index + 1;
                            $rankBadge = match ($rank) {
                                1 => 'bg-warning/20 border border-warning/40 text-warning', // Gold
                                2 => 'bg-slate-350/15 border border-slate-350/30 text-slate-400', // Silver
                                3 => 'bg-amber-700/15 border border-amber-700/30 text-amber-700', // Bronze
                                default => 'bg-base-200 text-gray-400'
                            };
                            ?>
                            <div
                                class="flex items-center justify-between p-3 bg-base-200/40 border border-base-200/50 rounded-2xl">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div
                                        class="w-6 h-6 shrink-0 rounded-lg font-black text-xs flex items-center justify-center <?= $rankBadge; ?>">
                                        <?= $rank; ?>
                                    </div>
                                    <span
                                        class="text-xs font-extrabold text-neutral-content truncate"><?= htmlspecialchars((string) ($item['team_name'] ?? '-'), ENT_QUOTES); ?></span>
                                </div>
                                <span
                                    class="text-xs font-black text-neutral-content font-mono"><?= number_format((float) ($item['final_score'] ?? 0), 2); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-6 text-gray-400 font-medium text-xs">Belum ada karya yang dinilai.</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Pintasan Aksi Cepat (Quick Actions) -->
            <div class="card bg-base-100 border border-base-200 shadow-sm rounded-3xl overflow-hidden p-6 space-y-4">
                <h3
                    class="text-xs font-black text-neutral-content uppercase tracking-wider border-b border-base-200 pb-3">
                    Pintasan Aksi Cepat</h3>

                <div class="grid grid-cols-1 gap-2.5">
                    <a href="<?= BASE_URL; ?>/admin/payments"
                        class="btn btn-outline btn-sm justify-between rounded-xl h-10 px-4 text-xs font-bold hover:bg-primary hover:text-primary-content group">
                        <span>Verifikasi Pembayaran</span>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-content transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    <a href="<?= BASE_URL; ?>/admin/teams"
                        class="btn btn-outline btn-sm justify-between rounded-xl h-10 px-4 text-xs font-bold hover:bg-primary hover:text-primary-content group">
                        <span>Manajemen Peserta</span>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-content transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    <a href="<?= BASE_URL; ?>/admin/settings"
                        class="btn btn-outline btn-sm justify-between rounded-xl h-10 px-4 text-xs font-bold hover:bg-primary hover:text-primary-content group">
                        <span>Pengaturan Sistem</span>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-primary-content transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>