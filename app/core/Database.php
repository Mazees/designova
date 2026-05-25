<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $error;

    protected $conn;
    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        } catch (\mysqli_sql_exception $e) {
            $error = $e;
        }
    }
    // public function errorCheck($errorCode, $message, $actualCode = null)
    // {
    //     $code = $actualCode ?? $this->conn->errno;
    //     if ((int) $code === (int) $errorCode) {
    //         $safeMessage = json_encode($message, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
    //         echo "<script>alert($safeMessage + $errorCode)</script>";
    //     }
    // }

    public function getConnection()
    {
        if ($this->conn === null && $this->error !== null) {
            die("Koneksi Database Gagal: " . $this->error);
        }
        return $this->conn;
    }
}
