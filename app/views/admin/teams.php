<?php require_once '../app/views/layouts/header.php'; ?>

<?php
$teams = $teams ?? [];
$search = $search ?? '';
$statusFilter = $statusFilter ?? '';
?>

<div class="max-w-5xl mx-auto space-y-8 pb-12" data-aos="fade-up">
    <!-- Header -->
    <div class="space-y-2">
        <h2 class="text-3xl font-black text-neutral-content tracking-tight">Manajemen Peserta</h2>
        <p class="text-xs text-gray-400 font-medium max-w-2xl leading-relaxed">
            Kelola data pendaftaran tim peserta, periksa daftar anggota, dan verifikasi status aktif/tidak aktif tim secara manual.
        </p>
    </div>

    <!-- Search & Filter Area -->
    <form action="<?= BASE_URL; ?>/admin/teams" method="GET" class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <!-- Search bar -->
        <div class="join max-w-sm w-full">
            <input type="text"
                   name="search"
                   value="<?= htmlspecialchars((string)($search), ENT_QUOTES); ?>"
                   class="input input-bordered join-item text-xs h-10 w-full font-medium focus:outline-none focus:border-primary"
                   placeholder="Cari nama tim atau ketua..." />
            <button type="submit" class="btn btn-primary join-item text-xs h-10 text-primary-content font-bold px-5">Cari</button>
            <?php if ($search !== '' || $statusFilter !== ''): ?>
                <a href="<?= BASE_URL; ?>/admin/teams" class="btn btn-ghost join-item text-xs h-10 font-bold px-3">Reset</a>
            <?php endif; ?>
        </div>

        <!-- Filter Dropdown -->
        <select name="status" onchange="this.form.submit()" class="select select-bordered text-xs h-10 font-bold max-w-xs rounded-xl bg-base-100 focus:outline-none focus:border-primary">
            <option value="" <?= $statusFilter === '' ? 'selected' : ''; ?>>Semua Status</option>
            <option value="1" <?= $statusFilter === '1' ? 'selected' : ''; ?>>Verified &amp; Aktif</option>
            <option value="0" <?= $statusFilter === '0' ? 'selected' : ''; ?>>Menunggu Verifikasi</option>
        </select>
    </form>

    <!-- Table Card -->
    <div class="card bg-base-100 border border-base-200 shadow-sm overflow-hidden rounded-2xl">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr class="bg-base-200 border-b border-base-300 text-gray-500 text-[10px] font-black uppercase tracking-wider">
                        <th class="py-4 pl-8">Nama Tim</th>
                        <th class="py-4">Email Ketua</th>
                        <th class="py-4">Tanggal Daftar</th>
                        <th class="py-4">Status Akun</th>
                        <th class="py-4 pr-8 text-right">Detail &amp; Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-base-200 text-xs font-semibold text-gray-700">
                    <?php if (!empty($teams)): ?>
                        <?php foreach ($teams as $team): ?>
                            <tr class="hover:bg-base-200/40 transition-colors">
                                <td class="py-5 pl-8">
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar placeholder">
                                            <div class="w-8 h-8 rounded-xl bg-primary/10 text-primary font-black text-xs flex items-center justify-center">
                                                <?= htmlspecialchars(strtoupper(substr($team['team_name'] ?? 'T', 0, 2)), ENT_QUOTES); ?>
                                            </div>
                                        </div>
                                        <a href="<?= $team['detail_url']; ?>" class="font-extrabold text-neutral-content text-sm hover:underline hover:text-primary">
                                            <?= htmlspecialchars((string) ($team['team_name'] ?? '-'), ENT_QUOTES); ?>
                                        </a>
                                    </div>
                                </td>
                                <td class="py-5 text-gray-500 font-medium">
                                    <?= htmlspecialchars((string) ($team['leader_email'] ?? '-'), ENT_QUOTES); ?>
                                </td>
                                <td class="py-5 text-gray-400 font-mono">
                                    <?= htmlspecialchars((string) ($team['date_formatted'] ?? '-'), ENT_QUOTES); ?>
                                </td>
                                <td class="py-5">
                                    <span class="badge <?= htmlspecialchars((string)$team['status_badge_class'], ENT_QUOTES); ?> font-black text-[9px] uppercase tracking-wider py-2.5 px-3">
                                        <?= htmlspecialchars((string)$team['status_label'], ENT_QUOTES); ?>
                                    </span>
                                </td>
                                <td class="py-5 pr-8 text-right">
                                    <a href="<?= $team['detail_url']; ?>" class="btn btn-primary btn-xs font-black text-primary-content px-3 py-1.5 h-auto rounded-lg">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-10 text-center text-sm text-gray-400 font-medium">
                                <?php if ($search !== '' || $statusFilter !== ''): ?>
                                    Tidak ada tim yang cocok dengan kriteria pencarian.
                                <?php else: ?>
                                    Belum ada tim yang terdaftar.
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>