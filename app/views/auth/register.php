<?php require_once __DIR__ . '/../layouts/header.php'; 
$isRegOpen = isset($isRegOpen) ? $isRegOpen : false;
?>

<div class="card lg:card-side w-full max-w-5xl mx-auto shadow-2xl border border-base-200 overflow-hidden my-6" data-aos="fade-up"
    x-data="{
        name: '',
        email: '',
        password: '',
        confirmPassword: '',
        teamName: '',
    }">

    <!-- Branding Panel (Kiri) -->
    <div class="lg:w-5/12 bg-base-200 relative overflow-hidden flex flex-col justify-between p-10">
        <!-- Decorative shapes -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/10 rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-primary/8 rounded-full translate-y-1/2 -translate-x-1/4 pointer-events-none"></div>

        <!-- Geometric SVG Art -->
        <div class="absolute inset-0 flex items-center justify-center opacity-10 pointer-events-none">
            <svg class="w-56 h-56 text-primary" viewBox="0 0 200 200" fill="none">
                <rect x="20" y="20" width="70" height="70" rx="12" fill="currentColor" transform="rotate(15 55 55)"/>
                <rect x="110" y="40" width="50" height="50" rx="8" fill="currentColor" transform="rotate(-10 135 65)"/>
                <rect x="30" y="120" width="55" height="55" rx="10" fill="currentColor" transform="rotate(5 57 147)"/>
                <circle cx="160" cy="150" r="30" fill="currentColor"/>
            </svg>
        </div>

        <!-- Brand -->
        <div class="relative z-10">
            <a href="<?= BASE_URL; ?>/" class="text-3xl font-black text-primary tracking-wider">designova</a>
        </div>

        <!-- Tagline -->
        <div class="relative z-10 space-y-3">
            <h2 class="text-3xl font-black text-base-content leading-tight">Mulai<br>Perjalananmu.</h2>
            <p class="text-sm text-base-content/50 leading-relaxed max-w-xs">
                Daftarkan tim kreatif terbaikmu dan raih penghargaan bergengsi tingkat nasional.
            </p>
        </div>
    </div>

    <!-- Form Panel (Kanan) -->
    <div class="lg:w-7/12 card-body p-8 lg:p-10 bg-base-100 flex flex-col justify-center">
        <div class="mb-6">
            <h1 class="text-2xl font-extrabold text-base-content">Pendaftaran Tim Baru</h1>
            <p class="text-xs text-base-content/50 mt-1.5 font-medium">Lengkapi data ketua dan nama tim untuk mendaftar kompetisi.</p>
        </div>

        <!-- Error Alert -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-error mb-5 rounded-xl text-sm font-medium">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <span class="font-bold block">Terjadi kesalahan:</span>
                    <span><?= htmlspecialchars($error); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!$isRegOpen): ?>
            <!-- Registration Closed Card -->
            <div class="flex flex-col items-center justify-center p-8 bg-error/10 border border-error/20 rounded-2xl text-center space-y-4 my-6" data-aos="zoom-in">
                <div class="w-16 h-16 bg-error/15 text-error rounded-full flex items-center justify-center shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div class="space-y-2">
                    <h3 class="text-lg font-black text-neutral-content">Pendaftaran Ditutup</h3>
                    <p class="text-xs text-gray-450 max-w-sm leading-relaxed mx-auto">
                        Mohon maaf, pendaftaran tim baru untuk kompetisi UI/UX Designova saat ini telah ditutup oleh panitia.
                    </p>
                </div>
                <a href="<?= BASE_URL; ?>/" class="btn btn-outline btn-sm font-bold px-6 rounded-xl mt-2">
                    Kembali ke Beranda
                </a>
            </div>
        <?php else: ?>
            <!-- Visual Steps -->
            <ul class="steps steps-horizontal w-full mb-6 text-xs">
                <li class="step step-primary font-semibold">Informasi Akun</li>
                <li class="step step-primary font-semibold">Detail Tim</li>
            </ul>

            <!-- Form -->
            <form method="POST" action="<?= BASE_URL; ?>/register" class="space-y-5">

                <!-- Section 1: Akun Ketua -->
                <div class="space-y-3">
                    <h3 class="text-sm font-extrabold text-base-content flex items-center gap-2 border-b border-base-200 pb-2.5">
                        <span class="badge badge-primary font-bold text-xs w-5 h-5 p-0 shrink-0">1</span>
                        Informasi Akun Ketua
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="form-control gap-1">
                            <label class="label py-0">
                                <span class="label-text font-bold text-[10px] uppercase text-base-content/50 tracking-wider">Nama Lengkap Ketua</span>
                            </label>
                            <input type="text" name="name" x-model="name" required
                                class="input input-bordered w-full text-sm h-10 font-medium focus:border-primary focus:outline-none"
                                placeholder="Nama lengkap ketua" />
                        </div>

                        <div class="form-control gap-1">
                            <label class="label py-0">
                                <span class="label-text font-bold text-[10px] uppercase text-base-content/50 tracking-wider">Email (Untuk Login)</span>
                            </label>
                            <input type="email" name="email" x-model="email" required
                                class="input input-bordered w-full text-sm h-10 font-medium focus:border-primary focus:outline-none"
                                placeholder="nama@email.com" />
                        </div>

                        <div class="form-control gap-1">
                            <label class="label py-0">
                                <span class="label-text font-bold text-[10px] uppercase text-base-content/50 tracking-wider">Kata Sandi</span>
                            </label>
                            <input type="password" name="password" x-model="password" required
                                class="input input-bordered w-full text-sm h-10 font-medium focus:border-primary focus:outline-none"
                                placeholder="Minimal 6 karakter" />
                        </div>

                        <div class="form-control gap-1">
                            <label class="label py-0">
                                <span class="label-text font-bold text-[10px] uppercase text-base-content/50 tracking-wider">Konfirmasi Sandi</span>
                            </label>
                            <input type="password" x-model="confirmPassword" required
                                class="input input-bordered w-full text-sm h-10 font-medium focus:border-primary focus:outline-none"
                                placeholder="Ketik ulang sandi" />
                        </div>
                    </div>
                </div>

                <!-- Section 2: Detail Tim -->
                <div class="space-y-3 pt-1">
                    <h3 class="text-sm font-extrabold text-base-content flex items-center gap-2 border-b border-base-200 pb-2.5">
                        <span class="badge badge-primary font-bold text-xs w-5 h-5 p-0 shrink-0">2</span>
                        Detail Tim &amp; Anggota
                    </h3>
                    <div class="form-control gap-1">
                        <label class="label py-0">
                            <span class="label-text font-bold text-[10px] uppercase text-base-content/50 tracking-wider">Nama Tim Kompetisi</span>
                        </label>
                        <input type="text" name="team_name" x-model="teamName" required
                            class="input input-bordered w-full text-sm h-10 font-medium focus:border-primary focus:outline-none"
                            placeholder="Masukkan nama tim kreatif Anda" />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="form-control gap-1">
                            <label class="label py-0">
                                <span class="label-text font-bold text-[10px] uppercase text-base-content/50 tracking-wider">Anggota Tim 1 (Opsional)</span>
                            </label>
                            <input type="text" name="member_1"
                                class="input input-bordered w-full text-sm h-10 font-medium focus:border-primary focus:outline-none"
                                placeholder="Nama anggota kedua" />
                        </div>
                        <div class="form-control gap-1">
                            <label class="label py-0">
                                <span class="label-text font-bold text-[10px] uppercase text-base-content/50 tracking-wider">Anggota Tim 2 (Opsional)</span>
                            </label>
                            <input type="text" name="member_2"
                                class="input input-bordered w-full text-sm h-10 font-medium focus:border-primary focus:outline-none"
                                placeholder="Nama anggota ketiga" />
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" id="btn-register"
                    class="btn btn-primary btn-block h-12 font-extrabold text-sm shadow-lg shadow-primary/25 hover:shadow-primary/40 transition-shadow mt-2">
                    Daftarkan Tim Kami
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>
        <?php endif; ?>

        <div class="divider text-xs text-base-content/30 my-4">atau</div>
        <p class="text-center text-sm text-base-content/50">
            Sudah memiliki akun?
            <a href="<?= BASE_URL; ?>/login" class="text-primary font-extrabold hover:underline">Masuk di sini</a>
        </p>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>