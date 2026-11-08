<section class="panel">
        <h2>Ekspor Laporan Invoice</h2>
        <form action="" method="get" class="fields">
            <input type="hidden" name="page" value="export">
            <label>Dari <input type="date" name="from" required></label>
            <label>Sampai <input type="date" name="to" required></label>
            <button>Unduh CSV</button>
        </form>
    </section>

    <section class="panel">
        <h2>Ringkasan per PT</h2>
        <div class="table-wrap"><table>
            <tr><th>PT</th><th>Jumlah Invoice</th><th>Total</th></tr>
            <?php
            $summaryByCustomer = rows(
                'SELECT c.name, COUNT(i.id) count, COALESCE(SUM(i.total),0) total
                 FROM customers c LEFT JOIN invoices i ON i.customer_id = c.id
                 GROUP BY c.id'
            );
            foreach ($summaryByCustomer as $r):
            ?>
                <tr>
                    <td><?= e($r['name']) ?></td>
                    <td><?= $r['count'] ?></td>
                    <td><?= rupiah($r['total']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table></div>
    </section>