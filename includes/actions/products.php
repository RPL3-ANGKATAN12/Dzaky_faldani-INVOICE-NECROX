<?php
// ---------- SIMPAN / UPDATE PRODUK ----------
if (isset($_POST['save_product'])) {
    $id    = (int)($_POST['id'] ?? 0);
    $sku   = trim($_POST['sku']);
    $name  = trim($_POST['name']);
    $cat   = (int)$_POST['category_id'];
    $unit  = trim($_POST['unit']);
    $price = (float)$_POST['price'];
    $stock = (int)$_POST['stock'];

    if ($id) {
        $stmt = $mysqli->prepare(
            'UPDATE products SET sku=?, name=?, category_id=NULLIF(?,0), unit=?, price=?, stock=? WHERE id=?'
        );
        $stmt->bind_param('ssisdii', $sku, $name, $cat, $unit, $price, $stock, $id);
    } else {
        $stmt = $mysqli->prepare(
            'INSERT INTO products(sku, name, category_id, unit, price, stock) VALUES (?, ?, NULLIF(?,0), ?, ?, ?)'
        );
        $stmt->bind_param('ssisdi', $sku, $name, $cat, $unit, $price, $stock);
    }

    $stmt->execute();
    log_activity('Simpan produk: ' . $name);
    header('Location: index.php?page=products');
    exit;
}