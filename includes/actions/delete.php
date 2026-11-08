<?php
// ---------- HAPUS DATA PT ATAU PRODUK ----------
if (isset($_GET['delete']) && in_array($view, ['customers', 'products'])) {
    $id  = (int)$_GET['delete'];
    $tbl = $view === 'customers' ? 'customers' : 'products';

    $stmt = $mysqli->prepare("DELETE FROM $tbl WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();

    header('Location: index.php?page=' . $view);
    exit;
}