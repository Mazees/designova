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
    <div class="relative bg-accent text-white p-8 rounded-3xl">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-2">
                <div
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-primary/20 text-primary border border-primary/20 text-xs font-semibold tracking-wide">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                    Kompetisi Aktif
                </div>
                <h2 class="text-3xl md:text-4xl font-black tracking-tight">
                    Hello, <?= htmlspecialchars($user['name'] ?? 'User'); ?>!
                </h2>
                <p class="text-sm text-gray-300 max-w-xl italic leading-relaxed">
                    Selamat datang di Hub Peserta Designova. Kelola berkas tim, pantau proses penilaian, dan unduh
                    dokumen penting dalam satu dasbor.
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="tabs tabs-bordered w-full border-b border-base-300">
        <a href="<?= BASE_URL; ?>/dashboard"
            class="tab tab-active font-extrabold text-sm border-primary text-primary-content pb-3">Overview</a>
        <?php if (!$isActive): ?>
            <a href="<?= BASE_URL; ?>/payment" class="tab text-sm text-muted hover:text-base-content pb-3">Instruksi
                Pembayaran</a>
        <?php endif; ?>
        <a href="<?= BASE_URL; ?>/submission" class="tab text-sm text-muted hover:text-base-content pb-3">Pengumpulan
            Karya</a>
    </div>

    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- LEFT COLUMN: Status & Anggota Tim (col-span-5) -->
        <div class="lg:col-span-5 space-y-6">

            <!-- Status Card -->
            <div
                class="card bg-base-100 border border-base-200/60 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="card-body p-6 gap-5">
                    <div class="flex justify-between items-center">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Status
                            Pendaftaran</span>
                        <?php if ($isActive): ?>
                            <div
                                class="badge bg-success/15 border border-success/35 text-success font-black text-[10px] uppercase tracking-wider py-2.5 px-3.5">
                                Verified &amp; Aktif
                            </div>
                        <?php else: ?>
                            <div
                                class="badge bg-warning/15 border border-warning/35 text-warning font-black text-[10px] uppercase tracking-wider py-2.5 px-3.5">
                                Menunggu Verifikasi
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="space-y-1">
                        <span class="text-xs text-muted block font-medium">Nama Tim</span>
                        <h3 class="card-title text-2xl font-black text-neutral-content leading-tight">
                            <?= htmlspecialchars($teamName); ?>
                        </h3>
                    </div>

                    <div class="divider my-0 opacity-60"></div>

                    <div
                        class="flex items-center gap-3 p-3.5 rounded-2xl text-xs <?= $isActive ? 'bg-success/5 border border-success/10 text-success' : 'bg-warning/5 border border-warning/10 text-warning'; ?>">
                        <div class="shrink-0 rounded-lg p-2 <?= $isActive ? 'bg-success/10' : 'bg-warning/10'; ?>">
                            <?php if ($isActive): ?>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            <?php else: ?>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            <?php endif; ?>
                        </div>
                        <span class="font-semibold leading-relaxed">
                            <?= $isActive ? 'Pendaftaran tim terverifikasi! Silakan lanjut ke menu Pengumpulan Karya sebelum tenggat waktu selesai.' : 'Pembayaran Anda sedang dalam antrean verifikasi Admin. Harap selesaikan instruksi pembayaran.'; ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Members Card -->
            <div
                class="card bg-base-100 border border-base-200/60 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="card-body p-6 gap-4">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Anggota
                        Tim</span>

                    <div class="space-y-4">
                        <!-- Ketua (Main User) -->
                        <div
                            class="flex items-center justify-between p-3 rounded-2xl hover:bg-base-200/50 transition-colors duration-200">
                            <div class="flex items-center space-x-3.5">
                                <div class="avatar placeholder">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary/20 text-primary border border-primary/20 font-black text-sm">
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
                                                    class="w-10 h-10 rounded-full bg-base-200 text-base-content font-bold text-sm border border-base-300">
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
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Progress Timeline
                        Kompetisi</span>
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

            <!-- Download Resources & Documents -->
            <div class="card bg-base-100 border border-base-200/60 shadow-sm">
                <div class="card-body p-6 gap-4">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Resource &amp;
                        Dokumen Acuan</span>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Resource 1 -->
                        <div
                            class="flex items-center gap-3.5 p-3.5 border border-base-200 rounded-2xl hover:bg-base-200/40 hover:border-base-300 transition-all duration-200 group">
                            <div
                                class="shrink-0 w-10 h-10 rounded-xl bg-red-500/10 text-red-500 flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span
                                    class="text-xs font-extrabold text-base-content block truncate">Guidebook.pdf</span>
                                <span class="text-[9px] text-gray-400 block font-medium">Panduan Teknis Lomba</span>
                            </div>
                            <a href="#" class="btn btn-ghost btn-square btn-sm text-gray-400 hover:text-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </div>

                        <!-- Resource 2 -->
                        <div
                            class="flex items-center gap-3.5 p-3.5 border border-base-200 rounded-2xl hover:bg-base-200/40 hover:border-base-300 transition-all duration-200 group">
                            <div
                                class="shrink-0 w-10 h-10 rounded-xl bg-orange-500/10 text-orange-500 flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 12l3-3 3 3 4-4M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span
                                    class="text-xs font-extrabold text-base-content block truncate">Template_Pitch.ppt</span>
                                <span class="text-[9px] text-gray-400 block font-medium">Format Presentasi</span>
                            </div>
                            <a href="#" class="btn btn-ghost btn-square btn-sm text-gray-400 hover:text-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Papan Pengumuman -->
            <div class="card bg-base-100 border border-base-200/60 shadow-sm">
                <div class="card-body p-6 gap-4">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Informasi &amp;
                        Pengumuman Terbaru</span>

                    <div class="space-y-3.5">
                        <!-- Notice Item 1 -->
                        <div
                            class="p-3.5 rounded-2xl bg-base-200/50 hover:bg-base-200 transition-colors border border-base-200/30 flex gap-3.5 items-start">
                            <span
                                class="badge badge-error text-[8px] font-black uppercase tracking-wider py-1 px-1.5 mt-0.5 shrink-0">Penting</span>
                            <div class="space-y-1">
                                <p class="text-xs font-semibold text-base-content leading-relaxed">
                                    Batas akhir (deadline) pengumpulan karya ditetapkan pada <strong>24 November
                                        2023</strong> pukul 23:59 WIB. Tidak ada perpanjangan waktu otomatis.
                                </p>
                                <span class="text-[9px] text-gray-400 block font-medium">Diposting: 25 Mei 2026</span>
                            </div>
                        </div>

                        <!-- Notice Item 2 -->
                        <div
                            class="p-3.5 rounded-2xl bg-base-200/50 hover:bg-base-200 transition-colors border border-base-200/30 flex gap-3.5 items-start">
                            <span
                                class="badge badge-info text-[8px] font-black uppercase tracking-wider py-1 px-1.5 mt-0.5 shrink-0">Informasi</span>
                            <div class="space-y-1">
                                <p class="text-xs font-semibold text-base-content leading-relaxed">
                                    Pastikan link Figma Prototype dan Google Drive diatur ke mode publik agar Juri dapat
                                    mengakses karya Anda tanpa kendala saat penilaian.
                                </p>
                                <span class="text-[9px] text-gray-400 block font-medium">Diposting: 21 Mei 2026</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Helpdesk WhatsApp Admin -->
            <div class="card bg-gradient-to-r from-success/15 to-transparent border border-success/20 shadow-sm">
                <div class="card-body p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center space-x-3.5">
                        <div
                            class="w-11 h-11 rounded-full bg-success/20 text-success flex items-center justify-center shadow-inner">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.47L0 24zm5.706-3.8l.374.223c1.55.922 3.327 1.409 5.167 1.411 5.485 0 9.948-4.464 9.952-9.953.002-2.66-1.033-5.16-2.91-7.04C16.47 2.96 13.97 1.92 11.999 1.92c-5.498 0-9.96 4.46-9.964 9.949-.002 1.916.501 3.791 1.458 5.408l.254.432-.975 3.562 3.65-.957z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-extrabold text-base-content block">Butuh bantuan Admin?</span>
                            <span class="text-[10px] text-gray-500 block font-medium mt-0.5">Hubungi kami via WhatsApp
                                jika mengalami kendala sistem atau pendaftaran.</span>
                        </div>
                    </div>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Designova,%20saya%20mengalami%20kendala%20pada%20dashboard%20peserta."
                        target="_blank"
                        class="btn btn-success text-white font-extrabold text-xs px-5 py-2.5 rounded-xl shrink-0 gap-2 hover:scale-[1.02] transition-transform duration-200">
                        Chat WhatsApp
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>

<?php require_once '../app/views/layouts/header.php'; // Wait, layout uses footer.php at the end, but the original code had: require_once '../app/views/layouts/footer.php'; ?>
<?php require_once '../app/views/layouts/footer.php'; ?>