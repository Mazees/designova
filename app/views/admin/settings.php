<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-5xl mx-auto space-y-8">
    <!-- Header -->
    <div class="space-y-1">
        <h2 class="text-3xl font-extrabold text-neutral-content tracking-tight">Konfigurasi Sistem</h2>
        <p class="text-xs text-gray-400 font-medium">Atur variabel event global mulai dari deadline, status registrasi,
            harga tiket, dan rilis pemenang.</p>
    </div>

    <!-- Navigation Tabs -->
    <div class="tabs tabs-bordered w-full">
        <a href="<?= BASE_URL; ?>/admin/dashboard" class="tab text-gray-450 hover:text-gray-700">Statistik Global</a>
        <a href="<?= BASE_URL; ?>/admin/teams" class="tab text-gray-450 hover:text-gray-700">Manajemen Peserta</a>
        <a href="<?= BASE_URL; ?>/admin/leaderboard" class="tab text-gray-450 hover:text-gray-700">Papan Peringkat</a>
        <a href="<?= BASE_URL; ?>/admin/settings"
            class="tab tab-active font-bold border-primary text-primary-content">Konfigurasi Sistem</a>
    </div>

    <!-- Configuration Card -->
    <div class="card bg-base-100 border border-base-200 shadow-md">
        <div class="card-body p-6 sm:p-8 gap-6">
            <h3
                class="card-title text-sm font-black text-neutral-content uppercase tracking-wider border-b border-base-200 pb-3">
                Variabel Kontrol Event</h3>

            <form method="post" action="" class="space-y-6">
                <!-- Registration Toggle & Base Price Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Toggle Registration Open -->
                    <div
                        class="form-control bg-base-200 p-4 rounded-xl border border-base-300 flex-row justify-between items-center gap-0">
                        <div>
                            <span class="label-text font-bold text-xs text-gray-750 block">Status Registrasi</span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Aktifkan pendaftaran untuk tim baru</span>
                        </div>
                        <input type="checkbox" checked class="toggle toggle-primary" name="is_registration_open" />
                    </div>

                    <!-- Toggle Publish Winners -->
                    <div
                        class="form-control bg-base-200 p-4 rounded-xl border border-base-300 flex-row justify-between items-center gap-0">
                        <div>
                            <span class="label-text font-bold text-xs text-gray-750 block">Publikasikan Juara</span>
                            <span class="text-[10px] text-gray-400 mt-0.5">Tampilkan papan pemenang di landing
                                page</span>
                        </div>
                        <input type="checkbox" class="toggle toggle-primary" name="is_winner_published" />
                    </div>
                </div>

                <!-- Input Price & Date Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Input Harga Dasar -->
                    <div class="form-control w-full gap-1">
                        <label class="label py-0">
                            <span class="label-text font-bold text-[10px] uppercase text-gray-500">Harga Tiket
                                Pendaftaran Dasar</span>
                        </label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-4 text-xs font-bold text-gray-400">Rp</span>
                            <input type="number" required name="base_price" value="50000"
                                class="input input-bordered w-full text-xs h-10 pl-10 font-medium"
                                placeholder="50000" />
                        </div>
                    </div>

                    <!-- Input Deadline Pengumpulan -->
                    <div class="form-control w-full gap-1">
                        <label class="label py-0">
                            <span class="label-text font-bold text-[10px] uppercase text-gray-500">Batas Waktu
                                Pengumpulan Karya</span>
                        </label>
                        <input type="datetime-local" required name="submission_deadline" value="2023-11-24T23:59"
                            class="input input-bordered w-full text-xs h-10 font-medium" />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-2 border-t border-base-200">
                    <button type="submit" class="btn btn-primary text-xs h-10 px-6 font-extrabold text-primary-content">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>