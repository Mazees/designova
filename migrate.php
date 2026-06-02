<?php
/**
 * migrate.php
 * 
 * Script untuk mengeksekusi semua query dari db.sql secara otomatis.
 * 
 * Cara penggunaan:
 *   CLI  : php migrate.php
 */

if (php_sapi_name() !== 'cli') {
    die("Script ini hanya bisa dijalankan melalui CLI.\n");
}

function out(string $msg, string $type = 'info'): void
{
    $prefix = match ($type) {
        'success' => "\033[32m✔\033[0m",
        'error'   => "\033[31m✘\033[0m",
        'warn'    => "\033[33m⚠\033[0m",
        default   => "\033[36mℹ\033[0m",
    };
    echo "$prefix $msg" . PHP_EOL;
}

// ─── Load konfigurasi database ──────────────────────────────────────
require_once __DIR__ . '/app/config/config.php';

out("Memulai migrasi database...");
out("Host: " . DB_HOST . " | Database: " . DB_NAME);

// ─── Baca file SQL ──────────────────────────────────────────────────
$sqlFile = __DIR__ . '/db.sql';

if (!file_exists($sqlFile)) {
    out("File db.sql tidak ditemukan di: $sqlFile", 'error');
    exit(1);
}

$sql = file_get_contents($sqlFile);

if (empty(trim($sql))) {
    out("File db.sql kosong.", 'warn');
    exit(0);
}

out("File db.sql berhasil dibaca (" . number_format(strlen($sql)) . " bytes)", 'success');

// ─── Koneksi ke MySQL (tanpa pilih database dulu, karena db.sql CREATE DATABASE sendiri) ─
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

if ($conn->connect_error) {
    out("Koneksi gagal: " . $conn->connect_error, 'error');
    exit(1);
}

out("Terhubung ke MySQL server.", 'success');

// ─── Eksekusi semua query menggunakan multi_query ───────────────────
// multi_query memungkinkan variabel SQL seperti @peserta_id tetap tersedia
// antar statement dalam satu koneksi yang sama.

$success = 0;
$errors  = 0;

if ($conn->multi_query($sql)) {
    do {
        // Ambil result set jika ada (untuk SELECT / SHOW)
        if ($result = $conn->store_result()) {
            $result->free();
        }
        $success++;
    } while ($conn->more_results() && $conn->next_result());

    // Cek apakah ada error di statement terakhir
    if ($conn->errno) {
        out("Error pada statement ke-$success: " . $conn->error, 'error');
        $errors++;
    }
} else {
    out("Gagal mengeksekusi query pertama: " . $conn->error, 'error');
    $errors++;
}

// ─── Ringkasan ──────────────────────────────────────────────────────
echo PHP_EOL;

if ($errors === 0) {
    out("✅ Migrasi selesai! $success statement berhasil dieksekusi.", 'success');
} else {
    out("⚠️  Migrasi selesai dengan $errors error. $success statement diproses.", 'warn');
}

$conn->close();

exit($errors > 0 ? 1 : 0);
