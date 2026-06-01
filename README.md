# 🎨 Designova - Platform Kompetisi UI/UX

**Designova** adalah aplikasi web berbasis **PHP Native (OOP)** dengan arsitektur **MVC (Model-View-Controller)** mandiri yang dirancang khusus untuk mengelola siklus penuh kompetisi desain (UI/UX). Aplikasi ini memfasilitasi proses registrasi tim, pembayaran pendaftaran berbasis QRIS Dinamis, pengumpulan karya (submisi Figma & Google Drive), hingga rekapitulasi penilaian dewan juri.

---

## 👥 Kelompok 5 - Anggota Tim & Pembagian Tugas

Aplikasi ini dikembangkan oleh Kelompok 5 dengan pembagian tugas sebagai berikut:

- **Mada Putra Adhadriyanto (24081010192)**
  - Halaman Publik (Landing Page)
  - Sistem Autentikasi & Pembayaran
  - Halaman Pengelola (Dashboard Admin - Settings)
- **Moch. Raihan Ardani (24081010174)**
  - Halaman Peserta (Dashboard Tim Overview, Pengumpulan Karya)
- **Muhammad Rizky Puspojati (24081010019)**
  - Halaman Juri (Dashboard Evaluasi & Form Penilaian Juri)

---

## 📂 Struktur Direktori Proyek

Proyek ini menggunakan pemisahan yang bersih antara berkas logika aplikasi (**`app/`**) dan berkas publik yang dapat diakses langsung oleh web server (**`public/`**).

```text
designova/
├── app/
│   ├── config/
│   │   └── config.php          # Konfigurasi database & variabel global (BASE_URL, dll.)
│   ├── controllers/            # Controller untuk memproses request & me-render view
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   ├── HomeController.php
│   │   ├── JuriController.php
│   │   └── PaymentController.php
│   ├── core/                   # Kelas inti kerangka kerja (Core Framework)
│   │   ├── Controller.php      # Base Controller (View loader & RBAC protectRoute)
│   │   ├── Database.php        # Helper koneksi database menggunakan MySQLi (mysqli_connect)
│   │   └── Router.php          # Custom Router dengan pencocokan URL dan segmen dinamis
│   ├── models/                 # Model untuk interaksi langsung dengan tabel database MySQL
│   │   ├── Payment.php
│   │   ├── Setting.php
│   │   ├── Submissions.php
│   │   ├── Team.php
│   │   └── User.php
│   ├── services/               # Layanan pendukung logika bisnis aplikasi
│   │   ├── AuthService.php     # Logika pendaftaran tim, verifikasi login & manipulasi sesi
│   │   └── QrisService.php     # Algoritma CRC16 untuk konversi QRIS Statis ke QRIS Dinamis
│   └── views/                  # Berkas UI / Tampilan (HTML + TailwindCSS / DaisyUI)
│       ├── admin/              # Dashboard Pengelola (Statistik, Tim, Leaderboard, Settings)
│       ├── auth/               # Formulir Login & Register
│       ├── home/               # Landing Page Utama
│       ├── juri/               # Dashboard Penilaian Dewan Juri
│       ├── layouts/            # File header, footer, & sidebar global
│       └── participant/        # Dashboard Tim Peserta (Overview, Payment, Submission)
├── public/
│   ├── assets/                 # Berkas aset statis (gambar, ikon)
│   ├── src/
│   │   ├── input.css           # Berkas input untuk kompilasi Tailwind CSS
│   │   └── output.css          # Berkas output css hasil kompilasi Tailwind CSS v4
│   ├── .htaccess               # Aturan Apache Rewrite untuk merutekan request ke index.php
│   └── index.php               # Front Controller (Titik masuk utama aplikasi)
├── workflow/                   # Catatan rancangan, skema sistem & referensi alur kerja
├── .htaccess                   # Rewrite root untuk redirect transparan ke public/
├── db.sql                      # Skema DDL Database MySQL
├── create_admin.php            # Script CLI untuk membuat / memperbarui user admin
└── README.md                   # Dokumentasi utama proyek
```

---

## 🔑 Sistem Manajemen Hak Akses (RBAC)

Aplikasi menerapkan **Role-Based Access Control (RBAC)** yang ketat dan aman lewat middleware `Controller::protectRoute()` untuk memfilter hak akses setiap pengguna berdasarkan perannya:

1.  **Guest (Belum Login)**
    - Hanya dapat melihat Landing Page (`/`), halaman Login (`/login`), dan Register (`/register`).
2.  **Peserta Non-Aktif (Sudah Login, Belum Membayar/Diverifikasi)**
    - Akses terkunci. Diarahkan paksa (_redirect_) ke Halaman Pembayaran (`/payment`). Tidak bisa mengakses Dashboard Tim (`/dashboard`) atau halaman Submisi (`/submission`).
3.  **Peserta Aktif (Sudah Login, Pembayaran Terverifikasi)**
    - Memiliki akses penuh ke Halaman Overview Tim (`/dashboard`) dan Pengumpulan Karya (`/submission`).
    - Tidak dapat mengakses kembali halaman pembayaran (`/payment`) atau halaman milik Juri/Admin.
4.  **Juri (Sudah Login)**
    - Memiliki akses eksklusif ke Dashboard Evaluasi (`/juri/dashboard`) dan Form Penilaian (`/juri/review/{team_id}`).
5.  **Admin (Sudah Login - Super User)**
    - Memiliki akses penuh ke semua modul administrasi di bawah rute `/admin/*` (Dashboard statistik, verifikasi tim, papan leaderboard, dan pengaturan sistem).

---

## 🛣️ Pemetaan Rute (Routing Table)

Peta rute aplikasi didaftarkan pada Front Controller [public/index.php](file:///D:/laragon/www/designova/public/index.php):

### 1. Halaman Publik (Akses Bebas)

| URL / Route | HTTP Method   | Controller & Method          | Tampilan File View  | Deskripsi                                       |
| :---------- | :------------ | :--------------------------- | :------------------ | :---------------------------------------------- |
| `/`         | `GET`         | `HomeController::index()`    | `home/index.php`    | Landing Page Utama (Timeline & Info Lomba)      |
| `/login`    | `GET`, `POST` | `AuthController::login()`    | `auth/login.php`    | Form login satu pintu untuk semua role          |
| `/register` | `GET`, `POST` | `AuthController::register()` | `auth/register.php` | Form pendaftaran akun peserta & nama tim        |
| `/logout`   | `POST`        | `AuthController::logout()`   | -                   | Mengakhiri sesi pengguna & mengarahkan ke login |

### 2. Dashboard Peserta (Tim)

| URL / Route   | HTTP Method   | Controller & Method                 | Tampilan File View           | Deskripsi                                                             |
| :------------ | :------------ | :---------------------------------- | :--------------------------- | :-------------------------------------------------------------------- |
| `/payment`    | `GET`, `POST` | `PaymentController::index()`        | `participant/payment.php`    | Instruksi pembayaran, QRIS Dinamis & link WA                          |
| `/dashboard`  | `GET`         | `DashboardController::index()`      | `participant/dashboard.php`  | Overview tim, status akun & ringkasan submisi                         |
| `/submission` | `GET`, `POST` | `DashboardController::submission()` | `participant/submission.php` | Form input link Figma & Drive (otomatis tertutup jika lewat deadline) |

### 3. Dashboard Juri

| URL / Route              | HTTP Method   | Controller & Method                 | Tampilan File View   | Deskripsi                                            |
| :----------------------- | :------------ | :---------------------------------- | :------------------- | :--------------------------------------------------- |
| `/juri/dashboard`        | `GET`         | `JuriController::index()`           | `juri/dashboard.php` | Tabel ringkasan daftar karya peserta lomba           |
| `/juri/leaderboard`      | `GET`         | `AdminController::leaderboard()`    | `admin/leaderboard.php` | Papan peringkat tim kompetisi                      |
| `/juri/review/{team_id}` | `GET`, `POST` | `JuriController::review($team_id)`  | `juri/review.php`    | Form input nilai kriteria (UI, UX, Figma) & feedback |

### 4. Dashboard Admin (Pengelola)

| URL / Route          | HTTP Method   | Controller & Method              | Tampilan File View      | Deskripsi                                                   |
| :------------------- | :------------ | :------------------------------- | :---------------------- | :---------------------------------------------------------- |
| `/admin/dashboard`   | `GET`         | `AdminController::index()`       | `admin/dashboard.php`   | Ringkasan statistik (total tim, submisi, penilaian)         |
| `/admin/teams`       | `GET`, `POST` | `AdminController::teams()`       | `admin/teams.php`       | Tabel verifikasi status pembayaran peserta manual           |
| `/admin/leaderboard` | `GET`         | `AdminController::leaderboard()` | `admin/leaderboard.php` | Peringkat tim berdasarkan kalkulasi nilai dari database     |
| `/admin/settings`    | `GET`, `POST` | `AdminController::settings()`    | `admin/settings.php`    | Pengaturan base price, tanggal deadline & status registrasi |

---

## 🗃️ Skema Database (MySQL)

Struktur tabel di dalam berkas [db.sql](file:///D:/laragon/www/designova/db.sql) memiliki rincian sebagai berikut:

1.  **`users`**: Menyimpan kredensial pengguna dan peran dalam sistem.
    - Kolom: `id`, `name`, `email`, `password` (hashed), `role` (`'admin'`, `'juri'`, `'peserta'`), `created_at`, `updated_at`.
2.  **`teams`**: Representasi entitas tim peserta kompetisi yang berelasi dengan pengguna.
    - Kolom: `id`, `user_id` (FK `users.id`), `team_name`, `members` (JSON - list nama anggota), `is_active` (0 = nonaktif, 1 = aktif/terverifikasi), `created_at`, `updated_at`.
3.  **`submissions`**: Tempat menampung tautan pengumpulan karya peserta sekaligus nilai dari juri.
    - Kolom: `id`, `team_id` (FK `teams.id`), `figma_link`, `docs_link`, `score_ui`, `score_ux`, `score_figma`, `final_score` (kolom kalkulasi otomatis MySQL dengan bobot: `UI*0.5 + UX*0.4 + Figma*0.1`), `feedback`, `created_at`, `updated_at`.
4.  **`payments`**: Pencatatan riwayat klaim pembayaran pendaftaran.
    - Kolom: `id`, `team_id` (FK `teams.id`), `amount`, `sender_name`, `sender_bank`, `status` (`'pending'`, `'confirmed'`, `'rejected'`), `pending_team_id` (generated column untuk membatasi 1 payment pending per tim), `created_at`, `updated_at`.
5.  **`settings`**: Pengaturan global aplikasi kompetisi.
    - Kolom: `id` (PK, dibatasi bernilai 1), `is_registration_open`, `base_price` (harga dasar lomba), `submission_deadline`, `is_winner_published`.

---

## ⚡ Fitur Utama & Logika Bisnis

- **Pendaftaran & Autentikasi**: Registrasi tim baru mendaftarkan entitas user baru dan data tim (nama tim beserta anggota dalam format JSON) dalam satu aksi transaksi. Kata sandi dienkripsi aman dengan `password_hash()`.
- **QRIS Dinamis**: Sistem menggunakan `QrisService` untuk memproses string QRIS statis bawaan dan menggabungkannya dengan nominal pendaftaran (`base_price` yang diset admin) serta kalkulasi bitwise CRC16. Hal ini menghasilkan kode QR dinamis yang dapat langsung discan oleh aplikasi pembayaran mobile.
- **Verifikasi Manual & Redirect WA**: Peserta mengirim data konfirmasi berupa nama dan bank pengirim, lalu sistem menyimpan data payment ke database, mengunci 1 payment pending per tim, dan memformat pesan otomatis yang mengarah langsung ke Whatsapp Admin. Saat tim sudah punya payment pending, halaman `/payment` langsung masuk ke step status pembayaran supaya tidak ada duplikasi pembayaran pending dari tim yang sama.
- **Perhitungan Nilai Otomatis**: Nilai akhir peserta dihitung di tingkat database menggunakan kolom _Generated Virtual Column_ MySQL:
  $$\text{Skor Akhir} = (\text{UI/Visual} \times 50\%) + (\text{UX/Flow} \times 40\%) + (\text{Kerapian Figma} \times 10\%)$$

---

## 🛠️ Status Implementasi Kode (Fungsionalitas Aktual)

Berikut adalah status terkini pengembangan fitur di codebase:

- **[✓] Core Engine**: Router kustom, database helper MySQLi, base controller, autoloader, dan middleware RBAC (`protectRoute`) berfungsi secara penuh.
- **[✓] Alur Autentikasi**: Halaman register tim, login multi-role, dan logout terhubung penuh dengan tabel `users` dan `teams`.
- **[✓] Alur Pembayaran & QRIS**: Integrasi `QrisService` berjalan mulus untuk menghasilkan visualisasi QR code pendaftaran dinamis di halaman `/payment`.
- **[✓] Alur Status Pembayaran**: Halaman `/payment` memiliki step status pembayaran yang persisten, menampilkan ID pembayaran, status, nama pengirim, bank pengirim, dan tombol konfirmasi via WhatsApp.
- **[✓] Pengumpulan Karya (Submisi)**: Halaman `/submission` melayani pengunggahan link Figma dan GDrive dengan **validasi Regex ganda** (HTML5 `pattern` & PHP `preg_match`). Dilengkapi fitur perhitungan mundur deadline otomatis, serta menampilkan kartu **Status Penilaian** yang responsif (menampilkan apakah karya sudah dinilai, _feedback_ dari dewan juri, beserta SVG icons dan timestamp pembaruan).
- **[✓] Dashboard Admin & Juri**: Halaman juri (`/juri/*`) dan halaman admin (`/admin/*`) kini telah terintegrasi secara dinamis dengan query SQL nyata (seperti manajemen peserta, verifikasi pembayaran manual, formulir penilaian juri, leaderboard dengan ekspor CSV, dan pengaturan sistem).
- **[✓] Standar Kode & MVC Bersih**: Seluruh logika kalkulasi kompleks (seperti sisa hari deadline, penentuan CSS classes dinamis, atau status penilaian) diisolasi dengan rapi di dalam _Controller_. _View_ hanya bertugas merender data yang divalidasi dengan operator _null-coalescing_ atau pengecekan `!empty()` guna menghindari _undefined variables warning_.

---

## ⚙️ Panduan Instalasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek Designova di komputer lokal Anda:

### 1. Prasyarat Sistem

- **Web Server**: Laragon (sangat disarankan) atau XAMPP.
- **PHP**: Versi 8.0 atau lebih tinggi.
- **Database**: MySQL / MariaDB.
- **Modul Apache**: `mod_rewrite` harus dalam keadaan aktif.

### 2. Migrasi & Impor Database Otomatis

Proyek ini dilengkapi dengan skrip **`migrate.php`** yang berfungsi mengeksekusi file `db.sql` secara otomatis. Skrip ini akan membuat database `designova` (jika belum ada), membuat seluruh tabel relasional, serta melakukan _seeding_ data awal (seperti pengaturan lomba, akun admin, akun peserta dummy, dan tim beserta karyanya).

Anda memiliki dua opsi mudah untuk menjalankan migrasi ini:

**Opsi A: Melalui CLI (Command Line)**
Buka terminal di direktori root proyek dan jalankan:
```bash
php migrate.php
```

**Opsi B: Melalui Web Browser**
Buka URL berikut di browser Anda:
```text
http://localhost/designova/migrate.php
```

Skrip akan memberikan laporan visual/teks mengenai jumlah _statement_ SQL yang berhasil dieksekusi atau error yang terjadi. Setelah migrasi sukses, database siap digunakan sepenuhnya!

### 3. Buat Admin Awal dengan Script CLI

Jika ingin membuat atau memperbarui akun admin tanpa membuka phpMyAdmin, Anda dapat menjalankan script CLI berikut dari direktori root proyek.

Jalankan perintah default (menggunakan data admin default):
```bash
php create_admin.php
```
*Data default: Nama = "Administrator", Email = "admin@designova.local", Password = "admin123"*

Atau, Anda dapat menentukan parameter/argumen kustom secara berurutan `"[Nama Admin]" "[Email Admin]" "[Password Admin]"` seperti berikut:
```bash
php create_admin.php "Nama Admin" "admin@domain.com" "password_baru"
```

Script ini akan otomatis melakukan hal berikut:
1. Memeriksa ketersediaan koneksi database.
2. Melakukan registrasi admin baru jika email belum terdaftar di tabel `users`.
3. Memperbarui nama, password, dan mengubah role menjadi `admin` jika email sudah terdaftar.
4. Menampilkan detail akun admin yang berhasil dibuat/diperbarui.

### 4. Buat Akun Peserta Massal (Bulk 10 Akun) untuk Testing

Untuk mempermudah pengujian alur verifikasi pembayaran admin, penilaian juri, leaderboard, dan pengunggahan submisi peserta, Anda dapat membuat 10 akun peserta beserta data timnya secara otomatis dengan menjalankan perintah berikut di direktori root:

```bash
php create_bulk_participants.php
```

Script ini akan otomatis melakukan registrasi 10 ketua tim baru dan data timnya dengan rincian berikut (semua akun menggunakan password default **`password123`**):

| No | Nama Ketua | Email Login | Password | Nama Tim | Status Awal (is_active) | Deskripsi Status |
|---|---|---|---|---|---|---|
| 1 | Ahmad Fauzi | `peserta1@designova.local` | `password123` | Tim Falcon | **1 (Aktif)** | Sudah terverifikasi, langsung bisa upload karya |
| 2 | Dewi Lestari | `peserta2@designova.local` | `password123` | Tim Aurora | **1 (Aktif)** | Sudah terverifikasi, langsung bisa upload karya |
| 3 | Giri Wijaya | `peserta3@designova.local` | `password123` | Tim Galaxy | **1 (Aktif)** | Sudah terverifikasi, langsung bisa upload karya |
| 4 | Joko Widodo | `peserta4@designova.local` | `password123` | Tim JavaCoder | **1 (Aktif)** | Sudah terverifikasi, langsung bisa upload karya |
| 5 | Mada Putra | `peserta5@designova.local` | `password123` | Tim AeroUX | **1 (Aktif)** | Sudah terverifikasi, langsung bisa upload karya |
| 6 | Putri Ayu | `peserta6@designova.local` | `password123` | Tim Phoenix | **0 (Non-Aktif)** | Menunggu verifikasi pembayaran admin |
| 7 | Siti Aminah | `peserta7@designova.local` | `password123` | Tim Skyline | **0 (Non-Aktif)** | Menunggu verifikasi pembayaran admin |
| 8 | Vina Panduwinata | `peserta8@designova.local` | `password123` | Tim Zenith | **0 (Non-Aktif)** | Menunggu verifikasi pembayaran admin |
| 9 | Zulham Efendi | `peserta9@designova.local` | `password123` | Tim Alpha | **0 (Non-Aktif)** | Menunggu verifikasi pembayaran admin |
| 10 | Chandra Kirana | `peserta10@designova.local` | `password123` | Tim Nebula | **0 (Non-Aktif)** | Menunggu verifikasi pembayaran admin |

### 5. Konfigurasi Aplikasi

Sesuaikan berkas konfigurasi database dan URL aplikasi pada berkas [app/config/config.php](file:///D:/laragon/www/designova/app/config/config.php):

```php
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', ''); // Isi dengan password database Anda jika ada
define('DB_NAME', 'designova');

// Sesuaikan BASE_URL jika menggunakan virtual host Laragon (misal: http://designova.test)
define('BASE_URL', 'http://localhost/designova');
```

### 5. Build Aset CSS (Tailwind CSS)

Jika Anda ingin mengubah tampilan/style dan memicu compiler Tailwind CSS v4, jalankan perintah berikut di direktori root:

```bash
npm install
npm run dev
```

Perintah di atas akan memantau berkas `.php` dan berkas `.css` Anda untuk mengompilasi ulang berkas output di `public/src/output.css`.
