<?php require_once '../app/views/layouts/header.php'; ?>

<div class="card lg:card-side max-w-5xl w-full mx-auto shadow-2xl border border-base-200 min-h-[580px] overflow-hidden" data-aos="fade-up">

    <!-- Branding Panel (Kiri) -->
    <div class="lg:w-5/12 bg-base-200 relative overflow-hidden flex flex-col justify-between p-10">
        <!-- Decorative shapes -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/10 rounded-full -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-primary/8 rounded-full translate-y-1/2 -translate-x-1/4 pointer-events-none"></div>

        <!-- Decorative Geometric SVG -->
        <div class="absolute inset-0 flex items-center justify-center opacity-10 pointer-events-none">
            <svg class="w-64 h-64 text-primary" viewBox="0 0 200 200" fill="none">
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
            <h2 class="text-3xl font-black text-base-content leading-tight">Elevate<br>Your Craft.</h2>
            <p class="text-sm text-base-content/50 leading-relaxed max-w-xs">
                Masuk ke platform kompetisi UI/UX terbaik dan buktikan keahlianmu.
            </p>
        </div>
    </div>

    <!-- Form Panel (Kanan) -->
    <div class="lg:w-7/12 card-body p-8 lg:p-12 bg-base-100 flex flex-col justify-center">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-base-content">Selamat Datang</h1>
            <p class="text-sm text-base-content/50 mt-1.5 font-medium">Masuk ke akun tim kamu untuk melanjutkan.</p>
        </div>

        <!-- Error Alert -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-error mb-6 rounded-xl text-sm font-medium" data-aos="shake">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="<?= BASE_URL; ?>/login" class="space-y-5"
              x-data="{ showPassword: false }">

            <!-- Email -->
            <div class="form-control">
                <label class="label pb-1.5">
                    <span class="label-text font-bold text-[11px] uppercase tracking-wider text-base-content/50">Email</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 z-10 left-0 pl-3.5 flex items-center pointer-events-none text-base-content/35">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input id="login-email" type="email" name="email" required
                        class="input input-bordered w-full h-12 pl-10 font-medium focus:border-primary focus:outline-none transition-colors"
                        placeholder="Masukkan email...">
                </div>
            </div>

            <!-- Password -->
            <div class="form-control">
                <label class="label pb-1.5">
                    <span class="label-text font-bold text-[11px] uppercase tracking-wider text-base-content/50">Password</span>
                    <a href="#" class="label-text-alt text-primary font-bold text-xs hover:underline">Lupa password?</a>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 z-10 left-0 pl-3.5 flex items-center pointer-events-none text-base-content/35">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input id="login-password" :type="showPassword ? 'text' : 'password'" name="password" required
                        class="input input-bordered w-full h-12 pl-10 pr-12 font-medium focus:border-primary focus:outline-none transition-colors"
                        placeholder="Masukkan password...">
                    <button type="button" @click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-base-content/40 hover:text-base-content transition-colors">
                        <svg x-show="!showPassword" class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg x-show="showPassword" class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-2">
                <button type="submit" id="btn-login"
                    class="btn btn-primary btn-block h-12 font-extrabold text-base shadow-lg shadow-primary/25 hover:shadow-primary/40 transition-shadow">
                    Masuk ke Dashboard
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </div>
        </form>

        <div class="divider text-xs text-base-content/30 my-6">atau</div>

        <p class="text-center text-sm text-base-content/50">
            Belum punya tim?
            <a href="<?= BASE_URL; ?>/register" class="text-primary font-extrabold hover:underline">Daftar di sini</a>
        </p>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>