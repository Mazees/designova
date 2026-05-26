<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-5xl mx-auto space-y-8 pb-12" data-aos="fade-up">
    <!-- Header -->
    <div class="space-y-2">
        <h2 class="text-3xl font-black text-neutral-content tracking-tight">Manajemen Peserta</h2>
        <p class="text-xs text-gray-400 font-medium max-w-2xl leading-relaxed">
            Verifikasi manual klaim pembayaran pendaftaran tim peserta untuk mengaktifkan akses dashboard mereka.
        </p>
    </div>

    <!-- Navigation Tabs -->
    <div class="tabs tabs-bordered w-full border-b border-base-300">
        <a href="<?= BASE_URL; ?>/admin/dashboard" 
           class="tab text-sm text-muted hover:text-base-content pb-3">Statistik Global</a>
        <a href="<?= BASE_URL; ?>/admin/teams" 
           class="tab tab-active font-extrabold text-sm border-primary text-primary-content pb-3">Manajemen Peserta</a>
        <a href="<?= BASE_URL; ?>/admin/leaderboard" 
           class="tab text-sm text-muted hover:text-base-content pb-3">Papan Peringkat</a>
        <a href="<?= BASE_URL; ?>/admin/settings" 
           class="tab text-sm text-muted hover:text-base-content pb-3">Konfigurasi Sistem</a>
    </div>

    <!-- Search & Filter Area -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <!-- Search bar -->
        <div class="join max-w-sm w-full">
            <input class="input input-bordered join-item text-xs h-10 w-full font-medium focus:outline-none focus:border-primary"
                   placeholder="Cari nama tim atau ketua..." />
            <button class="btn btn-primary join-item text-xs h-10 text-primary-content font-bold px-5">Cari</button>
        </div>

        <!-- Filter Dropdown -->
        <select class="select select-bordered text-xs h-10 font-bold max-w-xs rounded-xl bg-base-100 focus:outline-none focus:border-primary">
            <option disabled selected>Filter Status</option>
            <option>Semua Status</option>
            <option>Verified &amp; Aktif</option>
            <option>Menunggu Verifikasi</option>
        </select>
    </div>

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
                        <th class="py-4 pr-8 text-right">Verifikasi Manual</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-base-200 text-xs font-semibold text-gray-700">
                    <!-- Row 1 -->
                    <tr class="hover:bg-base-200/40 transition-colors">
                        <td class="py-5 pl-8">
                            <div class="flex items-center space-x-3">
                                <div class="avatar placeholder">
                                    <div class="w-8 h-8 rounded-xl bg-primary/10 text-primary font-black text-xs flex items-center justify-center">
                                        PP
                                    </div>
                                </div>
                                <span class="font-extrabold text-neutral-content text-sm">Pixel Pioneers</span>
                            </div>
                        </td>
                        <td class="py-5 text-gray-500 font-medium">john.doe@gmail.com</td>
                        <td class="py-5 text-gray-400 font-mono">23 Nov 2023 14:02</td>
                        <td class="py-5">
                            <span class="badge bg-warning/15 border border-warning/35 text-warning font-black text-[9px] uppercase tracking-wider py-2.5 px-3">
                                Menunggu Verifikasi
                            </span>
                        </td>
                        <td class="py-5 pr-8 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="btn btn-success btn-xs font-black text-white px-3 py-1.5 h-auto rounded-lg">Approve</button>
                                <button class="btn btn-error btn-xs font-black text-white px-3 py-1.5 h-auto rounded-lg">Reject</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-base-200/40 transition-colors">
                        <td class="py-5 pl-8">
                            <div class="flex items-center space-x-3">
                                <div class="avatar placeholder">
                                    <div class="w-8 h-8 rounded-xl bg-primary/10 text-primary font-black text-xs flex items-center justify-center">
                                        BI
                                    </div>
                                </div>
                                <span class="font-extrabold text-neutral-content text-sm">Beta Innovators</span>
                            </div>
                        </td>
                        <td class="py-5 text-gray-500 font-medium">jane.smith@gmail.com</td>
                        <td class="py-5 text-gray-400 font-mono">22 Nov 2023 09:41</td>
                        <td class="py-5">
                            <span class="badge bg-success/15 border border-success/35 text-success font-black text-[9px] uppercase tracking-wider py-2.5 px-3">
                                Verified &amp; Aktif
                            </span>
                        </td>
                        <td class="py-5 pr-8 text-right">
                            <span class="text-xs text-gray-400 font-bold">Terverifikasi</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>