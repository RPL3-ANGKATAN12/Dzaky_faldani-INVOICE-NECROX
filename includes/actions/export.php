<?php
// ---------- EKSPOR LAPORAN CSV ----------
if ($view === 'export') {
    $from = $_GET['from'] ?? '2000-01-01';
    $to   = $_GET['to'] ?? '2099-12-31';

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=laporan_invoice.csv');

    $out = fopen('php://output', 'w');
    fputcsv($out, ['Invoice', 'Tanggal', 'Nama PT', 'Total', 'Status']);

    $stmt = $mysqli->prepare(
        'SELECT i.invoice_no, i.invoice_date, c.name, i.total, i.status
         FROM invoices i JOIN customers c ON c.id = i.customer_id
         WHERE i.invoice_date BETWEEN ? AND ?
         ORDER BY i.invoice_date DESC'
    );
    $stmt->bind_param('ss', $from, $to);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_row()) {
        fputcsv($out, $row);
    }
    exit;
}