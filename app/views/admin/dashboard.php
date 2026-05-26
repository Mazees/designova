<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-5xl mx-auto space-y-8 pb-12" data-aos="fade-up">
    <!-- Header -->
    <div class="space-y-2">
        <h2 class="text-3xl font-black text-neutral-content tracking-tight">Statistik Global</h2>
        <p class="text-xs text-gray-400 font-medium max-w-2xl leading-relaxed">
            Pantau progres pendaftaran, status verifikasi pembayaran, dan perkembangan penilaian karya oleh dewan juri secara real-time.
        </p>
    </div>

    <!-- Navigation Tabs -->
    <div class="tabs tabs-bordered w-full border-b border-base-300">
        <a href="<?= BASE_URL; ?>/admin/dashboard" 
           class="tab tab-active font-extrabold text-sm border-primary text-primary-content pb-3">Statistik Global</a>
        <a href="<?= BASE_URL; ?>/admin/teams" 
           class="tab text-sm text-muted hover:text-base-content pb-3">Manajemen Peserta</a>
        <a href="<?= BASE_URL; ?>/admin/leaderboard" 
           class="tab text-sm text-muted hover:text-base-content pb-3">Papan Peringkat</a>
        <a href="<?= BASE_URL; ?>/admin/settings" 
           class="tab text-sm text-muted hover:text-base-content pb-3">Konfigurasi Sistem</a>
    </div>

    <!-- Metrik Grid using DaisyUI Stats Component -->
    <div class="stats stats-vertical lg:stats-horizontal border border-base-200 w-full bg-base-100 rounded-3xl shadow-sm">
        
        <!-- Stat 1: Total Tim -->
        <div class="stat p-6 flex items-center justify-between gap-4 border-base-200">
            <div class="space-y-1">
                <span class="stat-title text-[10px] font-black uppercase tracking-wider text-gray-400">Total Tim Terdaftar</span>
                <div class="stat-value text-accent text-3xl font-black">12</div>
                <span class="stat-desc text-[10px] text-gray-450 font-medium">Aktif &amp; Menunggu Verifikasi</span>
            </div>
            <div class="shrink-0 w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>

        <!-- Stat 2: Karya Terkumpul -->
        <div class="stat p-6 flex items-center justify-between gap-4 border-base-200">
            <div class="space-y-1">
                <span class="stat-title text-[10px] font-black uppercase tracking-wider text-gray-400">Karya Terkumpul</span>
                <div class="stat-value text-success text-3xl font-black">8</div>
                <span class="stat-desc text-[10px] text-gray-450 font-medium">Tim yang telah mengirim karya</span>
            </div>
            <div class="shrink-0 w-12 h-12 rounded-2xl bg-success/10 text-success flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>

        <!-- Stat 3: Progres Penilaian -->
        <div class="stat p-6 flex items-center justify-between gap-4 border-base-200">
            <div class="space-y-1">
                <span class="stat-title text-[10px] font-black uppercase tracking-wider text-gray-400">Progres Penilaian</span>
                <div class="stat-value text-info text-3xl font-black">66%</div>
                <span class="stat-desc text-[10px] text-gray-450 font-medium">Berdasarkan ulasan dewan juri</span>
            </div>
            <div class="shrink-0 w-12 h-12 rounded-2xl bg-info/10 text-info flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
        </div>

    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>