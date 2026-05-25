<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="card lg:card-side w-full max-w-5xl bg-base-100 shadow-2xl border border-base-200 overflow-hidden mx-auto my-6 min-h-[600px]"
    x-data="{ showPassword: false }">
    <!-- Left Column (Branding Panel) -->
    <div
        class="lg:w-1/2 bg-gradient-to-br from-neutral to-accent p-12 flex flex-col justify-between text-left text-white relative overflow-hidden">
        <!-- Glow accents -->
        <div class="absolute -top-24 -left-24 w-64 h-64 bg-primary/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>

        <!-- Header logo -->
        <div class="relative z-10">
            <span class="text-3xl font-black text-primary tracking-wider">designova</span>
        </div>

        <!-- Center geometric art (SVG) -->
        <div class="relative py-12 flex items-center justify-center opacity-65">
            <svg class="w-48 h-48 text-primary/40 animate-pulse" viewBox="0 0 100 100" fill="none" stroke="currentColor"
                stroke-width="0.5">
                <rect x="25" y="25" width="50" height="50" transform="rotate(45 50 50)" />
                <rect x="30" y="30" width="40" height="40" transform="rotate(30 50 50)" />
                <rect x="35" y="35" width="30" height="30" transform="rotate(15 50 50)" />
                <circle cx="50" cy="50" r="10" />
            </svg>
        </div>

        <!-- Footer text -->
        <div class="space-y-3 relative z-10">
            <h3 class="text-2xl font-black tracking-tight text-white leading-tight">Elevate Your Craft.</h3>
            <p class="text-xs text-gray-300 leading-relaxed max-w-sm">
                The premier platform for UI/UX professionals and rising talents to compete, showcase, and gain
                recognition.
            </p>
        </div>
    </div>

    <!-- Right Column (Form Panel) -->
    <div class="lg:w-1/2 p-8 sm:p-12 flex items-center justify-center bg-base-100">
        <div class="w-full max-w-md space-y-8">
            <div class="text-center lg:text-left space-y-2">
                <h2 class="text-3xl font-extrabold text-neutral-content tracking-tight">Selamat Datang</h2>
                <p class="text-xs text-muted font-medium">Satu akses untuk Participant, Judge, dan Admin.</p>
            </div>

            <!-- Alert Error jika login gagal -->
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

            <!-- Form Login -->
            <form method="post" action="<?= BASE_URL; ?>/login" class="space-y-6">
                <!-- Input Email -->
                <div class="form-control w-full gap-1.5">
                    <label class="label py-0">
                        <span class="label-text font-bold text-xs uppercase text-gray-500 tracking-wider">Email
                            Address</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-muted">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </span>
                        <input type="email" name="email" required
                            class="input input-bordered w-full pl-11 text-xs h-12 font-medium"
                            placeholder="name@example.com" />
                    </div>
                </div>

                <!-- Input Password -->
                <div class="form-control w-full gap-1.5">
                    <div class="flex justify-between items-center">
                        <label class="label py-0">
                            <span
                                class="label-text font-bold text-xs uppercase text-muted tracking-wider">Password</span>
                        </label>
                        <a href="#" class="text-xs text-primary font-bold hover:underline">Lupa password?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </span>
                        <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required
                            class="input input-bordered w-full pl-11 pr-11 text-xs h-12 font-medium"
                            placeholder="••••••••" />
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-muted hover:text-base-content">
                            <!-- Eye Open -->
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            <!-- Eye Closed -->
                            <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Button Submit -->
                <button type="submit" class="btn btn-primary btn-block text-sm h-12 font-extrabold">
                    <span>Masuk ke Dashboard</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>

            <!-- Link Alternatif -->
            <div class="pt-6 border-t border-base-200 text-center text-sm">
                <p class="text-gray-400">Belum punya tim?
                    <a href="<?= BASE_URL; ?>/register" class="text-primary font-bold hover:underline">Daftar di
                        sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>