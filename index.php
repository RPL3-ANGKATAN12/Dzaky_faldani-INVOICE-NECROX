<?php
// ============================================================
// JOTUN WEB - titik masuk. Alur setiap permintaan, berurutan:
//   1. Siapkan       config, fungsi bantu
//   2. Cek login     belum login -> tampilkan form login
//   3. Pilih halaman $view (dashboard, invoices, ...)
//   4. Proses form   includes/actions/*  (simpan, hapus, bayar, ...)
//   5. Ambil data    includes/data.php, includes/menu.php
//   6. Tampilkan     views/layout.php memuat views/pages/$view.php
// ============================================================

// 1. Siapkan
require __DIR__ . '/config.php';
require __DIR__ . '/avatar.php';
require __DIR__ . '/includes/helpers.php';

// 2. Cek login
require __DIR__ . '/includes/auth.php';
if (empty($_SESSION['uid'])) {
    require __DIR__ . '/views/login.php';
    exit;
}

// 3. Pilih halaman
$pages = ['dashboard', 'customers', 'products', 'invoices', 'detail', 'reports', 'users', 'activity', 'settings', 'export'];
$view  = $_GET['page'] ?? 'dashboard';
if (!in_array($view, $pages, true) || ($view === 'users' && $_SESSION['role'] !== 'admin')) {
    $view = 'notfound';
}
$err = '';

// 4. Proses form (setiap file mengarahkan ulang / berhenti setelah selesai)
require __DIR__ . '/includes/actions/customers.php';
require __DIR__ . '/includes/actions/products.php';
require __DIR__ . '/includes/actions/delete.php';
require __DIR__ . '/includes/actions/invoices.php';
require __DIR__ . '/includes/actions/users.php';
require __DIR__ . '/includes/actions/settings.php';
require __DIR__ . '/includes/actions/profile.php';
require __DIR__ . '/includes/actions/export.php';

// 5. Ambil data
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/menu.php';

// 6. Tampilkan
require __DIR__ . '/views/layout.php';