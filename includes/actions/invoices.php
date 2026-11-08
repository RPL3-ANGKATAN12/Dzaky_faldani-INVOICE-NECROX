<?php
// ---------- SIMPAN INVOICE BARU (+ ITEM-ITEMNYA) ----------
if (isset($_POST['save_invoice'])) {
    $customerId = (int)$_POST['customer_id'];
    $invoiceNo  = trim($_POST['invoice_no']);
    $date       = $_POST['invoice_date'];
    $dueDate    = $_POST['due_date'] ?: null;
    $itemNames  = $_POST['item_name'] ?? [];
    $itemQtys   = $_POST['qty'] ?? [];
    $itemPrices = $_POST['price'] ?? [];
    $notes      = trim($_POST['notes']);
    $uid        = $_SESSION['uid'];

    // Hitung total dari semua item
    $total = 0;
    foreach ($itemNames as $i => $name) {
        $total += (float)$itemQtys[$i] * (float)$itemPrices[$i];
    }

    $stmt = $mysqli->prepare(
        'INSERT INTO invoices(invoice_no, customer_id, invoice_date, due_date, total, created_by, notes) VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->bind_param('sissdis', $invoiceNo, $customerId, $date, $dueDate, $total, $uid, $notes);

    if ($stmt->execute()) {
        $invoiceId = $stmt->insert_id;

        // Simpan tiap item invoice
        $itemStmt = $mysqli->prepare(
            'INSERT INTO invoice_items(invoice_id, item_name, qty, price, subtotal) VALUES (?, ?, ?, ?, ?)'
        );
        foreach ($itemNames as $i => $name) {
            $name = trim($name);
            $qty  = (float)$itemQtys[$i];
            $price = (float)$itemPrices[$i];

            if ($name !== '' && $qty > 0) {
                $subtotal = $qty * $price;
                $itemStmt->bind_param('isddd', $invoiceId, $name, $qty, $price, $subtotal);
                $itemStmt->execute();
            }
        }

        log_activity('Buat invoice ' . $invoiceNo);
        header('Location: index.php?page=invoices');
        exit;
    } else {
        $err = 'Nomor invoice sudah ada atau data tidak valid.';
    }
}

// ---------- CATAT PEMBAYARAN INVOICE ----------
if (isset($_POST['payment'])) {
    $invoiceId = (int)$_POST['invoice_id'];
    $amount    = (float)$_POST['amount'];
    $date      = $_POST['payment_date'];
    $method    = trim($_POST['method']);

    $stmt = $mysqli->prepare(
        'INSERT INTO payments(invoice_id, payment_date, amount, method) VALUES (?, ?, ?, ?)'
    );
    $stmt->bind_param('isds', $invoiceId, $date, $amount, $method);
    $stmt->execute();

    // Hitung ulang status invoice: Lunas jika total bayar >= total tagihan
    $res = $mysqli->query(
        "SELECT total, (SELECT COALESCE(SUM(amount),0) FROM payments WHERE invoice_id=$invoiceId) paid
         FROM invoices WHERE id=$invoiceId"
    )->fetch_assoc();

    $status = $res['paid'] >= $res['total'] ? 'Lunas' : 'Sebagian';

    $upd = $mysqli->prepare('UPDATE invoices SET status=? WHERE id=?');
    $upd->bind_param('si', $status, $invoiceId);
    $upd->execute();

    log_activity('Pembayaran invoice #' . $invoiceId);
    header('Location: index.php?page=invoices');
    exit;
}