<?php
header("HTTP/1.0 404 Not Found");
?>
<!DOCTYPE html>
<html lang="id" data-theme="designova-pallet">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link rel="icon" type="image/svg+xml" href="<?= defined('BASE_URL') ? BASE_URL : ''; ?>/assets/icon.svg">
    <!-- Compiled Tailwind CSS v4 + DaisyUI -->
    <link href="<?= defined('BASE_URL') ? BASE_URL : ''; ?>/src/output.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Righteous&display=swap" rel="stylesheet">
</head>
<body class="bg-primary min-h-screen flex flex-col items-center justify-center p-6 font-['Poppins'] text-primary-content relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none opacity-20">
        <div class="absolute -top-[20%] -right-[10%] w-[50vw] h-[50vw] rounded-full bg-white blur-3xl"></div>
        <div class="absolute -bottom-[20%] -left-[10%] w-[60vw] h-[60vw] rounded-full bg-black blur-3xl"></div>
    </div>

    <div class="text-center z-10 max-w-3xl mx-auto">
        <h1 class="text-[10rem] md:text-[14rem] font-black leading-none font-['Righteous'] drop-shadow-2xl mb-2 text-white">404</h1>
        <h2 class="text-3xl md:text-5xl font-bold mb-6 text-white drop-shadow-md">Oops! Halaman Tidak Ditemukan</h2>
        <p class="text-lg md:text-xl text-white/90 mb-10 font-medium max-w-2xl mx-auto leading-relaxed">
            Maaf, halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau sementara tidak tersedia. 
            Mari kembali ke jalur yang benar!
        </p>
        <a href="<?= defined('BASE_URL') ? BASE_URL : ''; ?>/" class="inline-flex items-center gap-2 bg-white text-primary font-bold text-lg px-8 py-4 rounded-full shadow-[0_8px_30px_rgb(0,0,0,0.12)] hover:-translate-y-1 hover:shadow-[0_15px_40px_rgb(0,0,0,0.2)] transition-all duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>
