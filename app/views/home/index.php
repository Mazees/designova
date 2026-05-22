<?php require_once '../app/views/layouts/header.php'; ?>

<div class="text-center py-12">
    <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">
        Selamat Datang di <span class="text-indigo-600">Designova</span>
    </h2>
    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
        Platform siklus penuh kompetisi desain UI/UX terintegrasi.
    </p>
    <div class="mt-8 flex justify-center space-x-4">
        <a href="<?= BASE_URL; ?>/login" class="px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 shadow-md">
            Mulai Sekarang
        </a>
        <a href="<?= BASE_URL; ?>/register" class="px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 shadow-sm">
            Daftar Tim
        </a>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
