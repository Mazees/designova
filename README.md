# Designova - Platform Kompetisi UI/UX

Designova adalah aplikasi web berbasis **PHP Native (OOP)** dengan arsitektur **MVC (Model-View-Controller)** yang dirancang untuk mengelola siklus penuh kompetisi desain.

---

## 👥 Kelompok 5 - Anggota Tim

- MUHAMMAD RIZKY PUSPOJATI (24081010019)
- MOCH.RAIHAN ARDANI (24081010174)
- MADA PUTRA ADHADRIYANTO (24081010192)

## Pembagian Tugas :

- Halaman Publik : Mada
- Halaman Peserta (Dashboard Tim) : Raihan
- Halaman Juri (Dashboard Penilaian) : Rizky
- Halaman Pengelola (Dashboard Admin) : Mada

---

## 📂 Struktur Direktori Proyek

Proyek ini terbagi menjadi dua bagian utama:

1. **`app/`**: Berisi seluruh file inti aplikasi (logic bisnis, data model, helper, dan file tampilan).
2. **`public/`**: Titik masuk utama aplikasi (Front Controller) serta direktori untuk berkas statis (assets).

```
designova/
├── app/
│   ├── config/
│   │   └── config.php          # Konfigurasi database & variabel global
│   ├── controllers/            # Logic pengendali (Controller stubs)
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   ├── HomeController.php
│   │   └── JuriController.php
│   ├── core/                   # Kelas inti kerangka kerja (Core classes)
│   │   ├── Controller.php      # Base Controller
│   │   ├── Database.php        # Helper Koneksi PDO MySQL
│   │   └── Router.php          # Custom Regex Router
│   ├── models/                 # Representasi entitas tabel (Model stubs)
│   │   ├── Submissions.php
│   │   ├── Setting.php
│   │   ├── Team.php
│   │   └── User.php
│   └── views/                  # Berkas UI / Tampilan (View stubs)
│       ├── admin/
│       ├── auth/
│       ├── home/
│       ├── juri/
│       ├── layouts/            # File header & footer global
│       └── participant/
├── public/
│   ├── .htaccess               # Aturan rewrite Apache untuk clean URLs
│   ├── index.php               # Front Controller (Entri aplikasi utama)
│   └── assets/                 # Aset statis (css, js, images)
├── .htaccess                   # Rewrite root untuk redirect transparan ke public/
├── README.md                   # Dokumentasi proyek ini
└── system-design.md            # Spesifikasi kebutuhan sistem awal
```

## TEST

---

## 🛣️ Pemetaan Rute (Routing Table)

Aplikasi menggunakan custom router dengan pola regex yang didaftarkan pada [public/index.php](file:///D:/laragon/www/designova/public/index.php):

### 1. Halaman Publik

| URL            | Controller & Method           | Tampilan File View          | Deskripsi                    |
| :------------- | :---------------------------- | :-------------------------- | :--------------------------- |
| `/`            | `HomeController::index()`     | `home/index.php`            | Beranda / Landing Page utama |
| `/login`       | `AuthController::login()`     | `auth/login.php`            | Form login multi-role        |
| `/register`    | `AuthController::register()`  | `auth/register.php`         | Pendaftaran tim baru         |
| `/auth/google` | `AuthController::googleSSO()` | _Inline transitioning text_ | Autentikasi via Google       |

### 2. Dashboard Peserta (Tim)

| URL           | Controller & Method                 | Tampilan File View           | Deskripsi                  |
| :------------ | :---------------------------------- | :--------------------------- | :------------------------- |
| `/dashboard`  | `DashboardController::index()`      | `participant/dashboard.php`  | Informasi status tim       |
| `/payment`    | `DashboardController::payment()`    | `participant/payment.php`    | Detail instruksi & QRIS    |
| `/submission` | `DashboardController::submission()` | `participant/submission.php` | Unggah link Figma & GDrive |

### 3. Dashboard Juri

| URL                          | Controller & Method                    | Tampilan File View    | Deskripsi                     |
| :--------------------------- | :------------------------------------- | :-------------------- | :---------------------------- |
| `/juri/dashboard`            | `JuriController::index()`              | `juri/dashboard.php`  | Daftar tim yang perlu dinilai |
| `/juri/assessment/{team_id}` | `JuriController::assessment($team_id)` | `juri/Submissions.php` | Form input nilai tim tertentu |

### 4. Dashboard Admin

| URL                  | Controller & Method              | Tampilan File View      | Deskripsi                         |
| :------------------- | :------------------------------- | :---------------------- | :-------------------------------- |
| `/admin/dashboard`   | `AdminController::index()`       | `admin/dashboard.php`   | Halaman ringkasan statistik       |
| `/admin/teams`       | `AdminController::teams()`       | `admin/teams.php`       | Verifikasi manual pembayaran      |
| `/admin/leaderboard` | `AdminController::leaderboard()` | `admin/leaderboard.php` | Rekapitulasi & tombol ekspor      |
| `/admin/settings`    | `AdminController::settings()`    | `admin/settings.php`    | Pengaturan harga & timeline event |

---

## 🛠️ Cara Menjalankan & Prasyarat

1. **Web Server**: Disarankan menggunakan **Laragon** atau **XAMPP** dengan Apache.
2. **Modul Rewrite**: Pastikan modul `mod_rewrite` Apache aktif agar file `.htaccess` berfungsi normal.
3. **Konfigurasi Database**: Atur konfigurasi database MySQL Anda di berkas [app/config/config.php](file:///D:/laragon/www/designova/app/config/config.php).
4. **Base URL**: Sesuaikan konstanta `BASE_URL` di [app/config/config.php](file:///D:/laragon/www/designova/app/config/config.php) jika Anda menggunakan virtual host (misal: `http://designova.test`) atau subfolder localhost biasa.
