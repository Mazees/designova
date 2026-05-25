<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-5xl mx-auto space-y-6">
    <!-- Breadcrumbs -->
    <div class="text-xs breadcrumbs text-gray-400">
        <ul>
            <li><a href="<?= BASE_URL; ?>/juri/dashboard" class="hover:text-gray-650 transition-colors">Dashboard Juri</a></li>
            <li class="text-gray-700 font-semibold">Form Penilaian</li>
        </ul>
    </div>

    <!-- Header -->
    <div class="space-y-1">
        <h2 class="text-3xl font-extrabold text-neutral-content tracking-tight">Formulir Penilaian Karya</h2>
        <p class="text-xs text-gray-400 font-medium">Berikan penilaian profesional berdasarkan bobot parameter yang telah ditentukan.</p>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left: Evaluation Form -->
        <div class="lg:col-span-7 card bg-base-100 border border-base-200 shadow-md">
            <div class="card-body p-6 sm:p-8 gap-5">
                <h3 class="card-title text-lg font-black text-neutral-content">Masukkan Skor Evaluasi</h3>
                
                <!-- Parameter Weight Info Alert -->
                <div class="alert alert-info text-[10px] p-3 gap-2.5 rounded-xl border border-blue-200 bg-blue-50/50 text-blue-800 leading-normal">
                    <svg class="w-4.5 h-4.5 text-info shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>
                        <span class="font-bold block">Bobot Parameter:</span>
                        <span>UI/Visual Design (50%), UX/User Flow (40%), Kerapian Figma File (10%). Skor dinilai dari skala 1 - 100.</span>
                    </div>
                </div>

                <form method="post" action="" class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- UI Score -->
                        <div class="form-control w-full gap-1">
                            <label class="label py-0">
                                <span class="label-text font-bold text-[10px] uppercase text-gray-500">UI / Visual (50%)</span>
                            </label>
                            <input type="number" min="0" max="100" required
                                class="input input-bordered w-full text-xs h-10 font-medium" 
                                placeholder="Skor 1-100" />
                        </div>

                        <!-- UX Score -->
                        <div class="form-control w-full gap-1">
                            <label class="label py-0">
                                <span class="label-text font-bold text-[10px] uppercase text-gray-500">UX / Flow (40%)</span>
                            </label>
                            <input type="number" min="0" max="100" required
                                class="input input-bordered w-full text-xs h-10 font-medium" 
                                placeholder="Skor 1-100" />
                        </div>

                        <!-- Figma Cleanliness Score -->
                        <div class="form-control w-full gap-1">
                            <label class="label py-0">
                                <span class="label-text font-bold text-[10px] uppercase text-gray-500">Kerapian Figma (10%)</span>
                            </label>
                            <input type="number" min="0" max="100" required
                                class="input input-bordered w-full text-xs h-10 font-medium" 
                                placeholder="Skor 1-100" />
                        </div>
                    </div>

                    <!-- Feedback Textarea -->
                    <div class="form-control w-full gap-1">
                        <label class="label py-0">
                            <span class="label-text font-bold text-[10px] uppercase text-gray-500">Ulasan & Feedback Konstruktif</span>
                        </label>
                        <textarea required minlength="50"
                            class="textarea textarea-bordered w-full text-xs h-28 font-medium leading-relaxed" 
                            placeholder="Berikan ulasan detail mengenai aspek desain yang sudah baik serta area yang perlu diperbaiki (minimal 50 karakter)..."></textarea>
                    </div>

                    <!-- Submit Actions -->
                    <div class="flex gap-3 pt-2">
                        <a href="<?= BASE_URL; ?>/juri/dashboard" 
                            class="btn bg-base-200 hover:bg-base-300 text-base-content border-none flex-1 font-bold text-xs h-10">
                            Kembali
                        </a>
                        <button type="submit" 
                            class="btn btn-primary flex-2 font-extrabold text-xs h-10 text-primary-content">
                            Simpan Penilaian
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right: Team Card Summary -->
        <div class="lg:col-span-5 space-y-6">
            <div class="card bg-base-100 border border-base-200 shadow-md">
                <div class="card-body p-6 gap-4">
                    <span class="text-xs font-black text-neutral-content block tracking-tight uppercase border-b border-base-200 pb-2">Detail Tim</span>
                    
                    <div class="space-y-1.5">
                        <h4 class="text-xl font-extrabold text-neutral-content leading-none">Beta Innovators</h4>
                        <div class="badge badge-sm badge-outline font-bold text-[9px] uppercase tracking-wide">UI/UX Design</div>
                    </div>

                    <!-- Members list -->
                    <div class="space-y-3.5 border-t border-b border-base-200 py-4.5 my-1">
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-wider block">Anggota Tim:</span>
                        <div class="flex items-center space-x-3.5">
                            <div class="avatar placeholder">
                                <div class="w-8 h-8 rounded-full bg-base-200 text-gray-600 font-bold text-[10px]">
                                    JD
                                </div>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-gray-800 block">John Doe</span>
                                <span class="text-[9px] text-gray-400">Ketua Tim</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3.5">
                            <div class="avatar placeholder">
                                <div class="w-8 h-8 rounded-full bg-base-200 text-gray-600 font-bold text-[10px]">
                                    JS
                                </div>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-gray-800 block">Jane Smith</span>
                                <span class="text-[9px] text-gray-400">Anggota</span>
                            </div>
                        </div>
                    </div>

                    <!-- Submission Links -->
                    <div class="space-y-3">
                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-wider block">Tautan Peninjauan:</span>
                        <div class="flex flex-col gap-2">
                            <a href="https://figma.com" target="_blank" 
                               class="btn btn-outline btn-sm rounded-xl text-left justify-between items-center text-xs h-10 w-full hover:bg-orange-50 hover:text-orange-600 hover:border-orange-200">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-orange-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                                    <span class="font-extrabold text-neutral-content">Prototype Figma</span>
                                </span>
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            <a href="https://drive.google.com" target="_blank" 
                               class="btn btn-outline btn-sm rounded-xl text-left justify-between items-center text-xs h-10 w-full hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM19 18H6c-2.21 0-4-1.79-4-4 0-2.05 1.53-3.76 3.56-3.97l1.07-.11.5-.95C8.08 7.14 9.94 6 12 6c2.62 0 4.88 1.86 5.39 4.43l.3 1.5 1.53.11c1.56.1 2.78 1.41 2.78 2.96 0 1.65-1.35 3-3 3z"/></svg>
                                    <span class="font-extrabold text-neutral-content">File Drive & PDF</span>
                                </span>
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
