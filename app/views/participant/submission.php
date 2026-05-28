<?php require_once '../app/views/layouts/header.php';

$team = $_SESSION['team'] ?? null;
$teamName = $team['team_name'] ?? 'Tim Anda';
$isActive = (isset($team['is_active']) && $team['is_active'] == 1);
$hasSubmitted = (isset($submission) && $submission !== null);

?>

<div class="max-w-6xl mx-auto space-y-8 pb-12">
    <!-- Header -->
    <div class="space-y-3">
        <div class="flex flex-wrap items-center gap-3">
            <?php if ($hasSubmitted): ?>
                <div
                    class="badge bg-info/15 border border-info/35 text-info font-black text-[10px] uppercase tracking-wider py-2.5 px-3.5">
                    Karya Dikirim
                </div>
            <?php endif; ?>
        </div>
        <h2 class="text-3xl md:text-4xl font-black tracking-tight text-neutral-content">Submit Your Work</h2>
        <p class="text-xs text-gray-400 font-medium max-w-2xl leading-relaxed">
            Kumpulkan karya terbaik tim Anda di sini. Pastikan tautan Design Figma dan Link Publikasi Laporan Google
            Docs Anda dapat
            diakses secara publik sebelum menekan tombol kirim.
        </p>
    </div>
    <!-- Feedback Alerts -->
    <?php if (!empty($success)): ?>
        <div
            class="alert alert-success text-xs font-semibold p-4 rounded-2xl flex items-start gap-3.5 border border-success/20 bg-success/5 text-success">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span><?= htmlspecialchars($success); ?></span>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div
            class="alert alert-error text-xs font-semibold p-4 rounded-2xl flex items-start gap-3.5 border border-error/20 bg-error/5 text-error">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
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
                        <div
                            class="w-10 h-10 rounded-full bg-success/20 text-success flex items-center justify-center shadow-inner shrink-0">
                            <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-black text-success block">Karya Berhasil Dikumpulkan</span>
                            <span class="text-[10px] text-gray-500 block font-medium mt-0.5">Tautan karya Anda sudah
                                terdaftar di sistem. Anda tetap dapat mengedit/memperbarui tautan sebelum batas waktu
                                berakhir.</span>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL; ?>/submission" class="space-y-6">
                    <!-- Figma Link -->
                    <div class="form-control w-full flex flex-col gap-2">
                        <label class="label py-0 flex items-center space-x-1">
                            <!-- Figma Icon -->
                            <svg class="text-lg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M8.667 9.417a2.583 2.583 0 1 0 0 5.166h2.583V9.417zm2.583-1.5H8.667a2.583 2.583 0 0 1 0-5.167h2.583zm1.5-5.167v5.167h2.583a2.584 2.584 0 0 0 0-5.167zm2.583 6.666a2.583 2.583 0 0 0-2.583 2.542v.083a2.583 2.583 0 1 0 2.583-2.625m-6.666 6.667a2.584 2.584 0 1 0 2.583 2.584v-2.584z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="label-text font-black text-sm uppercase text-gray-500 tracking-wider">Link
                                Design Figma</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </span>
                            <input type="url" required name="figma_link"
                                value="<?= htmlspecialchars($submission['figma_link'] ?? ''); ?>"
                                class="input input-bordered w-full pl-11 text-xs h-12 font-medium bg-base-200/40 border-base-300 focus:border-primary/80 focus:ring-1 focus:ring-primary/40 rounded-xl"
                                placeholder="https://www.figma.com/proto/..." />
                        </div>
                    </div>

                    <!-- Google Docs Link -->
                    <div class="form-control w-full flex flex-col gap-2">
                        <label class="label py-0 flex items-center space-x-1">
                            <!-- Google Docs Icon -->
                            <svg class="text-lg" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor"
                                    d="M12 2v4q0 1.25.875 2.125T15 9h4v11q0 .825-.587 1.413T17 22H7q-.825 0-1.412-.587T5 20V4q0-.825.588-1.412T7 2zm2 0l5 5h-4q-.425 0-.712-.288T14 6zm-4 17h2q.425 0 .713-.288T13 18t-.288-.712T12 17h-2q-.425 0-.712.288T9 18t.288.713T10 19m0-4h4q.425 0 .713-.288T15 14t-.288-.712T14 13h-4q-.425 0-.712.288T9 14t.288.713T10 15" />
                            </svg>

                            <span class="label-text font-black text-sm uppercase text-gray-500 tracking-wider">
                                Link Publikasi Laporan Google Docs</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </span>
                            <input type="url" required name="docs_link"
                                value="<?= htmlspecialchars($submission['docs_link'] ?? ''); ?>"
                                class="input input-bordered w-full pl-11 text-xs h-12 font-medium bg-base-200/40 border-base-300 focus:border-primary/80 focus:ring-1 focus:ring-primary/40 rounded-xl"
                                placeholder="https://drive.google.com/drive/folders/..." />
                        </div>
                    </div>

                    <div
                        class="alert bg-warning/5 border border-warning/15 text-warning text-xs p-4 gap-3.5 rounded-2xl leading-relaxed flex items-start">
                        <div class="p-1.5 rounded-lg bg-warning/10 shrink-0 mt-0.5">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="mt-1 text-gray-500 font-medium">
                                <span class="font-semibold block text-base-content mb-1 text-lg uppercase">Cara Dapatkan
                                    Link
                                    Publikasi
                                    Google Docs</span>
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Buka dokumen Anda di browser, lalu klik menu File di kiri atas.</li>
                                    <li>Pilih Bagikan &gt; Publikasikan ke web (Publish to the web).</li>
                                    <li>Klik tombol Publikasikan (Publish).</li>
                                    <li>Akan muncul jendela pop-up, pilih OK untuk mengonfirmasi.</li>
                                    <li>Salin tautan (URL) yang muncul untuk dibagikan ke publik.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-5 border-t border-base-250">
                        <a href="<?= BASE_URL; ?>/dashboard"
                            class="btn btn-ghost font-bold text-xs rounded-xl h-10 px-5">
                            Kembali
                        </a>
                        <button type="submit"
                            class="btn btn-primary font-black text-xs text-primary-content gap-2 px-6 rounded-xl h-10 hover:scale-[1.02] transition-transform duration-200 shadow-sm shadow-primary/20">
                            <span><?= $hasSubmitted ? 'Perbarui Karya' : 'Kirim Karya'; ?></span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
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
                    <span
                        class="text-lg font-black text-gray-400 uppercase tracking-widest block border-b border-base-200 pb-2.5">
                        Kriteria Penilaian
                    </span>

                    <div class="space-y-4 text-xs text-gray-500 font-medium">
                        <div class="flex items-start space-x-3.5 group">
                            <span
                                class="w-5.5 h-5.5 rounded-full bg-success/10 text-success flex items-center justify-center shrink-0 mt-0.5 group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <span class="leading-relaxed">50% Design Visual</span>
                        </div>

                        <div class="flex items-start space-x-3.5 group">
                            <span
                                class="w-5.5 h-5.5 rounded-full bg-success/10 text-success flex items-center justify-center shrink-0 mt-0.5 group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <span class="leading-relaxed">40% Kemudahan Penggunaan (Usability)</span>
                        </div>

                        <div class="flex items-start space-x-3.5 group">
                            <span
                                class="w-5.5 h-5.5 rounded-full bg-success/10 text-success flex items-center justify-center shrink-0 mt-0.5 group-hover:scale-105 transition-transform duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <span class="leading-relaxed">10% Kerapihan Komponen Figma</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deadline Card -->
            <div class="card bg-base-100 border border-base-200/60 shadow-sm overflow-hidden">
                <div class="flex flex-row items-center p-5 space-x-4 border-l-4 border-primary">
                    <div
                        class="w-11 h-11 bg-primary/10 text-primary rounded-xl flex items-center justify-center shadow-inner shrink-0">
                        <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="text-[9px] text-gray-400 font-black block uppercase tracking-wider">Batas Waktu
                            Pengumpulan</span>
                        <span
                            class="text-xs font-black text-neutral-content block leading-tight mt-0.5"><?= !empty($formattedDeadline) ? $formattedDeadline : 'Tidak ada deadline'; ?></span>
                        <div
                            class="inline-flex items-center gap-1 mt-1.5 px-2 py-0.5 rounded border text-[9px] font-bold <?= !empty($remainingClass) ? $remainingClass : ''; ?>">
                            <span class="w-1 h-1 rounded-full bg-current"></span>
                            <?= !empty($remainingText) ? $remainingText : ''; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>