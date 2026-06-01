<?php require_once '../app/views/layouts/header.php';
?>

<div class="max-w-5xl mx-auto space-y-6 pb-12" data-aos="fade-up">
    <!-- Breadcrumbs -->
    <div class="text-xs breadcrumbs text-gray-400">
        <ul>
            <li><a href="<?= BASE_URL; ?>/juri/dashboard" class="hover:text-gray-650 transition-colors">Dashboard
                    Juri</a></li>
            <li class="text-gray-700 font-semibold">Form Penilaian</li>
        </ul>
    </div>

    <!-- Header -->
    <div class="space-y-2">
        <h2 class="text-3xl font-black text-neutral-content tracking-tight">Formulir Penilaian Karya</h2>
        <p class="text-xs text-gray-400 font-medium max-w-2xl leading-relaxed">
            Berikan penilaian profesional berdasarkan bobot parameter yang telah ditentukan secara objektif.
        </p>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left: Evaluation Form (col-span-7) -->
        <div class="lg:col-span-7 card bg-base-100 border border-base-200 shadow-sm rounded-2xl">
            <div class="card-body p-6 sm:p-8 gap-5">
                <h3 class="card-title text-lg font-black text-neutral-content">Masukkan Skor Evaluasi</h3>

                <!-- Parameter Weight Info Alert -->
                <div
                    class="alert alert-info text-[10px] p-3.5 gap-3 rounded-xl  text-white-800 leading-relaxed flex items-start">
                    <svg class="w-4.5 h-4.5 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <span class="font-bold block">Kriteria Pembobotan Parameter:</span>
                        <p class="mt-0.5 font-medium">UI/Visual Design (50%), UX/User Flow (40%), Kerapian Berkas Figma
                            (10%). Penilaian menggunakan skala skor 1 - 100.</p>
                    </div>
                </div>

                <form method="post" action="<?= BASE_URL; ?>/juri/review/<?= $team['id']; ?>" class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- UI Score -->
                        <div class="form-control w-full gap-2">
                            <label class="label py-0">
                                <span
                                    class="label-text font-black text-[10px] uppercase text-gray-500 tracking-wider">UI
                                    / Visual (50%)</span>
                            </label>
                            <input type="number" name="ui_score" min="0" max="100" required
                                class="input input-bordered w-full text-xs h-11 font-medium bg-base-200/30 focus:outline-none focus:border-primary rounded-xl"
                                placeholder="Skor 1-100" />
                        </div>

                        <!-- UX Score -->
                        <div class="form-control w-full gap-2">
                            <label class="label py-0">
                                <span
                                    class="label-text font-black text-[10px] uppercase text-gray-500 tracking-wider">UX
                                    / Flow (40%)</span>
                            </label>
                            <input type="number" name="ux_score" min="0" max="100" required
                                class="input input-bordered w-full text-xs h-11 font-medium bg-base-200/30 focus:outline-none focus:border-primary rounded-xl"
                                placeholder="Skor 1-100" />
                        </div>

                        <!-- Figma Cleanliness Score -->
                        <div class="form-control w-full gap-2">
                            <label class="label py-0">
                                <span
                                    class="label-text font-black text-[10px] uppercase text-gray-500 tracking-wider">Kerapian
                                    Figma (10%)</span>
                            </label>
                            <input type="number" name="figma_score" min="0" max="100" required
                                class="input input-bordered w-full text-xs h-11 font-medium bg-base-200/30 focus:outline-none focus:border-primary rounded-xl"
                                placeholder="Skor 1-100" />
                        </div>
                    </div>

                    <!-- Feedback Textarea -->
                    <div class="form-control w-full gap-2">
                        <label class="label py-0">
                            <span
                                class="label-text font-black text-[10px] uppercase text-gray-500 tracking-wider">Ulasan
                                &amp; Feedback Konstruktif</span>
                        </label>
                        <textarea name="feedback" required
                            class="textarea textarea-bordered w-full text-xs h-28 font-medium leading-relaxed bg-base-200/30 focus:outline-none focus:border-primary rounded-xl"
                            placeholder="Berikan ulasan detail mengenai aspek desain yang sudah baik serta area yang perlu diperbaiki"></textarea>
                    </div>

                    <!-- SubmBukan URL Google Docs yang valid!it Actions -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-base-200">
                        <a href="<?= BASE_URL; ?>/juri/dashboard"
                            class="btn btn-ghost font-bold text-xs h-10 px-5 rounded-xl">
                            Kembali
                        </a>
                        <button type="submit" name="submit-review"
                            class="btn btn-primary font-black text-xs text-primary-content h-10 px-6 rounded-xl shadow-sm shadow-primary/20 hover:scale-[1.02] transition-transform duration-200">
                            Simpan Penilaian
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right: Team Card Summary (col-span-5) -->
        <div class="lg:col-span-5 space-y-6">
            <div class="card bg-base-100 border border-base-200 shadow-sm rounded-2xl">
                <div class="card-body p-6 gap-5">
                    <span
                        class="text-[10px] font-black text-gray-400 block tracking-widest uppercase border-b border-base-200 pb-2.5">Detail
                        Tim</span>

                    <div class="space-y-1.5">
                        <h4 class="text-xl font-black text-neutral-content leading-none">
                            <?= htmlspecialchars($team['team_name'] ?? 'Tidak Ada Nama Tim'); ?>
                        </h4>
                    </div>

                    <!-- Members list -->
                    <div class="space-y-3.5 border-t border-b border-base-200 py-4 my-1">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest block">Anggota
                            Tim</span>

                        <li class="flex items-center space-x-3">
                            <div class="avatar placeholder">
                                <div
                                    class="w-8 h-8 uppercase rounded-lg bg-primary/10 text-primary font-black text-xs flex items-center justify-center">
                                    <?= htmlspecialchars($leaderName[0] . $leaderName[1] ?? '-'); ?>
                                </div>
                            </div>
                            <div>
                                <span
                                    class="text-xs font-bold text-base-content block"><?= htmlspecialchars($leaderName ?? 'Tidak Ada Ketua Tim'); ?>
                                </span>
                                <span class="text-[9px] text-gray-400 font-medium">Ketua Tim</span>
                            </div>
                        </li>

                        <?php foreach (json_decode($team['members']) as $index => $memberName): ?>
                            <li class="flex items-center space-x-3">
                                <div class="avatar placeholder">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-base-200 text-gray-500 uppercase font-black text-xs flex items-center justify-center">
                                        <?= $memberName[0] . $memberName[1] ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-base-content block"><?= $memberName ?></span>
                                    <span class="text-[9px] text-gray-400 font-medium">Anggota</span>
                                </div>
                            </li>
                        <?php endforeach; ?>

                        <!-- Submission Links -->
                        <div class="space-y-3">
                            <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest block">Tautan
                                Peninjauan</span>
                            <div class="flex flex-col gap-2">
                                <!-- Figma Button -->
                                <a href="<?= htmlspecialchars($team['figma_link'] ?? '#'); ?>" target="_blank"
                                    class="btn btn-outline btn-sm rounded-xl text-left justify-between items-center text-xs h-11 w-full border-base-300 hover:bg-orange-50 hover:text-orange-600 hover:border-orange-200 transition-colors">
                                    <span class="flex items-center space-x-2.5">
                                        <svg class="w-4.5 h-4.5 text-orange-500 shrink-0" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                                        </svg>
                                        <span class="font-extrabold text-neutral-content">Prototype Figma</span>
                                    </span>
                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>

                                <!-- Drive Button -->
                                <a href="<?= htmlspecialchars($team['docs_link'] ?? '#'); ?>" target="_blank"
                                    class="btn btn-outline btn-sm rounded-xl text-left justify-between items-center text-xs h-11 w-full border-base-300 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-colors">
                                    <span class="flex items-center space-x-2.5">
                                        <svg class="w-4.5 h-4.5 text-blue-500 shrink-0" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM19 18H6c-2.21 0-4-1.79-4-4 0-2.05 1.53-3.76 3.56-3.97l1.07-.11.5-.95C8.08 7.14 9.94 6 12 6c2.62 0 4.88 1.86 5.39 4.43l.3 1.5 1.53.11c1.56.1 2.78 1.41 2.78 2.96 0 1.65-1.35 3-3 3z" />
                                        </svg>
                                        <span class="font-extrabold text-neutral-content">File Drive &amp; PDF</span>
                                    </span>
                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <div class="card bg-base-100 border border-base-200 shadow-sm rounded-2xl overflow-hidden">
        <div class="card-body p-6 sm:p-8 gap-5">
            <div class="flex flex-col gap-1.5">
                <span class="text-[10px] font-black text-gray-400 block tracking-widest uppercase">Dokumen
                    Review</span>
                <h4 class="text-xl font-black text-neutral-content leading-none">Preview Dokumen Laporan Project
                </h4>
                <p class="text-[11px] text-gray-400 font-medium leading-relaxed max-w-2xl">
                    Gunakan dokumen berikut sebagai referensi saat memberi penilaian dan catatan. Area ini dibuat
                    lebih
                    besar agar isi dokumen mudah dibaca.
                </p>
            </div>

            <div class="rounded-2xl border border-base-200 bg-base-200/20 overflow-hidden shadow-inner w-full">
                <?php if (!empty($team['docs_link'])): ?>
                    <iframe src="<?= htmlspecialchars($team['docs_link'] ?? ''); ?>" class="border-0"
                        style="width: 100%; max-width: 100%; height: 80vh;" title="Dokumen Review" loading="lazy"></iframe>
                <?php else: ?>
                    <div class="flex flex-col items-center justify-center h-96">
                        <p class="text-base font-medium text-white-500">
                            Tidak ada dokumen yang diunggah
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>