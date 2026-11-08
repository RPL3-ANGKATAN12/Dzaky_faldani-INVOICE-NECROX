<?php
// ---------- SIMPAN FOTO PROFIL ----------
if (isset($_POST['save_photo'])) {
    $ok = save_avatar($_SESSION['uid'], $_FILES['photo'] ?? []);
    header('Location: index.php?page=settings&photo=' . ($ok ? 'ok' : 'fail'));
    exit;
}