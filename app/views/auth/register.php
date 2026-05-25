<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-2xl mx-auto my-10 px-4">
    <!-- Card Container with clean shadow & gradient border top -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
        
        <!-- Header Brand Accent -->
        <div class="h-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

        <div class="p-8 sm:p-10">
            <h2 class="text-3xl font-extrabold text-gray-800 text-center tracking-tight mb-2">Pendaftaran Tim Baru</h2>
            <p class="text-sm text-gray-500 text-center mb-8">Lengkapi formulir di bawah ini untuk mendaftarkan tim Anda di kompetisi Designova</p>

            <!-- Alert Error jika ada data tidak valid -->
            <?php if (!empty($errors) && is_array($errors)): ?>
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl text-red-800 text-sm animate-pulse">
                    <div class="flex items-center mb-1">
                        <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">Mohon perbaiki kesalahan berikut:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 pl-2">
                        <?php foreach ($errors as $err): ?>
                            <li><?= htmlspecialchars($err); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form Pendaftaran -->
            <form method="post" action="<?= BASE_URL; ?>/register" class="space-y-6">
                
                <!-- SECTION 1: Akun Ketua Tim -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                        <span class="bg-indigo-100 text-indigo-600 rounded-full w-6 h-6 flex items-center justify-center text-xs mr-2 font-mono">1</span>
                        Informasi Akun Ketua
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Input Nama Ketua -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Nama Ketua Tim</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 text-gray-700" 
                                placeholder="Nama lengkap ketua" />
                        </div>

                        <!-- Input Email -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Email Ketua (Untuk Login)</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 text-gray-700" 
                                placeholder="nama@email.com" />
                        </div>

                        <!-- Input Password -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Kata Sandi</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 text-gray-700" 
                                placeholder="Minimal 6 karakter" />
                        </div>

                        <!-- Input Konfirmasi Password -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Konfirmasi Sandi</label>
                            <input type="password" name="confirm_password" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 text-gray-700" 
                                placeholder="Ketik ulang sandi" />
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100 my-6">

                <!-- SECTION 2: Informasi Tim -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                        <span class="bg-indigo-100 text-indigo-600 rounded-full w-6 h-6 flex items-center justify-center text-xs mr-2 font-mono">2</span>
                        Detail Tim & Anggota
                    </h3>
                    <div class="space-y-4">
                        <!-- Input Nama Tim -->
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Nama Tim Kompetisi</label>
                            <input type="text" name="team_name" value="<?= htmlspecialchars($old['team_name'] ?? '') ?>" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 text-gray-700" 
                                placeholder="Masukkan nama tim kreatif Anda" />
                        </div>

                        <!-- Input Anggota Lainnya -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Anggota Tim 1 (Opsional)</label>
                                <input type="text" name="member_1" value="<?= htmlspecialchars($old['member_1'] ?? '') ?>"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 text-gray-700" 
                                    placeholder="Nama anggota kedua" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Anggota Tim 2 (Opsional)</label>
                                <input type="text" name="member_2" value="<?= htmlspecialchars($old['member_2'] ?? '') ?>"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 text-gray-700" 
                                    placeholder="Nama anggota ketiga" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button Submit -->
                <button type="submit" 
                    class="w-full mt-4 py-3.5 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg hover:shadow-indigo-500/30 transition-all duration-200 transform hover:-translate-y-0.5">
                    Daftarkan Tim Kami
                </button>
            </form>

            <!-- Link Alternatif -->
            <div class="mt-8 pt-6 border-t border-gray-100 text-center text-sm">
                <p class="text-gray-500">Sudah memiliki akun? 
                    <a href="<?= BASE_URL; ?>/login" class="text-indigo-600 hover:text-indigo-700 font-semibold hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
