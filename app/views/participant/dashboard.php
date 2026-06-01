<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-6xl mx-auto space-y-8 pb-12">
    <!-- Hero Welcome Banner -->
    <div class="relative bg-neutral border border-base-200 text-base-content p-8 rounded-3xl">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6 space-y-2">
            <div class="space-y-2">
                <h2 class="text-3xl md:text-4xl font-black tracking-tight">
                    Hello, <?= htmlspecialchars($user['name'] ?? 'User'); ?>!
                </h2>
                <p class="text-sm text-base-content/75 max-w-xl italic leading-relaxed">
                    Selamat datang di Hub Peserta Designova. Kelola berkas tim, pantau proses penilaian, dan unduh
                    dokumen penting dalam satu dasbor.
                </p>
            </div>
        </div>
    </div>

    <?php if (isset($isWinnerPub) && $isWinnerPub): ?>
    <!-- Top 5 Winners Section -->
    <div class="card bg-base-100 border border-primary/20 shadow-sm shadow-primary/5 rounded-3xl" data-aos="fade-up">
        <div class="card-body p-8">
            <div class="text-center mb-6">
                <span class="badge badge-primary badge-sm font-black tracking-widest uppercase mb-2">Pengumuman Pemenang</span>
                <h3 class="text-3xl font-black text-neutral-content tracking-tight">Leaderboard Top 5</h3>
                <p class="text-xs text-gray-400 font-medium mt-2">Selamat kepada tim-tim terbaik! Terima kasih atas partisipasi Anda.</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-base-200 border-b border-base-300 text-gray-500 text-[10px] font-black uppercase tracking-wider">
                            <th class="py-4 pl-8 text-center w-16">Peringkat</th>
                            <th class="py-4">Nama Tim</th>
                            <th class="py-4 text-right pr-8">Skor Akhir</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200 text-xs font-semibold text-gray-700">
                        <?php if (!empty($topTeams)): ?>
                            <?php $rank = 1; foreach ($topTeams as $teamTop): ?>
                            <?php 
                                $badgeClass = match ($rank) {
                                    1 => 'badge-primary text-primary-content shadow-sm',
                                    2 => 'badge-secondary text-secondary-content shadow-sm',
                                    3 => 'badge-accent text-accent-content shadow-sm',
                                    default => 'bg-base-300 text-base-content/75 border-none'
                                };
                            ?>
                            <tr class="hover:bg-base-200/40 transition-colors">
                                <td class="py-4 pl-8 text-center">
                                    <div class="badge <?= $badgeClass; ?> font-black text-xs w-6 h-6 p-0 rounded-lg flex items-center justify-center">
                                        <?= $rank++; ?>
                                    </div>
                                </td>
                                <td class="py-4 font-extrabold text-neutral-content text-sm">
                                    <?= htmlspecialchars($teamTop['team_name'] ?? '-'); ?>
                                </td>
                                <td class="py-4 pr-8 text-right font-black text-primary">
                                    <?= number_format((float) ($teamTop['final_score'] ?? 0), 2); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="py-8 text-center text-gray-400">Belum ada data pemenang.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- LEFT COLUMN: Status & Anggota Tim (col-span-5) -->
        <div class="lg:col-span-5 space-y-2">

            <!-- Status Card -->
            <div
                class="card bg-base-100 border border-base-200/60 p-6 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="space-y-1">
                    <span class="text-xs text-muted block font-medium">Nama Tim</span>
                    <h3 class="card-title text-2xl font-black text-neutral-content leading-tight">
                        <?= htmlspecialchars(isset($teamName) ? $teamName : ''); ?>
                    </h3>
                </div>
            </div>

            <!-- Members Card -->
            <div
                class="card bg-base-100 border border-base-200/60 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="card-body p-6 gap-4">
                    <span class="text-[10px] font-black text-neutral-content uppercase tracking-widest block">Anggota
                        Tim</span>

                    <div class="space-y-4">
                        <!-- Ketua (Main User) -->
                        <div
                            class="flex items-center justify-between p-3 rounded-2xl hover:bg-base-200/50 transition-colors duration-200">
                            <div class="flex items-center space-x-3.5">
                                <div class="avatar placeholder">
                                    <div
                                        class="w-10 h-10 flex items-center justify-center rounded-full bg-primary text-white font-black text-sm">
                                        <?= strtoupper(substr($user['name'] ?? 'K', 0, 2)); ?>
                                    </div>
                                </div>
                                <div>
                                    <span
                                        class="text-xs font-bold text-base-content block"><?= htmlspecialchars($user['name'] ?? 'Ketua'); ?></span>
                                    <span class="text-[10px] text-muted font-semibold block">Email:
                                        <?= htmlspecialchars($user['email'] ?? '-'); ?></span>
                                </div>
                            </div>
                            <span
                                class="badge bg-primary text-primary-content font-black text-[9px] uppercase tracking-wider px-2 py-2">Ketua</span>
                        </div>

                        <!-- Anggota lainnya -->
                        <?php if (!empty($members)): ?>
                            <?php foreach ($members as $index => $member): ?>
                                <?php if (!empty(trim($member))): ?>
                                    <div
                                        class="flex items-center justify-between p-3 rounded-2xl hover:bg-base-200/50 transition-colors duration-200">
                                        <div class="flex items-center space-x-3.5">
                                            <div class="avatar placeholder">
                                                <div
                                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-primary text-white text-sm">
                                                    <?= strtoupper(substr($member ?: 'A', 0, 2)); ?>
                                                </div>
                                            </div>
                                            <div>
                                                <span
                                                    class="text-xs font-bold text-base-content block"><?= htmlspecialchars($member); ?></span>
                                                <span class="text-[10px] text-muted font-semibold block">Peserta Terdaftar</span>
                                            </div>
                                        </div>
                                        <span
                                            class="badge bg-base-200 text-base-content/70 border-base-350 font-black text-[9px] uppercase tracking-wider px-2 py-2">Anggota
                                            <?= $index + 1; ?></span>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Timeline, Downloads, News, Support (col-span-7) -->
        <div class="lg:col-span-7 space-y-6">

            <!-- Timeline Tracker -->
            <div class="card bg-base-100 border border-base-200/60 shadow-sm">
                <div class="card-body p-6 gap-6">
                    <span class="text-xl font-extrabold text-neutral-content uppercase">Progress Team</span>
                    <ul class="steps steps-vertical">
                        <li class="step step-primary">
                            Registrasi Akun & Tim</li>
                        <li class="step step-primary">Pembayaran & Aktivasi Tim</li>
                        <li class="step step-primary">
                            Pengumpulan
                            Karya</li>
                        <li class="step <?= (isset($hasSubmitted) ? $hasSubmitted : '') ? 'step-primary' : '' ?>">Proses Penilaian Juri</li>
                        <li class="step <?= (isset($isWinnerPub) && $isWinnerPub) ? 'step-primary' : '' ?>">Pengumuman Pemenang</li>
                    </ul>
                </div>
            </div>
            <!-- Status Penilaian & Submisi -->
            <?php if (!empty($hasSubmitted)): ?>
            <div class="card bg-base-100 border border-base-200/60 shadow-sm mt-6">
                <div class="card-body p-6 gap-5">
                    <span class="text-xl font-extrabold text-neutral-content uppercase">Status Penilaian</span>
                    
                    <div class="space-y-4 text-sm mt-1">
                        <!-- Status Badge -->
                        <div>
                            <div class="flex w-full items-center gap-2.5 px-4 py-2.5 rounded-lg border text-xs font-bold <?= !empty($classEvaluasi) ? $classEvaluasi : '' ?>">
                                <span class="w-2 h-2 rounded-full bg-current"></span>
                                <?= !empty($statusEvaluasi) ? $statusEvaluasi : '' ?>
                            </div>
                        </div>

                        <!-- Feedback -->
                        <div>
                            <div class="flex items-center gap-1.5 mb-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                <span class="block text-[11px] text-gray-400 font-bold uppercase tracking-wider">Feedback Juri</span>
                            </div>
                            <div class="bg-base-200/30 p-3 rounded-lg border border-base-200/60">
                                <p class="text-xs text-gray-500 leading-relaxed italic">
                                    "<?= !empty($feedbackText) ? htmlspecialchars($feedbackText) : '' ?>"
                                </p>
                            </div>
                        </div>

                        <!-- Last Updated -->
                        <div>
                            <div class="flex items-center gap-1.5 mb-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="block text-[11px] text-gray-400 font-bold uppercase tracking-wider">Terakhir Diperbarui</span>
                            </div>
                            <span class="text-xs font-semibold text-neutral-content block pl-5.5">
                                <?= !empty($submissionUpdatedAt) ? $submissionUpdatedAt : '' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>


</div>

<?php require_once '../app/views/layouts/header.php'; // Wait, layout uses footer.php at the end, but the original code had: require_once '../app/views/layouts/footer.php'; ?>
<?php require_once '../app/views/layouts/footer.php'; ?>