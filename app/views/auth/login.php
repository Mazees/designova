<?php require_once '../app/views/layouts/header.php'; ?>

<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8 border border-gray-200">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login Ke Akun Anda</h2>
    <div class="p-4 mb-4 bg-yellow-50 text-yellow-800 border-l-4 border-yellow-500 rounded text-sm">
        <strong>Placeholder:</strong> Form login sesungguhnya belum diimplementasikan. Gunakan navigasi header atau Google SSO untuk simulasi role.
    </div>
    
    <div class="space-y-4">
        <a href="<?= BASE_URL; ?>/auth/google" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
            Masuk dengan Google SSO (Simulasi)
        </a>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
