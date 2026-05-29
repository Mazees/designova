<?php require_once '../app/views/layouts/header.php'; 

$settingModel = new Setting();
$settings = $settingModel->getSystemSettings();
$basePrice = $settings['base_price'] ?? 50000;
$deadline = $settings['submission_deadline'] ?? '2023-11-24 23:59:59';
$deadlineFormatted = date('Y-m-d\TH:i', strtotime($deadline));
$isRegOpen = (!isset($settings['is_registration_open']) || $settings['is_registration_open'] == 1); // default open
$isWinnerPub = (isset($settings['is_winner_published']) && $settings['is_winner_published'] == 1);
?>

<div class="max-w-5xl mx-auto space-y-8 pb-12" data-aos="fade-up">
    <!-- Header -->
    <div class="space-y-2">
        <h2 class="text-3xl font-black text-neutral-content tracking-tight">Konfigurasi Sistem</h2>
        <p class="text-xs text-gray-400 font-medium max-w-2xl leading-relaxed">
            Atur variabel event global mulai dari deadline pengumpulan karya, status registrasi tim baru, harga pendaftaran, dan pengumuman pemenang.
        </p>
    </div>

    <!-- Alerts -->
    <?php if (!empty($success)): ?>
        <div class="alert alert-success rounded-xl text-xs font-semibold shadow-sm" data-aos="fade-down">
            <svg class="w-5 h-5 shrink-0 text-success-content" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-success-content"><?= htmlspecialchars($success); ?></span>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-error rounded-xl text-xs font-semibold shadow-sm" data-aos="shake">
            <svg class="w-5 h-5 shrink-0 text-error-content" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span class="text-error-content"><?= htmlspecialchars($error); ?></span>
        </div>
    <?php endif; ?>

    <!-- Configuration Card -->
    <div class="card bg-base-100 border border-base-200 shadow-sm rounded-2xl">
        <div class="card-body p-6 sm:p-8 gap-6">
            <h3 class="card-title text-sm font-black text-neutral-content uppercase tracking-wider border-b border-base-200 pb-3.5">
                Variabel Kontrol Event
            </h3>

            <form method="post" action="<?= BASE_URL . "/admin/settings" ?>" class="space-y-6">
                <!-- Registration Toggle & Base Price Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Toggle Registration Open -->
                    <div class="form-control bg-base-200/50 p-4 rounded-xl border border-base-200 flex flex-row justify-between items-center">
                        <div class="space-y-0.5">
                            <span class="label-text font-extrabold text-xs text-neutral-content block">Status Registrasi</span>
                            <span class="text-[10px] text-gray-400 font-medium block">Aktifkan pendaftaran untuk tim baru</span>
                        </div>
                        <input type="checkbox" <?= $isRegOpen ? 'checked' : ''; ?> class="toggle toggle-primary" name="is_registration_open" />
                    </div>

                    <!-- Toggle Publish Winners -->
                    <div class="form-control bg-base-200/50 p-4 rounded-xl border border-base-200 flex flex-row justify-between items-center">
                        <div class="space-y-0.5">
                            <span class="label-text font-extrabold text-xs text-neutral-content block">Publikasikan Juara</span>
                            <span class="text-[10px] text-gray-400 font-medium block">Tampilkan papan pemenang di landing page</span>
                        </div>
                        <input type="checkbox" <?= $isWinnerPub ? 'checked' : ''; ?> class="toggle toggle-primary" name="is_winner_published" />
                    </div>
                </div>

                <!-- Input Price & Date Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Input Harga Dasar -->
                    <div class="form-control w-full gap-2">
                        <label class="label py-0">
                            <span class="label-text font-black text-xs uppercase text-gray-500 tracking-wider">Harga Tiket Pendaftaran Dasar</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-xs font-black text-gray-450">Rp</span>
                            <input type="number" required name="base_price" value="<?= htmlspecialchars($basePrice); ?>"
                                   class="input input-bordered w-full text-xs h-12 pl-11 font-medium bg-base-200/30 focus:outline-none focus:border-primary rounded-xl"
                                   placeholder="50000" />
                        </div>
                    </div>

                    <!-- Input Deadline Pengumpulan -->
                    <div class="form-control w-full gap-2">
                        <label class="label py-0">
                            <span class="label-text font-black text-xs uppercase text-gray-500 tracking-wider">Batas Waktu Pengumpulan Karya</span>
                        </label>
                        <input type="datetime-local" required name="submission_deadline" value="<?= $deadlineFormatted; ?>"
                               class="input input-bordered w-full text-xs h-12 font-medium bg-base-200/30 focus:outline-none focus:border-primary rounded-xl" />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-5 border-t border-base-200">
                    <button type="submit" class="btn btn-primary text-xs h-10 px-6 font-extrabold text-primary-content rounded-xl shadow-sm shadow-primary/20 hover:scale-[1.02] transition-transform duration-200">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>