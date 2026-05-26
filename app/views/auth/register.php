<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="card lg:card-side gap-5 w-full max-w-5xl bg-base-100 shadow-2xl border border-base-200 overflow-hidden mx-auto my-6 min-h-[650px]"
    x-data="{
         name: '',
         email: '',
         password: '',
         confirmPassword: '',
         teamName: '',
     }">
    <!-- Left Column (Branding Panel) -->
    <div
        class="lg:w-5/12 bg-gradient-to-br from-neutral to-accent p-10 flex flex-col justify-between text-left text-white relative overflow-hidden">
        <!-- Glow accents -->
        <div class="absolute -top-24 -left-24 w-64 h-64 bg-primary/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>

        <!-- Header logo -->
        <div class="relative z-10">
            <span class="text-3xl font-black text-primary tracking-wider">designova</span>
        </div>

        <!-- Center geometric art (SVG) -->
        <div class="relative py-12 flex items-center justify-center opacity-65">
            <svg class="w-40 h-40 text-primary/40 animate-pulse" viewBox="0 0 100 100" fill="none" stroke="currentColor"
                stroke-width="0.5">
                <rect x="25" y="25" width="50" height="50" transform="rotate(45 50 50)" />
                <rect x="30" y="30" width="40" height="40" transform="rotate(30 50 50)" />
                <circle cx="50" cy="50" r="8" />
            </svg>
        </div>

        <!-- Footer text -->
        <div class="space-y-3 relative z-10">
            <h3 class="text-2xl font-black tracking-tight text-white leading-tight">Mulai Perjalananmu.</h3>
            <p class="text-xs text-muted leading-relaxed max-w-xs font-medium">
                Daftarkan tim kreatif terbaikmu, tunjukkan inovasi antarmuka digitalmu, dan raih penghargaan bergengsi
                tingkat nasional.
            </p>
        </div>
    </div>

    <!-- Right Column (Form Panel) -->
    <div class="lg:w-7/12 px-8 sm:px-10 flex items-center justify-center bg-base-100">
        <div class="w-full space-y-6">
            <div class="text-center lg:text-left space-y-1">
                <h2 class="text-2xl font-extrabold text-neutral-content tracking-tight">Pendaftaran Tim Baru</h2>
                <p class="text-xs text-gray-400 font-medium">Lengkapi data ketua dan nama tim untuk mendaftar kompetisi.
                </p>
            </div>

            <!-- Alert Error jika registrasi gagal -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-error text-xs rounded-xl p-4 flex items-start gap-3">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <span class="font-bold block text-error-content">Terjadi kesalahan:</span>
                        <span class="text-error-content/90"><?= htmlspecialchars($error); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Form Pendaftaran -->
            <form method="post" action="<?= BASE_URL; ?>/register" class="space-y-5">

                <!-- SECTION 1: Akun Ketua Tim -->
                <div class="space-y-3">
                    <h3
                        class="text-sm font-extrabold text-neutral-content flex items-center border-b border-base-200 pb-2.5">
                        <span class="badge badge-primary font-bold text-xs mr-2 w-5 h-5 font-mono p-0">1</span>
                        Informasi Akun Ketua
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Input Nama Ketua -->
                        <div class="form-control w-full gap-1">
                            <label class="label py-0">
                                <span
                                    class="label-text font-bold text-[10px] uppercase text-gray-500 tracking-wider">Nama
                                    Lengkap Ketua</span>
                            </label>
                            <input type="text" name="name" x-model="name" required
                                class="input input-bordered w-full text-xs h-10 font-medium"
                                placeholder="Nama lengkap ketua" />
                        </div>

                        <!-- Input Email -->
                        <div class="form-control w-full gap-1">
                            <label class="label py-0">
                                <span
                                    class="label-text font-bold text-[10px] uppercase text-gray-500 tracking-wider">Email
                                    Ketua (Untuk Login)</span>
                            </label>
                            <input type="email" name="email" x-model="email" required
                                class="input input-bordered w-full text-xs h-10 font-medium"
                                placeholder="nama@email.com" />
                        </div>

                        <!-- Input Password -->
                        <div class="form-control w-full gap-1">
                            <label class="label py-0">
                                <span
                                    class="label-text font-bold text-[10px] uppercase text-gray-500 tracking-wider">Kata
                                    Sandi</span>
                            </label>
                            <input type="password" name="password" x-model="password" required
                                class="input input-bordered w-full text-xs h-10 font-medium"
                                placeholder="Minimal 6 karakter" />
                        </div>

                        <!-- Input Konfirmasi Password -->
                        <div class="form-control w-full gap-1">
                            <label class="label py-0">
                                <span
                                    class="label-text font-bold text-[10px] uppercase text-gray-500 tracking-wider">Konfirmasi
                                    Sandi</span>
                            </label>
                            <input type="password" x-model="confirmPassword" required
                                class="input input-bordered w-full text-xs h-10 font-medium"
                                placeholder="Ketik ulang sandi" />
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: Informasi Tim -->
                <div class="space-y-3 pt-2">
                    <h3
                        class="text-sm font-extrabold text-neutral-content flex items-center border-b border-base-200 pb-2.5">
                        <span class="badge badge-primary font-bold text-xs mr-2 w-5 h-5 font-mono p-0">2</span>
                        Detail Tim & Anggota
                    </h3>
                    <div class="space-y-3">
                        <!-- Input Nama Tim -->
                        <div class="form-control w-full gap-1">
                            <label class="label py-0">
                                <span
                                    class="label-text font-bold text-[10px] uppercase text-gray-500 tracking-wider">Nama
                                    Tim Kompetisi</span>
                            </label>
                            <input type="text" name="team_name" x-model="teamName" required
                                class="input input-bordered w-full text-xs h-10 font-medium"
                                placeholder="Masukkan nama tim kreatif Anda" />
                        </div>

                        <!-- Input Anggota Lainnya -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="form-control w-full gap-1">
                                <label class="label py-0">
                                    <span
                                        class="label-text font-bold text-[10px] uppercase text-gray-500 tracking-wider">Anggota
                                        Tim 1 (Opsional)</span>
                                </label>
                                <input type="text" name="member_1"
                                    class="input input-bordered w-full text-xs h-10 font-medium"
                                    placeholder="Nama anggota kedua" />
                            </div>
                            <div class="form-control w-full gap-1">
                                <label class="label py-0">
                                    <span
                                        class="label-text font-bold text-[10px] uppercase text-gray-500 tracking-wider">Anggota
                                        Tim 2 (Opsional)</span>
                                </label>
                                <input type="text" name="member_2"
                                    class="input input-bordered w-full text-xs h-10 font-medium"
                                    placeholder="Nama anggota ketiga" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button Submit -->
                <button type="submit" class="btn btn-primary btn-block text-sm h-12 font-extrabold mt-4">
                    <span>Daftarkan Tim Kami</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>

            <!-- Link Alternatif -->
            <div class="pt-4 border-t border-base-200 text-center text-sm">
                <p class="text-gray-400">Sudah memiliki akun?
                    <a href="<?= BASE_URL; ?>/login" class="text-primary font-bold hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>