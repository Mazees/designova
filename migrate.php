<?php
/**
 * migrate.php
 * 
 * Script untuk mengeksekusi semua query dari db.sql secara otomatis.
 * 
 * Cara penggunaan:
 *   CLI  : php migrate.php
 *   Web  : http://localhost/designova/migrate.php
 */

// ─── Deteksi environment ────────────────────────────────────────────
$isCli = (php_sapi_name() === 'cli');

function out(string $msg, bool $isCli, string $type = 'info'): void
{
    if ($isCli) {
        $prefix = match ($type) {
            'success' => "\033[32m✔\033[0m",
            'error'   => "\033[31m✘\033[0m",
            'warn'    => "\033[33m⚠\033[0m",
            default   => "\033[36mℹ\033[0m",
        };
        echo "$prefix $msg" . PHP_EOL;
    } else {
        $color = match ($type) {
            'success' => '#22c55e',
            'error'   => '#ef4444',
            'warn'    => '#eab308',
            default   => '#3b82f6',
        };
        echo "<div style=\"color:$color;font-family:monospace;margin:2px 0;\">$msg</div>";
    }
}

// ─── Load konfigurasi database ──────────────────────────────────────
require_once __DIR__ . '/app/config/config.php';

// ─── Header (web only) ─────────────────────────────────────────────
if (!$isCli) {
    echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>DB Migration</title></head>';
    echo '<body style="background:#0f172a;color:#e2e8f0;padding:2rem;font-family:monospace;">';
    echo '<h2 style="color:#38bdf8;">⚡ Designova — Database Migration</h2><hr style="border-color:#334155;">';
}

out("Memulai migrasi database...", $isCli);
out("Host: " . DB_HOST . " | Database: " . DB_NAME, $isCli);

// ─── Baca file SQL ──────────────────────────────────────────────────
$sqlFile = __DIR__ . '/db.sql';

if (!file_exists($sqlFile)) {
    out("File db.sql tidak ditemukan di: $sqlFile", $isCli, 'error');
    exit(1);
}

$sql = file_get_contents($sqlFile);

if (empty(trim($sql))) {
    out("File db.sql kosong.", $isCli, 'warn');
    exit(0);
}

out("File db.sql berhasil dibaca (" . number_format(strlen($sql)) . " bytes)", $isCli, 'success');

// ─── Koneksi ke MySQL (tanpa pilih database dulu, karena db.sql CREATE DATABASE sendiri) ─
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

if ($conn->connect_error) {
    out("Koneksi gagal: " . $conn->connect_error, $isCli, 'error');
    exit(1);
}

out("Terhubung ke MySQL server.", $isCli, 'success');

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
        out("Error pada statement ke-$success: " . $conn->error, $isCli, 'error');
        $errors++;
    }
} else {
    out("Gagal mengeksekusi query pertama: " . $conn->error, $isCli, 'error');
    $errors++;
}

// ─── Ringkasan ──────────────────────────────────────────────────────
echo $isCli ? PHP_EOL : '<hr style="border-color:#334155;">';

if ($errors === 0) {
    out("✅ Migrasi selesai! $success statement berhasil dieksekusi.", $isCli, 'success');
} else {
    out("⚠️  Migrasi selesai dengan $errors error. $success statement diproses.", $isCli, 'warn');
}

$conn->close();

if (!$isCli) {
    echo '<br><a href="' . BASE_URL . '" style="color:#38bdf8;">← Kembali ke aplikasi</a>';
    echo '</body></html>';
}

exit($errors > 0 ? 1 : 0);
