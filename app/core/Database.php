<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $error;

    public function __construct() {
        // Tentukan DSN (Data Source Name)
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8mb4';
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        // Inisialisasi PDO Instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            // Jika database belum dibuat/dikonfigurasi, kita tangkap error-nya agar tidak langsung crash
        }
    }

    /**
     * Dapatkan koneksi PDO
     * @return PDO|null
     */
    public function getConnection() {
        if ($this->dbh === null && $this->error !== null) {
            die("Koneksi Database Gagal: " . $this->error);
        }
        return $this->dbh;
    }
}
