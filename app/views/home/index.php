<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Hero Section -->
<section class="relative flex items-center justify-center flex-col h-[calc(100vh-64px)] bg-base-100 py-20 lg:py-32 overflow-hidden border-b border-base-200">

    <div class="container mx-auto px-6 max-w-5xl relative z-10 text-center space-y-3" data-aos="fade-up">
        <!-- Event Badge -->
        <div
            class="inline-flex items-center gap-2 text-neutral font-extrabold text-[10px] px-4 py-1.5 rounded-full bg-primary uppercase tracking-widest mx-auto">
            Kompetisi UI/UX Nasional
        </div>

        <!-- Hero Title -->
        <h1
            class="text-4xl sm:text-5xl lg:text-7xl font-black text-base-content tracking-tight leading-none max-w-4xl mx-auto">
            Masa Depan Antarmuka<br>
            Dimulai di <span class="text-primary">Designova</span>
        </h1>

        <!-- Description -->
        <p class="text-base-content/60 max-w-2xl mx-auto leading-relaxed font-medium">
            Tunjukkan bakat terbaikmu dalam merancang pengalaman digital. Bangun portofolio kelas dunia, dapatkan umpan
            balik dari para ahli, dan raih penghargaan tingkat nasional.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-wrap justify-center gap-4 pt-4">
            <a href="<?= BASE_URL; ?>/register"
                class="btn btn-primary btn-md px-8 font-black rounded-xl text-primary-content shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform duration-200">
                Daftar Sekarang
            </a>
            <a href="#fokus"
                class="btn btn-ghost btn-md px-6 font-black rounded-xl border border-base-200 hover:bg-base-200">
                Pelajari Detail
            </a>
        </div>
    </div>
</section>

<!-- Tema Lomba Section -->
<section id="tema" class="bg-base-200 py-20 border-b border-base-200">
    <div class="container mx-auto px-6 max-w-5xl space-y-12">
        <div class="space-y-4 max-w-3xl mx-auto text-center" data-aos="fade-up">
            <span
                class="badge badge-primary badge-outline font-bold uppercase tracking-widest text-[9px] py-2 px-3">Tema
                Utama</span>
            <h2 class="text-3xl sm:text-4xl font-black text-base-content tracking-tight">Design for Better Life</h2>
            <p class="text-base-content/60 text-sm leading-relaxed font-medium">
                Tahun ini, Designova mengangkat tema <strong>Design for Better Life</strong> yang menantang para
                desainer UI/UX untuk menciptakan solusi rancangan antarmuka yang ramah, inklusif, dan mampu
                menyelesaikan permasalahan nyata dalam kehidupan sehari-hari. Fokus pengerjaan karya diarahkan pada tiga
                sub-fokus berikut:
            </p>
        </div>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Focus 1: Education -->
            <div class="card bg-base-100 border border-base-200 shadow-sm hover-lift" data-aos="fade-up"
                data-aos-delay="100">
                <div class="card-body p-6 justify-between gap-6">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="space-y-2">
                        <h3 class="card-title text-lg font-black text-base-content">Education &amp; Learning UX</h3>
                        <p class="text-xs text-base-content/60 leading-relaxed font-medium">
                            Mendesain antarmuka platform belajar interaktif, sistem edukasi inklusif, atau aplikasi
                            keterampilan yang menyenangkan bagi semua usia.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Focus 2: Health & Wellness -->
            <div class="card bg-base-100 border border-base-200 shadow-sm hover-lift" data-aos="fade-up"
                data-aos-delay="200">
                <div class="card-body p-6 justify-between gap-6">
                    <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <div class="space-y-2">
                        <h3 class="card-title text-lg font-black text-base-content">Health &amp; Wellness UX</h3>
                        <p class="text-xs text-base-content/60 leading-relaxed font-medium">
                            Mendesain antarmuka aplikasi gaya hidup sehat, pemantau kondisi fisik, atau platform
                            konsultasi medis yang menenangkan dan mudah dipahami.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Focus 3: Small Business & Community -->
            <div class="card bg-base-100 border border-base-200 shadow-sm hover-lift" data-aos="fade-up"
                data-aos-delay="300">
                <div class="card-body p-6 justify-between gap-6">
                    <div class="w-12 h-12 bg-accent/10 text-accent rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div class="space-y-2">
                        <h3 class="card-title text-lg font-black text-base-content">Small Business UX
                        </h3>
                        <p class="text-xs text-base-content/60 leading-relaxed font-medium">
                            Mendesain solusi antarmuka untuk membantu pencatatan usaha kecil, pemberdayaan komunitas
                            lokal, atau transaksi jual-beli yang sederhana.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Timeline / Alur Roadmap Section -->
<section id="timeline" class="bg-base-100 py-20 border-b border-base-200">
    <div class="container mx-auto px-6 max-w-5xl flex flex-col items-center justify-center gap-16">
        <div class="space-y-4 max-w-2xl mx-auto text-center" data-aos="fade-up">
            <span
                class="badge badge-primary badge-outline font-bold uppercase tracking-widest text-[9px] py-2 px-3">Roadmap</span>
            <h2 class="text-3xl sm:text-4xl font-black text-base-content tracking-tight">Alur Kompetisi</h2>
            <p class="text-base-content/60 text-sm sm:text-base leading-relaxed font-medium">
                Pahami tahapan penting kompetisi dari pendaftaran hingga sesi final pitching untuk memastikan kesiapan
                tim Anda.
            </p>
        </div>

        <ul class="timeline timeline-vertical lg:timeline-horizontal" data-aos="fade-up" data-aos-delay="200">
            </li>
            <li>
                <div class="timeline-start">20 Mei 2026</div>
                <div class="timeline-middle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                        <path fillRule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clipRule="evenodd" />
                    </svg>
                </div>
                <div class="timeline-end timeline-box">Registrasi</div>
                <hr />
            </li>
            <li>
                <hr />
                <div class="timeline-start">1 Juni 2026</div>
                <div class="timeline-middle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                        <path fillRule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clipRule="evenodd" />
                    </svg>
                </div>
                <div class="timeline-end timeline-box">Penutupan Registrasi</div>
                <hr />
            </li>
            <li>
                <hr />
                <div class="timeline-start">2 Juni 2026</div>
                <div class="timeline-middle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                        <path fillRule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clipRule="evenodd" />
                    </svg>
                </div>
                <div class="timeline-end timeline-box">Submission</div>
                <hr />
            </li>
            <li>
                <hr />
                <div class="timeline-start">2 Juli 2026</div>
                <div class="timeline-middle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                        <path fillRule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clipRule="evenodd" />
                    </svg>
                </div>
                <div class="timeline-end timeline-box">Penjurian</div>
                <hr />
            </li>
            <li>
                <hr />
                <div class="timeline-start">15 Juli 2026</div>
                <div class="timeline-middle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                        <path fillRule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clipRule="evenodd" />
                    </svg>
                </div>
                <div class="timeline-end timeline-box">Pengumuman Pemenang</div>
                <hr />
            </li>
        </ul>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="bg-base-200 py-20 border-b border-base-200">
    <div class="container mx-auto px-6 max-w-3xl space-y-12">
        <div class="space-y-4 text-center" data-aos="fade-up">
            <span
                class="badge badge-primary badge-outline font-bold uppercase tracking-widest text-[9px] py-2 px-3">Bantuan</span>
            <h2 class="text-3xl font-black text-base-content tracking-tight">Pertanyaan Umum</h2>
            <p class="text-base-content/60 text-xs sm:text-sm font-medium">
                Ada pertanyaan lain? Cari jawaban cepat atas pertanyaan yang sering diajukan di bawah ini.
            </p>
        </div>

        <!-- FAQ Accordion -->
        <div class="space-y-3" data-aos="fade-up" data-aos-delay="100">
            <!-- Q1 -->
            <details class="collapse collapse-arrow bg-base-100 border border-base-300 rounded-2xl group">
                <summary class="collapse-title text-sm font-black text-base-content py-4 cursor-pointer select-none">
                    Siapa saja yang dapat berpartisipasi dalam kompetisi Designova?
                </summary>
                <div class="collapse-content px-6 pb-5 text-xs text-base-content/60 leading-relaxed font-medium">
                    Kompetisi ini terbuka untuk mahasiswa aktif (D3/D4/S1) dan umum/profesional di seluruh Indonesia
                    dengan batasan usia peserta 17–25 tahun. Setiap tim diperbolehkan terdiri dari kolaborasi lintas
                    instansi.
                </div>
            </details>

            <!-- Q2 -->
            <details class="collapse collapse-arrow bg-base-100 border border-base-300 rounded-2xl group">
                <summary class="collapse-title text-sm font-black text-base-content py-4 cursor-pointer select-none">
                    Apa saja kriteria utama yang dinilai oleh dewan juri?
                </summary>
                <div class="collapse-content px-6 pb-5 text-xs text-base-content/60 leading-relaxed font-medium">
                    Penilaian berfokus pada 4 pilar utama UI/UX: Riset Pengguna & Pemecahan Masalah (UX Research),
                    Arsitektur Informasi & Alur Pengguna (User Flow), Desain Visual (UI Design & Sistem Desain), serta
                    Pengujian Pengguna & Prototipe Interaktif (Usability Testing).
                </div>
            </details>

            <!-- Q3 -->
            <details class="collapse collapse-arrow bg-base-100 border border-base-300 rounded-2xl group">
                <summary class="collapse-title text-sm font-black text-base-content py-4 cursor-pointer select-none">
                    Bagaimana ketentuan orisinalitas karya dalam kompetisi ini?
                </summary>
                <div class="collapse-content px-6 pb-5 text-xs text-base-content/60 leading-relaxed font-medium">
                    Karya yang dikumpulkan harus orisinal dan belum pernah memenangkan penghargaan di kompetisi lain
                    sebelumnya. Penggunaan aset UI Kit gratis diperbolehkan hanya untuk komponen pendukung umum, namun
                    ide utama dan sistem desain harus orisinal.
                </div>
            </details>

            <!-- Q4 -->
            <details class="collapse collapse-arrow bg-base-100 border border-base-300 rounded-2xl group">
                <summary class="collapse-title text-sm font-black text-base-content py-4 cursor-pointer select-none">
                    Apakah prototipe desain harus berupa kode pemrograman yang siap pakai?
                </summary>
                <div class="collapse-content px-6 pb-5 text-xs text-base-content/60 leading-relaxed font-medium">
                    Tidak perlu. Kompetisi ini berfokus pada desain UI/UX saja. Karya akhir cukup dikirimkan dalam
                    bentuk high-fidelity interactive prototype (disarankan Figma) yang mensimulasikan alur navigasi
                    serta mikro-interaksi secara realistis tanpa perlu menulis kode program.
                </div>
            </details>

            <!-- Q5 -->
            <details class="collapse collapse-arrow bg-base-100 border border-base-300 rounded-2xl group">
                <summary class="collapse-title text-sm font-black text-base-content py-4 cursor-pointer select-none">
                    Bagaimana format dan alur pengumpulan karya kompetisi?
                </summary>
                <div class="collapse-content px-6 pb-5 text-xs text-base-content/60 leading-relaxed font-medium">
                    Seluruh berkas dikumpulkan secara digital melalui dashboard akun tim Anda. Pengumpulan mencakup
                    tautan (link) Figma Prototype aktif serta folder Google Drive publik berisi presentasi Pitch Deck
                    (PDF) dan berkas aset pendukung.
                </div>
            </details>

            <!-- Q6 -->
            <details class="collapse collapse-arrow bg-base-100 border border-base-300 rounded-2xl group">
                <summary class="collapse-title text-sm font-black text-base-content py-4 cursor-pointer select-none">
                    Apakah diperbolehkan mengganti anggota tim di tengah jalannya kompetisi?
                </summary>
                <div class="collapse-content px-6 pb-5 text-xs text-base-content/60 leading-relaxed font-medium">
                    Pergantian anggota tim hanya diizinkan sebelum tahap pengumpulan karya utama dimulai, dengan
                    mengajukan permohonan resmi kepada panitia melalui email dukungan atau kontak resmi yang tersedia.
                </div>
            </details>
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section class="bg-base-100 py-20 relative overflow-hidden">
    <div class="container mx-auto px-6 max-w-4xl text-center space-y-6 relative z-10" data-aos="zoom-in">
        <h2 class="text-3xl sm:text-5xl font-black text-base-content tracking-tight">Siap Merancang Solusi Kreatif?</h2>
        <p class="text-sm text-base-content/60 max-w-xl mx-auto leading-relaxed font-medium">
            Daftarkan tim Anda sekarang dan buktikan keahlian visual serta kepekaan pengalaman pengguna tim Anda di
            panggung nasional.
        </p>
        <div class="pt-4">
            <a href="<?= BASE_URL; ?>/register"
                class="btn btn-primary btn-md">
                Mulai Registrasi Tim
            </a>
        </div>
    </div>
</section>

<?php require_once '../app/views/layouts/footer.php'; ?>