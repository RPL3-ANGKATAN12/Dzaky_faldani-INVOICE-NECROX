<?php
// Data yang dipakai di banyak halaman

$customers = rows('SELECT * FROM customers ORDER BY name');

$products = rows(
    'SELECT p.*, c.name category
     FROM products p LEFT JOIN categories c ON c.id = p.category_id
     ORDER BY p.name'
);

$invoices = rows(
    "SELECT i.*, c.name customer,
            (SELECT COALESCE(SUM(amount),0) FROM payments WHERE invoice_id = i.id) paid
     FROM invoices i JOIN customers c ON c.id = i.customer_id
     ORDER BY i.id DESC"
);

$sum  = $mysqli->query('SELECT COUNT(*) n, COALESCE(SUM(total),0) total FROM invoices')->fetch_assoc();
$paid = $mysqli->query('SELECT COALESCE(SUM(amount),0) n FROM payments')->fetch_assoc()['n'];