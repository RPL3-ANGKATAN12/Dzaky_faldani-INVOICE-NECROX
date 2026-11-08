<?php
// ============================================================
// KONEKSI DATABASE + FUNGSI BANTUAN YANG DIPAKAI DI SEMUA HALAMAN
// ============================================================

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'jotun_web_full');

if ($mysqli->connect_error) {
    die('Koneksi database gagal. Import database.sql melalui phpMyAdmin terlebih dahulu.');
}

$mysqli->set_charset('utf8mb4');

// Escape output supaya aman dari XSS
function e($v) {
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

// Format angka ke Rupiah, contoh: 2500000 -> "Rp 2.500.000"
function rupiah($n) {
    return 'Rp ' . number_format((float)$n, 0, ',', '.');
}

// Catat aktivitas pengguna yang sedang login ke tabel activity_logs
function log_activity($text) {
    global $mysqli;

    if (isset($_SESSION['uid'])) {
        $stmt = $mysqli->prepare('INSERT INTO activity_logs(user_id, activity) VALUES (?, ?)');
        $stmt->bind_param('is', $_SESSION['uid'], $text);
        $stmt->execute();
    }
}

// Halaman wajib login: dipanggil di awal halaman yang butuh akses admin/staff
function require_login() {
    if (empty($_SESSION['uid'])) {
        header('Location: index.php');
        exit;
    }
}