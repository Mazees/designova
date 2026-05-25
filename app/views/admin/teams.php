<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-5xl mx-auto space-y-8">
    <!-- Header -->
    <div class="space-y-1">
        <h2 class="text-3xl font-extrabold text-neutral-content tracking-tight">Manajemen Peserta</h2>
        <p class="text-xs text-gray-400 font-medium">Verifikasi klaim pembayaran pendaftaran tim peserta secara manual.
        </p>
    </div>

    <!-- Navigation Tabs -->
    <div class="tabs tabs-bordered w-full">
        <a href="<?= BASE_URL; ?>/admin/dashboard" class="tab text-gray-450 hover:text-gray-700">Statistik Global</a>
        <a href="<?= BASE_URL; ?>/admin/teams"
            class="tab tab-active font-bold border-primary text-primary-content">Manajemen Peserta</a>
        <a href="<?= BASE_URL; ?>/admin/leaderboard" class="tab text-gray-450 hover:text-gray-700">Papan Peringkat</a>
        <a href="<?= BASE_URL; ?>/admin/settings" class="tab text-gray-450 hover:text-gray-700">Konfigurasi Sistem</a>
    </div>

    <!-- Search & Filter Area -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div class="join max-w-sm w-full">
            <input class="input input-bordered join-item text-xs h-10 w-full font-medium"
                placeholder="Cari nama tim atau ketua..." />
            <button class="btn btn-primary join-item text-xs h-10 text-primary-content font-bold px-5">Cari</button>
        </div>

        <select class="select select-bordered text-xs h-10 font-bold max-w-xs rounded-xl bg-base-100">
            <option disabled selected>Filter Status</option>
            <option>Semua Status</option>
            <option>Verified & Aktif</option>
            <option>Menunggu Verifikasi</option>
        </select>
    </div>

    <!-- Table Card -->
    <div class="card bg-base-100 border border-base-200 shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <!-- head -->
                <thead>
                    <tr
                        class="bg-base-200 border-b border-base-300 text-gray-500 text-[10px] font-bold uppercase tracking-wider">
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
                            <div class="flex items-center space-x-3.5">
                                <div class="avatar placeholder">
                                    <div class="w-8 h-8 rounded-full bg-base-200 text-gray-550 font-black text-xs">PP
                                    </div>
                                </div>
                                <span class="font-extrabold text-neutral-content text-sm">Pixel Pioneers</span>
                            </div>
                        </td>
                        <td class="py-5 text-gray-500">john.doe@gmail.com</td>
                        <td class="py-5 text-gray-450 font-mono">23 Nov 2023 14:02</td>
                        <td class="py-5">
                            <div
                                class="badge badge-warning text-white font-bold text-[9px] py-2 px-3 uppercase tracking-wide">
                                Menunggu Verifikasi</div>
                        </td>
                        <td class="py-5 pr-8 text-right gap-2 flex justify-end">
                            <button
                                class="btn btn-success btn-xs font-extrabold text-white px-3 py-1 h-auto">Approve</button>
                            <button
                                class="btn btn-error btn-xs font-extrabold text-white px-3 py-1 h-auto">Reject</button>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-base-200/40 transition-colors">
                        <td class="py-5 pl-8">
                            <div class="flex items-center space-x-3.5">
                                <div class="avatar placeholder">
                                    <div class="w-8 h-8 rounded-full bg-base-200 text-gray-550 font-black text-xs">BI
                                    </div>
                                </div>
                                <span class="font-extrabold text-neutral-content text-sm">Beta Innovators</span>
                            </div>
                        </td>
                        <td class="py-5 text-gray-500">jane.smith@gmail.com</td>
                        <td class="py-5 text-gray-450 font-mono">22 Nov 2023 09:41</td>
                        <td class="py-5">
                            <div
                                class="badge badge-success text-white font-bold text-[9px] py-2 px-3 uppercase tracking-wide">
                                Verified & Aktif</div>
                        </td>
                        <td class="py-5 pr-8 text-right gap-2 flex justify-end">
                            <span class="text-xs text-gray-400 font-bold">Terverifikasi</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>