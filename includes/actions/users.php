<?php
// ---------- TAMBAH PENGGUNA (hanya admin) ----------
if ($view === 'users' && isset($_POST['add_user'])) {
    $name     = trim($_POST['name']);
    $username = trim($_POST['username']);
    $hash     = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    $stmt = $mysqli->prepare('INSERT INTO users(name, username, password, role) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $name, $username, $hash, $role);
    $stmt->execute();

    log_activity('Tambah pengguna ' . $username);
    header('Location: index.php?page=users');
    exit;
}