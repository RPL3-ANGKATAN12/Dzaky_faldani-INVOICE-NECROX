<?php

        $id  = (int)($_GET['id'] ?? 0);
        $inv = $mysqli->query(
            "SELECT i.*, c.name customer FROM invoices i JOIN customers c ON c.id = i.customer_id WHERE i.id = $id"
        )->fetch_assoc();

        if ($inv):
    ?>

        <section class="panel">
            <h2><?= e($inv['invoice_no']) ?> &mdash; <?= e($inv['customer']) ?></h2>
            <div class="meta">
                <span>Tanggal<b><?= e($inv['invoice_date']) ?></b></span>
                <span>Total<b><?= rupiah($inv['total']) ?></b></span>
                <span>Status<b><?= badge($inv['status']) ?></b></span>
            </div>

            <div class="table-wrap"><table>
                <tr><th>Item</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr>
                <?php foreach (rows("SELECT * FROM invoice_items WHERE invoice_id=$id") as $it): ?>
                    <tr>
                        <td><?= e($it['item_name']) ?></td>
                        <td><?= $it['qty'] ?></td>
                        <td><?= rupiah($it['price']) ?></td>
                        <td><?= rupiah($it['subtotal']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table></div>

            <h3>Catat Pembayaran</h3>
            <form method="post" class="fields">
                <input type="hidden" name="invoice_id" value="<?= $id ?>">
                <input type="date" name="payment_date" value="<?= date('Y-m-d') ?>">
                <input type="number" name="amount" min="1" placeholder="Jumlah bayar" required>
                <input name="method" placeholder="Metode pembayaran">
                <button name="payment">Simpan Pembayaran</button>
            </form>

            <button onclick="print()" class="secondary">Cetak</button>
        </section>

    <?php endif; ?>