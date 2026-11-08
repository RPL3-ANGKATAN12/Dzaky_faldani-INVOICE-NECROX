<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>JOTUN WEB</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css?v=8">
<script src="assets/app.js?v=8" defer></script>
</head>
<body>

<aside>
    <div class="brand"><span class="mark">JW</span><span class="bt">Jotun Web</span></div>
    <nav>
        <i class="nav-indicator"></i>
        <?php
        $active = $view === 'detail' ? 'invoices' : $view;
        foreach ($menu as $key => [$label, $icon]): ?>
            <a class="<?= $active === $key ? 'active' : '' ?>" href="?page=<?= $key ?>" title="<?= $label ?>">
                <svg viewBox="0 0 24 24"><?= $icon ?></svg><span><?= $label ?></span>
            </a>
        <?php endforeach; ?>
    </nav>
    <div class="sidebottom">
        <?php $av = avatar_url($_SESSION['uid']); ?>
        <span class="avatar"><?php if ($av): ?><img src="<?= e($av) ?>" alt=""><?php else: ?><?= e(strtoupper(substr($_SESSION['name'], 0, 1))) ?><?php endif; ?></span>
        <div><b><?= e($_SESSION['name']) ?></b><small><?= e($_SESSION['role']) ?></small></div>
        <a href="?logout=1">Keluar</a>
    </div>
</aside>

<main class="main">
    <header>
        <h1><?= e($view === 'detail' ? 'Detail Invoice' : ($menu[$view][0] ?? 'Halaman')) ?></h1>
        <span><?= date('d M Y') ?></span>
    </header>

    <?php if ($err): ?>
        <p class="error"><?= e($err) ?></p>
    <?php endif; ?>

    <?php require __DIR__ . '/pages/' . $view . '.php'; ?>

</main>

</body>
</html>