<?php
// ---------- SIMPAN PENGATURAN PERUSAHAAN ----------
if ($view === 'settings' && isset($_POST['settings'])) {
    foreach (['company_name', 'company_address'] as $key) {
        $val = trim($_POST[$key] ?? '');
        $stmt = $mysqli->prepare('REPLACE INTO settings(setting_key, setting_value) VALUES (?, ?)');
        $stmt->bind_param('ss', $key, $val);
        $stmt->execute();
    }
    log_activity('Ubah pengaturan');
    header('Location: index.php?page=settings&saved=1');
    exit;
}