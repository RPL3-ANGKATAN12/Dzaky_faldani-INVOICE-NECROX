<?php
// ============================================================
// HALAMAN SETUP ADMIN PERTAMA KALI
// Hanya dipakai sekali di awal untuk membuat akun admin pertama.
// ============================================================

require 'config.php';
require 'avatar.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($name && $username && strlen($password) >= 6) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare(
            "INSERT INTO users(name, username, password, role) VALUES (?, ?, ?, 'admin')"
        );
        $stmt->bind_param('sss', $name, $username, $hash);

        if ($stmt->execute()) {
            if (!empty($_FILES['photo']['name'])) save_avatar($stmt->insert_id, $_FILES['photo']);
            $msg = 'Admin berhasil dibuat. Silakan login.';
        } else {
            $msg = 'Username sudah digunakan.';
        }
    } else {
        $msg = 'Lengkapi data; password minimal 6 karakter.';
    }
}

$isSuccess = strpos($msg, 'berhasil') !== false;
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Setup Admin - JOTUN WEB</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css?v=8">
<script src="assets/app.js?v=8" defer></script>
</head>
<body>
<div class="login-screen">
    <section class="login-brand">
        <i class="orb orb-a"></i><i class="orb orb-b"></i>
        <div class="brand"><span class="mark">JW</span><span class="bt">Jotun Web</span></div>
        <div class="login-copy">
            <h1>Satu akun admin untuk memulai.</h1>
            <p>Halaman ini hanya dipakai sekali. Setelah admin dibuat, tambahkan staff dari menu Pengguna.</p>
        </div>
    </section>
    <section class="login-card">
        <h2>Setup admin</h2>
        <p class="login-sub">Buat akun admin pertama.</p>
        <?php if ($msg): ?><p class="<?= $isSuccess ? 'success' : 'error' ?>"><?= e($msg) ?></p><?php endif; ?>
        <form method="post" enctype="multipart/form-data" class="login-form">
            <label class="photo-pick">
                <span class="photo-preview">+</span>
                <span>Foto profil (opsional)<small>JPG, PNG, atau WebP, maks 2 MB</small></span>
                <input type="file" name="photo" accept="image/*" hidden>
            </label>
            <label>Nama admin
                <input name="name" placeholder="Contoh: Budi Santoso" required>
            </label>
            <label>Username
                <input name="username" placeholder="Username untuk login" required>
            </label>
            <label>Password
                <input name="password" type="password" placeholder="Minimal 6 karakter" required minlength="6">
            </label>
            <button type="submit">Buat admin</button>
        </form>
        <small class="login-foot"><a href="index.php">&larr; Kembali ke login</a></small>
    </section>
</div>
</body>
</html>