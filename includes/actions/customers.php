<?php
// ---------- SIMPAN / UPDATE DATA PT (CUSTOMER) ----------
if (isset($_POST['save_customer'])) {
    $id      = (int)($_POST['id'] ?? 0);
    $name    = trim($_POST['name']);
    $code    = trim($_POST['code']);
    $phone   = trim($_POST['phone']);
    $email   = trim($_POST['email']);
    $address = trim($_POST['address']);

    if ($id) {
        $stmt = $mysqli->prepare(
            'UPDATE customers SET name=?, company_code=?, phone=?, email=?, address=? WHERE id=?'
        );
        $stmt->bind_param('sssssi', $name, $code, $phone, $email, $address, $id);
    } else {
        $stmt = $mysqli->prepare(
            'INSERT INTO customers(name, company_code, phone, email, address) VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->bind_param('sssss', $name, $code, $phone, $email, $address);
    }

    $stmt->execute();
    log_activity('Simpan data PT: ' . $name);
    header('Location: index.php?page=customers');
    exit;
}