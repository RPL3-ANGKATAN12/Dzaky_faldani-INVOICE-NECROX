<?php
$id = (int)($_GET['id'] ?? 0);

$stmt = $mysqli->prepare("
    SELECT i.*, c.name AS customer
    FROM invoices i
    JOIN customers c ON c.id = i.customer_id
    WHERE i.id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$inv = $stmt->get_result()->fetch_assoc();

if ($inv):
    $items = rows("SELECT * FROM invoice_items WHERE invoice_id = $id");
?>

<section class="panel invoice-page">

    <!-- AREA INVOICE YANG DICETAK -->
    <div class="invoice-paper">

        <div class="invoice-header">
            <div>
                <h1>JOTUN WEB</h1>
                <p>INVOICE MANAGEMENT SYSTEM</p>
            </div>

            <div class="invoice-title">
                <h2>INVOICE</h2>
                <strong><?= e($inv['invoice_no']) ?></strong>
            </div>
        </div>

        <div class="invoice-line"></div>

        <div class="invoice-info">
            <div>
                <small>DITAGIHKAN KEPADA</small>
                <h3><?= e($inv['customer']) ?></h3>
            </div>

            <div class="invoice-date">
                <p>Tanggal Invoice</p>
                <strong><?= e($inv['invoice_date']) ?></strong>

                <?php if (!empty($inv['due_date'])): ?>
                    <p>Jatuh Tempo</p>
                    <strong><?= e($inv['due_date']) ?></strong>
                <?php endif; ?>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Deskripsi Barang</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; foreach ($items as $it): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= e($it['item_name']) ?></td>
                        <td><?= e($it['qty']) ?></td>
                        <td><?= rupiah($it['price']) ?></td>
                        <td><?= rupiah($it['subtotal']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="invoice-total">
            <span>TOTAL TAGIHAN</span>
            <strong><?= rupiah($inv['total']) ?></strong>
        </div>

        <?php if (!empty($inv['notes'])): ?>
            <div class="invoice-notes">
                <strong>Catatan:</strong>
                <p><?= nl2br(e($inv['notes'])) ?></p>
            </div>
        <?php endif; ?>

        <div class="invoice-footer">
            <div>
                <strong>Terima kasih</strong>
                <p>Mohon periksa kembali rincian invoice ini.</p>
            </div>

            <div class="signature">
                <p>Hormat Kami,</p>
                <strong>PT Jotun Batam</strong>
            </div>
        </div>

    </div>

    <!-- BAGIAN YANG TIDAK DICETAK -->
    <div class="no-print">

        <h3>Catat Pembayaran</h3>

        <form method="post" class="fields">
            <input type="hidden" name="invoice_id" value="<?= $id ?>">

            <input
                type="date"
                name="payment_date"
                value="<?= date('Y-m-d') ?>"
            >

            <input
                type="number"
                name="amount"
                min="1"
                placeholder="Jumlah bayar"
                required
            >

            <input
                name="method"
                placeholder="Metode pembayaran"
            >

            <button name="payment">Simpan Pembayaran</button>
        </form>

        <button onclick="window.print()" class="secondary">
            Cetak Invoice
        </button>

    </div>

</section>

<?php endif; ?>