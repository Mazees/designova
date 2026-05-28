<?php require_once '../app/views/layouts/header.php'; ?>

<?php
$team = $team ?? null;
$members = $members ?? [];
?>

<div class="max-w-3xl mx-auto space-y-8 pb-12" data-aos="fade-up">
    <!-- Back Link & Header -->
    <div class="space-y-4">
        <div>
            <a href="<?= BASE_URL; ?>/admin/teams" class="inline-flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-primary transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Manajemen Peserta
            </a>
        </div>
        
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
            <div class="space-y-1">
                <h2 class="text-3xl font-black text-neutral-content tracking-tight">Detail Tim</h2>
                <p class="text-xs text-gray-400 font-medium">Informasi pendaftaran, data anggota, dan kontrol aktivasi akun tim.</p>
            </div>
            <div>
                <span class="badge <?= !empty($team['is_active']) ? 'bg-success/15 border border-success/35 text-success' : 'bg-warning/15 border border-warning/35 text-warning'; ?> font-black text-[10px] uppercase tracking-wider py-3 px-4 rounded-xl">
                    <?= !empty($team['is_active']) ? 'Verified &amp; Aktif' : 'Menunggu Verifikasi'; ?>
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Info Card & Status Toggle -->
        <div class="md:col-span-2 space-y-6">
            <!-- Main Info Card -->
            <div class="card bg-base-100 border border-base-200 shadow-sm rounded-2xl">
                <div class="card-body p-6 gap-6">
                    <h3 class="card-title text-sm font-black text-neutral-content uppercase tracking-wider border-b border-base-200 pb-3">Profil Tim</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <span class="text-[9px] font-black text-gray-450 uppercase tracking-widest block">Nama Tim</span>
                            <span class="text-sm font-extrabold text-neutral-content block mt-1"><?= htmlspecialchars((string) ($team['team_name'] ?? '-'), ENT_QUOTES); ?></span>
                        </div>
                        <div>
                            <span class="text-[9px] font-black text-gray-450 uppercase tracking-widest block">ID Tim</span>
                            <span class="text-xs font-mono text-gray-400 block mt-1"><?= htmlspecialchars((string) ($team['id'] ?? '-'), ENT_QUOTES); ?></span>
                        </div>
                        <div>
                            <span class="text-[9px] font-black text-gray-450 uppercase tracking-widest block">Nama Ketua</span>
                            <span class="text-sm font-bold text-neutral-content block mt-1"><?= htmlspecialchars((string) ($team['leader_name'] ?? '-'), ENT_QUOTES); ?></span>
                        </div>
                        <div>
                            <span class="text-[9px] font-black text-gray-450 uppercase tracking-widest block">Email Ketua</span>
                            <span class="text-xs font-medium text-gray-400 block mt-1"><?= htmlspecialchars((string) ($team['leader_email'] ?? '-'), ENT_QUOTES); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Controller Card -->
            <div class="card bg-base-100 border border-base-200 shadow-sm rounded-2xl overflow-hidden">
                <div class="card-body p-6">
                    <h3 class="card-title text-sm font-black text-neutral-content uppercase tracking-wider border-b border-base-200 pb-3 mb-4">Kontrol Status Akun</h3>
                    <form method="POST" action="" class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-base-200/50 p-4 rounded-xl border border-base-200">
                        <div class="space-y-0.5">
                            <span class="text-xs font-extrabold text-neutral-content block">Aktivasi Akun Peserta</span>
                            <span class="text-[10px] text-gray-450 font-medium block">Mengaktifkan status akun untuk memberikan akses pendaftaran penuh.</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" 
                                   name="is_active" 
                                   value="1" 
                                   class="toggle toggle-primary toggle-sm sm:toggle-md"
                                   onchange="this.form.submit()" 
                                   <?= !empty($team['is_active']) ? 'checked' : ''; ?>>
                            <span class="text-xs font-black uppercase tracking-wider <?= !empty($team['is_active']) ? 'text-success' : 'text-warning'; ?>">
                                <?= !empty($team['is_active']) ? 'Aktif' : 'Nonaktif'; ?>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Members List Card -->
        <div class="md:col-span-1">
            <div class="card bg-base-100 border border-base-200 shadow-sm rounded-2xl h-full">
                <div class="card-body p-6 gap-5">
                    <h3 class="card-title text-sm font-black text-neutral-content uppercase tracking-wider border-b border-base-200 pb-3">Anggota Tim</h3>
                    
                    <div class="space-y-4">
                        <!-- Leader -->
                        <div class="flex items-center space-x-3 bg-base-200/40 p-2.5 rounded-xl border border-base-200/30">
                            <div class="avatar placeholder">
                                <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary font-black text-xs flex items-center justify-center">
                                    <?= htmlspecialchars(strtoupper(substr($team['leader_name'] ?? 'K', 0, 2)), ENT_QUOTES); ?>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-xs font-extrabold text-neutral-content block truncate"><?= htmlspecialchars((string) ($team['leader_name'] ?? '-'), ENT_QUOTES); ?></span>
                                <span class="text-[9px] text-primary font-bold uppercase tracking-wider block mt-0.5">Ketua Tim</span>
                            </div>
                        </div>

                        <!-- Members -->
                        <?php if (!empty($members)): ?>
                            <?php foreach ($members as $index => $member): ?>
                                <?php if (trim((string)$member) !== ''): ?>
                                    <div class="flex items-center space-x-3 p-2.5">
                                        <div class="avatar placeholder">
                                            <div class="w-8 h-8 rounded-lg bg-base-200 text-gray-400 font-bold text-xs flex items-center justify-center">
                                                <?= htmlspecialchars(strtoupper(substr($member, 0, 2)), ENT_QUOTES); ?>
                                            </div>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <span class="text-xs font-bold text-neutral-content block truncate"><?= htmlspecialchars((string) $member, ENT_QUOTES); ?></span>
                                            <span class="text-[9px] text-gray-400 font-semibold block mt-0.5">Anggota <?= $index + 1; ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="text-[11px] text-gray-450 font-medium block text-center py-4">Tidak ada anggota tambahan.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
