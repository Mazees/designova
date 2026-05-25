<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-5xl mx-auto space-y-8">
    <!-- Header -->
    <div class="space-y-1">
        <h2 class="text-3xl font-extrabold text-neutral-content tracking-tight">Dashboard Admin: Statistik Global</h2>
        <p class="text-xs text-gray-400 font-medium">Pantau progres pendaftaran, pembayaran, dan penilaian karya secara
            langsung.</p>
    </div>

    <!-- Navigation Tabs -->
    <div class="tabs tabs-bordered w-full">
        <a href="<?= BASE_URL; ?>/admin/dashboard"
            class="tab tab-active font-bold border-primary text-primary-content">Statistik Global</a>
        <a href="<?= BASE_URL; ?>/admin/teams" class="tab text-gray-450 hover:text-gray-700">Manajemen Peserta</a>
        <a href="<?= BASE_URL; ?>/admin/leaderboard" class="tab text-gray-450 hover:text-gray-700">Papan Peringkat</a>
        <a href="<?= BASE_URL; ?>/admin/settings" class="tab text-gray-450 hover:text-gray-700">Konfigurasi Sistem</a>
    </div>

    <!-- Metrik Grid using DaisyUI Stats Component -->
    <div class="stats stats-vertical sm:stats-horizontal shadow border border-base-200 w-full bg-base-100 rounded-3xl">
        <!-- Stat 1 -->
        <div class="stat p-6 text-center sm:text-left">
            <div class="stat-title text-[10px] font-bold uppercase tracking-wider text-gray-450">Total Tim Terdaftar
            </div>
            <div class="stat-value text-primary-content text-4xl font-black mt-1">12</div>
            <div class="stat-desc mt-1">Tim terdaftar aktif & pending</div>
        </div>

        <!-- Stat 2 -->
        <div class="stat p-6 text-center sm:text-left">
            <div class="stat-title text-[10px] font-bold uppercase tracking-wider text-gray-450">Karya Terkumpul</div>
            <div class="stat-value text-success text-4xl font-black mt-1">8</div>
            <div class="stat-desc mt-1">8 tim sudah upload link karya</div>
        </div>

        <!-- Stat 3 -->
        <div class="stat p-6 text-center sm:text-left">
            <div class="stat-title text-[10px] font-bold uppercase tracking-wider text-gray-450">Progres Penilaian</div>
            <div class="stat-value text-info text-4xl font-black mt-1">66%</div>
            <div class="stat-desc mt-1">Juri sedang menilai karya</div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>