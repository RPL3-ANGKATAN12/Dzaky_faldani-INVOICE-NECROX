<?php
$remaining = max(0, (float)$sum['total'] - (float)$paid);

$pct = $sum['total'] > 0
    ? min(100, round($paid / $sum['total'] * 100))
    : 0;
?>

<section class="stats">
    <div class="stat hero">
        <div>
            <small>Nilai Invoice</small><br>
            <strong data-count="<?= (float)$sum['total'] ?>" data-prefix="Rp ">
                <?= rupiah($sum['total']) ?>
            </strong>
        </div>

        <div class="meter">
            <span>Terbayar <?= $pct ?>%</span>
            <div class="bar">
                <i style="--w:<?= $pct ?>%"></i>
            </div>
        </div>
    </div>

    <div class="stat">
        <small>Total Invoice</small>
        <strong data-count="<?= (int)$sum['n'] ?>">
            <?= $sum['n'] ?>
        </strong>
    </div>

    <div class="stat">
        <small>Total Pembayaran</small>
        <strong data-count="<?= (float)$paid ?>" data-prefix="Rp ">
            <?= rupiah($paid) ?>
        </strong>
    </div>

    <div class="stat">
        <small>Belum Terbayar</small>
        <strong data-count="<?= $remaining ?>" data-prefix="Rp ">
            <?= rupiah($remaining) ?>
        </strong>
    </div>
</section>

    <section class="panel">
        <h2>Invoice Terbaru</h2>
        <div class="table-wrap"><table>
            <tr><th>No</th><th>Tanggal</th><th>PT</th><th>Total</th><th>Status</th></tr>
            <?php foreach (array_slice($invoices, 0, 6) as $i): ?>
                <tr>
                    <td><?= e($i['invoice_no']) ?></td>
                    <td><?= e($i['invoice_date']) ?></td>
                    <td><?= e($i['customer']) ?></td>
                    <td><?= rupiah($i['total']) ?></td>
                    <td><?= badge($i['status']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table></div>
    </section>