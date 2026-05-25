<?php require_once '../app/views/layouts/header.php';

$team = $_SESSION['team'] ?? null;
$teamName = $team['team_name'] ?? 'Tim Anda';
$isActive = (isset($team['is_active']) && $team['is_active'] == 1);
$hasSubmitted = ($submission !== null);

// Ambil deadline dari database settings
$settingModel = new Setting();
$settings = $settingModel->getSystemSettings();
$deadline = $settings['submission_deadline'] ?? '2023-11-24 23:59:59';

// Hitung sisa waktu dinamis
$deadlineTime = strtotime($deadline);
$now = time();
$diff = $deadlineTime - $now;
if ($diff > 0) {
    $daysRemaining = ceil($diff / (60 * 60 * 24));
    $remainingText = $daysRemaining . " Hari Tersisa";
    $remainingClass = "text-amber-500 bg-amber-500/10 border-amber-500/20";
    if ($daysRemaining <= 2) {
        $remainingClass = "text-error bg-error/10 border-error/20 animate-pulse";
    }
} else {
    $remainingText = "Tenggat Waktu Habis";
    $remainingClass = "text-error bg-error/10 border-error/20 font-black";
}
$formattedDeadline = date('d M Y - H:i', $deadlineTime) . ' WIB';
?>

<div class="max-w-6xl mx-auto space-y-8 pb-12">
    <!-- Header -->
    <div class="space-y-3">
        <div class="flex flex-wrap items-center gap-3">
            <div class="badge bg-success/15 border border-success/35 text-success font-black text-[10px] uppercase tracking-wider py-2.5 px-3.5">
                Verified &amp; Siap Tempur
            </div>
            <?php if ($hasSubmitted): ?>
                <div class="badge bg-info/15 border border-info/35 text-info font-black text-[10px] uppercase tracking-wider py-2.5 px-3.5">
                    Karya Dikirim
                </div>
            <?php endif; ?>
        </div>
        <h2 class="text-3xl md:text-4xl font-black tracking-tight text-neutral-content">Submit Your Work</h2>
        <p class="text-xs text-gray-400 font-medium max-w-2xl leading-relaxed">
            Kumpulkan karya terbaik tim Anda di sini. Pastikan tautan Figma Prototype dan Google Drive Anda dapat diakses secara publik sebelum menekan tombol kirim.
        </p>
    </div>

    <!-- Navigation Tabs -->
    <div class="tabs tabs-bordered w-full border-b border-base-300">
        <a href="<?= BASE_URL; ?>/dashboard" class="tab text-sm text-muted hover:text-base-content pb-3">Overview</a>
        <?php if (!$isActive): ?>
            <a href="<?= BASE_URL; ?>/payment" class="tab text-sm text-muted hover:text-base-content pb-3">Instruksi Pembayaran</a>
        <?php endif; ?>
        <a href="<?= BASE_URL; ?>/submission"
            class="tab tab-active font-extrabold text-sm border-primary text-primary-content pb-3">Pengumpulan Karya</a>
    </div>

    <!-- Feedback Alerts -->
    <?php if (!empty($success)): ?>
        <div class="alert alert-success text-xs font-semibold p-4 rounded-2xl flex items-start gap-3.5 border border-success/20 bg-success/5 text-success">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span><?= htmlspecialchars($success); ?></span>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-error text-xs font-semibold p-4 rounded-2xl flex items-start gap-3.5 border border-error/20 bg-error/5 text-error">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span><?= htmlspecialchars($error); ?></span>
        </div>
    <?php endif; ?>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left: Submission Form (col-span-8) -->
        <div class="lg:col-span-8 card bg-base-100 border border-base-200/60 shadow-sm">
            <div class="card-body p-6 sm:p-8 gap-6">
                
                <?php if ($hasSubmitted): ?>
                    <!-- Success status banner inside card -->
                    <div class="flex items-center gap-4 p-4 border border-success/15 bg-success/5 rounded-2xl">
                        <div class="w-10 h-10 rounded-full bg-success/20 text-success flex items-center justify-center shadow-inner shrink-0">
                            <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-black text-success block">Karya Berhasil Dikumpulkan</span>
                            <span class="text-[10px] text-gray-500 block font-medium mt-0.5">Tautan karya Anda sudah terdaftar di sistem. Anda tetap dapat mengedit/memperbarui tautan sebelum batas waktu berakhir.</span>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL; ?>/submission" class="space-y-6">
                    <!-- Figma Link -->
                    <div class="form-control w-full gap-2">
                        <label class="label py-0 flex items-center space-x-2">
                            <!-- Figma Icon -->
                            <svg class="w-5 h-5 text-orange-500 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                            </svg>
                            <span class="label-text font-black text-xs uppercase text-gray-500 tracking-wider">Link Figma Prototype</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </span>
                            <input type="url" required name="figma_link"
                                value="<?= htmlspecialchars($submission['figma_link'] ?? ''); ?>"
                                class="input input-bordered w-full pl-11 text-xs h-12 font-medium bg-base-200/40 border-base-300 focus:border-primary/80 focus:ring-1 focus:ring-primary/40 rounded-xl"
                                placeholder="https://www.figma.com/proto/..." />
                        </div>
                    </div>

                    <!-- Google Drive Link -->
                    <div class="form-control w-full gap-2">
                        <label class="label py-0 flex items-center space-x-2">
                            <!-- Google Drive Icon -->
                            <svg class="w-5 h-5 text-blue-500 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM19 18H6c-2.21 0-4-1.79-4-4 0-2.05 1.53-3.76 3.56-3.97l1.07-.11.5-.95C8.08 7.14 9.94 6 12 6c2.62 0 4.88 1.86 5.39 4.43l.3 1.5 1.53.11c1.56.1 2.78 1.41 2.78 2.96 0 1.65-1.35 3-3 3z" />
                            </svg>
                            <span class="label-text font-black text-xs uppercase text-gray-500 tracking-wider">Link Google Drive (Folder Aset/PDF)</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </span>
                            <input type="url" required name="docs_link"
                                value="<?= htmlspecialchars($submission['docs_link'] ?? ''); ?>"
                                class="input input-bordered w-full pl-11 text-xs h-12 font-medium bg-base-200/40 border-base-300 focus:border-primary/80 focus:ring-1 focus:ring-primary/40 rounded-xl"
                                placeholder="https://drive.google.com/drive/folders/..." />
                        </div>
                    </div>

                    <!-- Alert Warning -->
                    <div class="alert bg-warning/5 border border-warning/15 text-warning text-xs p-4 gap-3.5 rounded-2xl leading-relaxed flex items-start">
                        <div class="p-1.5 rounded-lg bg-warning/10 shrink-0 mt-0.5">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-extrabold block text-warning text-xs">PENTING: Akses Tautan Terbuka</span>
                            <p class="mt-1 text-gray-500 font-medium">
                                Pastikan pengaturan berbagi (sharing settings) tautan Google Drive Anda diatur ke <strong>"Siapa saja yang memiliki tautan dapat melihat" (Anyone with the link can view)</strong>. Tautan Figma juga harus berupa link prototype publik. Kelalaian dalam pengaturan akses dapat mengakibatkan karya tidak dapat dinilai oleh Juri.
                            </p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-5 border-t border-base-250">
                        <a href="<?= BASE_URL; ?>/dashboard" class="btn btn-ghost font-bold text-xs rounded-xl h-10 px-5">
                            Kembali
                        </a>
                        <button type="submit"
                            class="btn btn-primary font-black text-xs text-primary-content gap-2 px-6 rounded-xl h-10 hover:scale-[1.02] transition-transform duration-200 shadow-sm shadow-primary/20">
                            <span><?= $hasSubmitted ? 'Perbarui Karya' : 'Kirim Karya'; ?></span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right: Checklist & Deadline (col-span-4) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Checklist Card -->
            <div class="card bg-base-100 border border-base-200/60 shadow-sm">
                <div class="card-body p-6 gap-4">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block border-b border-base-200 pb-2.5">
                        Checklist Pengumpulan
                    </span>
                    
                    <div class="space-y-4 text-xs text-gray-500 font-medium">
                        <div class="flex items-start space-x-3.5 group">
                            <span class="w-5.5 h-5.5 rounded-full bg-success/10 text-success flex items-center justify-center shrink-0 mt-0.5 group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <span class="leading-relaxed">Tautan Figma Prototype valid dan diset ke akses publik (view only).</span>
                        </div>
                        
                        <div class="flex items-start space-x-3.5 group">
                            <span class="w-5.5 h-5.5 rounded-full bg-success/10 text-success flex items-center justify-center shrink-0 mt-0.5 group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <span class="leading-relaxed">Google Drive berisi folder aset rancangan, font yang digunakan, dan materi grafis.</span>
                        </div>
                        
                        <div class="flex items-start space-x-3.5 group">
                            <span class="w-5.5 h-5.5 rounded-full bg-success/10 text-success flex items-center justify-center shrink-0 mt-0.5 group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <span class="leading-relaxed">Dokumen presentasi Pitching Deck (format PDF) diunggah di dalam folder Drive.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deadline Card -->
            <div class="card bg-base-100 border border-base-200/60 shadow-sm overflow-hidden">
                <div class="flex flex-row items-center p-5 space-x-4 border-l-4 border-primary">
                    <div class="w-11 h-11 bg-primary/10 text-primary rounded-xl flex items-center justify-center shadow-inner shrink-0">
                        <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[9px] text-gray-400 font-black block uppercase tracking-wider">Batas Waktu Pengumpulan</span>
                        <span class="text-xs font-black text-neutral-content block leading-tight mt-0.5"><?= $formattedDeadline; ?></span>
                        <div class="inline-flex items-center gap-1 mt-1.5 px-2 py-0.5 rounded border text-[9px] font-bold <?= $remainingClass; ?>">
                            <span class="w-1 h-1 rounded-full bg-current"></span>
                            <?= $remainingText; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>