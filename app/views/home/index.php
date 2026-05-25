<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Hero Section -->
<section class="relative bg-white py-16 lg:py-24 overflow-hidden">
    <div class="container mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <!-- Hero Text -->
        <div class="lg:col-span-6 space-y-6 text-left">
            <span class="badge bg-base-200 text-base-content/75 font-bold uppercase tracking-widest px-4 py-3 text-xs">
                Kompetisi UI/UX Nasional
            </span>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-neutral-content tracking-tight leading-tight">
                Tunjukkan Skill UI/UX Kamu di
                <span
                    class="badge badge-primary font-black px-4 py-6 rounded-2xl inline-block mt-2 shadow-sm text-2xl sm:text-3xl lg:text-4xl h-auto">
                    Designova
                </span>
            </h2>
            <p class="text-lg text-muted max-w-lg leading-relaxed font-medium">
                Platform kompetisi desain antarmuka paling prestisius. Bangun portofolio, dapatkan feedback dari expert,
                dan raih kesempatan karir di industri teknologi.
            </p>
            <div class="pt-4">
                <a href="<?= BASE_URL; ?>/login"
                    class="btn btn-primary px-8 py-4 rounded-xl font-extrabold text-md shadow-lg shadow-primary/20 hover:shadow-xl hover:shadow-primary/30 h-auto">
                    <span>Mulai Beraksi</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Hero Images / Mockup -->
        <div class="lg:col-span-6 relative flex justify-center lg:justify-end">
            <!-- Laptop Image Container -->
            <div class="relative w-full max-w-lg lg:max-w-xl">
                <img src="<?= BASE_URL; ?>/assets/images/laptop_mockup.png" alt="Designova Dashboard Mockup"
                    class="w-full h-auto object-contain drop-shadow-2xl">

                <!-- Floating Total Hadiah Card -->
                <div
                    class="absolute -bottom-6 -left-6 card bg-base-100 rounded-2xl shadow-2xl border border-base-200 transform hover:scale-105 transition-all duration-300">
                    <div class="card-body p-4 flex-row items-center space-x-3.5 gap-0">
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm4.707 3.707a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L8.414 9H15a1 1 0 100-2H8.414l1.293-1.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400 font-semibold block">Total Hadiah</span>
                            <span class="text-lg font-black text-neutral-content">Rp 50.000.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="bg-base-200 py-20">
    <div class="container mx-auto px-6 text-center space-y-12">
        <div class="space-y-4 max-w-2xl mx-auto">
            <h3 class="text-3xl sm:text-4xl font-black text-neutral-content tracking-tight">Mengapa Ikut Designova?</h3>
            <p class="text-muted text-sm sm:text-base leading-relaxed">
                Lebih dari sekadar kompetisi, ini adalah panggung untuk membuktikan kemampuan desainmu di hadapan para
                profesional.
            </p>
        </div>

        <!-- Grid of Features -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 max-w-5xl mx-auto">
            <!-- Feature 1 (Wide card) -->
            <div
                class="md:col-span-8 card card-side bg-base-100 border border-base-200 shadow-md text-left group hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col md:flex-row">
                <div class="card-body p-8 md:w-1/2 flex flex-col justify-between space-y-4 gap-0">
                    <div class="space-y-3">
                        <h4 class="card-title text-xl font-extrabold text-neutral-content">Kasus Nyata Industri</h4>
                        <p class="text-xs text-muted leading-relaxed">
                            Selesaikan tantangan desain yang diadopsi dari problem statement nyata startup teknologi
                            terkemuka. Bukan sekadar redesign estetika, tapi problem solving.
                        </p>
                    </div>
                </div>
                <div class="md:w-1/2 relative min-h-[200px] bg-neutral overflow-hidden">
                    <img src="<?= BASE_URL; ?>/assets/images/case_study_bg.png" alt="Industrial Case Study Background"
                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-all duration-500">
                </div>
            </div>

            <!-- Feature 2 -->
            <div
                class="md:col-span-4 card bg-base-100 border border-base-200 shadow-md text-left hover:shadow-lg transition-all duration-300">
                <div class="card-body p-8 justify-between gap-4">
                    <div
                        class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-primary-content shadow-md shadow-primary/20">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L1 17l1.338-3.123C1.493 12.76 1 11.434 1 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="space-y-2">
                        <h4 class="card-title text-xl font-extrabold text-neutral-content">Feedback Expert</h4>
                        <p class="text-xs text-muted leading-relaxed">
                            Dapatkan review mendalam dari praktisi UI/UX senior untuk setiap submission kamu.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 3 -->
            <div
                class="md:col-span-4 card bg-base-100 border border-base-200 shadow-md text-left hover:shadow-lg transition-all duration-300">
                <div class="card-body p-8 justify-between gap-4">
                    <div
                        class="w-12 h-12 bg-accent rounded-2xl flex items-center justify-center text-accent-content shadow-md shadow-accent/20">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="space-y-2">
                        <h4 class="card-title text-xl font-extrabold text-neutral-content">Karir Fast-track</h4>
                        <p class="text-xs text-muted leading-relaxed">
                            Finalis berkesempatan mengikuti interview langsung dengan hiring partner kami.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 4 -->
            <div
                class="md:col-span-8 card card-side bg-base-100 border border-base-200 shadow-md text-left group hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col md:flex-row-reverse">
                <div class="card-body p-8 md:w-1/2 flex flex-col justify-between space-y-4 gap-0">
                    <div class="space-y-3">
                        <h4 class="card-title text-xl font-extrabold text-neutral-content">Networking Luas</h4>
                        <p class="text-xs text-gray-400 leading-relaxed">
                            Hubungkan dirimu dengan ratusan desainer dari seluruh Indonesia. Bagikan ide, kolaborasi,
                            dan bangun komunitas profesional barumu.
                        </p>
                    </div>
                </div>
                <div
                    class="md:w-1/2 relative min-h-[200px] bg-primary/10 overflow-hidden flex items-center justify-center">
                    <svg class="w-32 h-32 text-primary opacity-30 animate-pulse" fill="none" stroke="currentColor"
                        stroke-width="1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section id="timeline" class="bg-white py-20">
    <div class="container mx-auto px-6 text-center space-y-16">
        <div class="space-y-4 max-w-2xl mx-auto">
            <h3 class="text-3xl sm:text-4xl font-black text-neutral-content tracking-tight">Perjalanan Kompetisi</h3>
            <p class="text-muted text-sm sm:text-base leading-relaxed">Ikuti alur dan timeline penting untuk memastikan
                karya tim kamu masuk ke meja juri tepat waktu.</p>
        </div>

        <!-- DaisyUI Vertical Timeline Component -->
        <div class="max-w-4xl mx-auto text-left">
            <ul class="timeline timeline-vertical timeline-snap-icon max-md:timeline-compact">
                <!-- Step 1 -->
                <li>
                    <div class="timeline-middle text-primary">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <circle cx="10" cy="10" r="6" />
                        </svg>
                    </div>
                    <div class="timeline-start md:text-end mb-10">
                        <time class="font-mono text-xs text-gray-400 font-bold block mb-1">1 - 20 November 2023</time>
                        <div class="badge badge-accent mb-2 font-bold text-[10px] uppercase">Tahap 1</div>
                        <h4 class="text-lg font-extrabold text-neutral-content">Pendaftaran & Submission</h4>
                        <div
                            class="card bg-base-100 border border-base-200 shadow-sm mt-3 inline-block text-left max-w-md">
                            <div class="card-body p-5">
                                <p class="text-xs text-muted leading-relaxed">Daftarkan tim kamu, lakukan konfirmasi
                                    biaya pendaftaran, dan kumpulkan solusi desain terbaik berdasarkan case study yang
                                    disediakan.</p>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-base-200" />
                </li>

                <!-- Step 2 -->
                <li>
                    <hr class="bg-base-200" />
                    <div class="timeline-middle text-primary">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <circle cx="10" cy="10" r="6" />
                        </svg>
                    </div>
                    <div class="timeline-end mb-10">
                        <time class="font-mono text-xs text-gray-400 font-bold block mb-1">21 - 25 November 2023</time>
                        <div class="badge badge-accent mb-2 font-bold text-[10px] uppercase">Tahap 2</div>
                        <h4 class="text-lg font-extrabold text-neutral-content">Penjurian Tahap Awal</h4>
                        <div
                            class="card bg-base-100 border border-base-200 shadow-sm mt-3 inline-block text-left max-w-md">
                            <div class="card-body p-5">
                                <p class="text-xs text-muted leading-relaxed">Panel juri professional akan menyeleksi 10
                                    besar finalis terbaik secara ketat berdasarkan kriteria UI, UX, dan fungsionalitas
                                    purwarupa.</p>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-base-200" />
                </li>

                <!-- Step 3 -->
                <li>
                    <hr class="bg-base-200" />
                    <div class="timeline-middle text-primary">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <circle cx="10" cy="10" r="6" />
                        </svg>
                    </div>
                    <div class="timeline-start md:text-end mb-10">
                        <time class="font-mono text-xs text-gray-400 font-bold block mb-1">30 November 2023</time>
                        <div class="badge badge-accent mb-2 font-bold text-[10px] uppercase">Tahap 3</div>
                        <h4 class="text-lg font-extrabold text-neutral-content">Pengumuman & Pitching</h4>
                        <div
                            class="card bg-base-100 border border-base-200 shadow-sm mt-3 inline-block text-left max-w-md">
                            <div class="card-body p-5">
                                <p class="text-xs text-muted leading-relaxed">Presentasikan desainmu secara langsung
                                    secara daring di hadapan panel juri utama dan raih gelar kehormatan serta hadiah
                                    uang tunai.</p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Leaderboard Section -->
<section id="leaderboard" class="bg-base-200 py-20 border-t border-base-200/50">
    <div class="container mx-auto px-6 text-center space-y-12 max-w-4xl">
        <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
            <h3 class="text-3xl font-black text-neutral-content tracking-tight">Papan Peringkat</h3>
            <div class="badge badge-lg bg-base-200 text-base-content border-none font-bold text-xs">
                Status: Segera Hadir
            </div>
        </div>

        <!-- Empty State Card -->
        <div class="card bg-base-100 border border-base-200 shadow-md">
            <div class="card-body p-12 flex flex-col items-center justify-center space-y-4 gap-0">
                <div class="w-16 h-16 bg-base-200 rounded-2xl flex items-center justify-center text-muted shadow-sm">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div class="space-y-2 max-w-md">
                    <h4 class="card-title justify-center text-lg font-bold text-neutral-content">Belum Ada Data</h4>
                    <p class="text-xs text-muted leading-relaxed">
                        Papan peringkat akan aktif setelah tahap penjurian awal selesai. Persiapkan karya terbaikmu
                        untuk mengisi posisi puncak!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>