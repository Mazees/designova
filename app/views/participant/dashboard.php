<?php require_once '../app/views/layouts/header.php';

// Dapatkan data user & tim
$user = $_SESSION['user'] ?? null;
$team = $_SESSION['team'] ?? null;
$teamName = $team['team_name'] ?? 'Tim Anda';
$teamCategory = 'UI/UX Design'; // Kategori
$members = json_decode($team['members'] ?? '[]', true);
$isActive = (isset($team['is_active']) && $team['is_active'] == 1);
$hasSubmitted = !empty($submission);
?>

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
                        <?= htmlspecialchars($teamName); ?>
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
                        <li class="step <?= $hasSubmitted ? 'step-primary' : '' ?>">Pengumpulan Karya</li>
                        <li class="step">Proses Penilaian Juri</li>
                        <li class="step">Pengumuman Pemenang</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require_once '../app/views/layouts/header.php'; // Wait, layout uses footer.php at the end, but the original code had: require_once '../app/views/layouts/footer.php'; ?>
<?php require_once '../app/views/layouts/footer.php'; ?>