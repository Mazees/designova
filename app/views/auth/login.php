<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="max-w-lg mx-auto my-12">
    <!-- Card Container with clean shadow & gradient border top -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform transition-all hover:shadow-2xl duration-300">
        
        <!-- Header Brand Accent -->
        <div class="h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

        <div class="p-8">
            <h2 class="text-3xl font-extrabold text-gray-800 text-center tracking-tight mb-2">Selamat Datang Kembali</h2>
            <p class="text-sm text-gray-500 text-center mb-8">Masuk ke akun Designova Anda untuk melanjutkan kompetisi</p>

            <!-- Alert Error jika login gagal -->
            <?php if (!empty($errors) && is_array($errors)): ?>
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg text-red-800 text-sm animate-pulse">
                    <div class="flex items-center mb-1">
                        <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">Terjadi kesalahan:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 pl-2">
                        <?php foreach ($errors as $err): ?>
                            <li><?= htmlspecialchars($err); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form Login -->
            <form method="post" action="<?= BASE_URL; ?>/login" class="space-y-6">
                
                <!-- Input Email -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </span>
                        <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required
                            class="pl-10 w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 text-gray-700" 
                            placeholder="nama@email.com" />
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider">Kata Sandi (Password)</label>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </span>
                        <input type="password" name="password" required
                            class="pl-10 w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 text-gray-700" 
                            placeholder="Masukkan password Anda" />
                    </div>
                </div>

                <!-- Button Submit -->
                <button type="submit" 
                    class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg hover:shadow-indigo-500/30 transition-all duration-200 transform hover:-translate-y-0.5">
                    Masuk
                </button>
            </form>

            <!-- Link Alternatif -->
            <div class="mt-8 pt-6 border-t border-gray-100 text-center text-sm">
                <p class="text-gray-500">Belum memiliki akun? 
                    <a href="<?= BASE_URL; ?>/register" class="text-indigo-600 hover:text-indigo-700 font-semibold hover:underline">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>