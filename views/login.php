<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - JOTUN WEB</title>
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
            <h1>Invoice, pelanggan, dan produk dalam satu tempat.</h1>
            <p>Catat tagihan, pantau pembayaran, dan unduh laporan tanpa pindah halaman.</p>
        </div>
    </section>
    <section class="login-card">
        <h2>Masuk</h2>
        <p class="login-sub">Gunakan akun admin atau staff Anda.</p>
        <?php if (isset($error)): ?><p class="error"><?= e($error) ?></p><?php endif; ?>
        <form method="post" class="login-form">
            <label>Username
                <input name="username" placeholder="Masukkan username" required autofocus>
            </label>
            <label>Password
                <input name="password" type="password" placeholder="Masukkan password" required>
            </label>
            <button name="login">Masuk</button>
        </form>
        <small class="login-foot">Belum ada admin? <a href="setup.php">Setup admin</a></small>
    </section>
</div>
</body>
</html>