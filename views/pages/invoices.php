<section class="panel">
        <h2>Buat Invoice</h2>
        <form method="post">
            <div class="fields">
                <input name="invoice_no" placeholder="No. Invoice" required>
                <select name="customer_id" required>
                    <option value="">Pilih PT</option>
                    <?php foreach ($customers as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= e($c['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Tanggal
                    <input type="date" name="invoice_date" value="<?= date('Y-m-d') ?>" required>
                </label>
                <label>Jatuh tempo
                    <input type="date" name="due_date">
                </label>
            </div>

            <h3>Item Invoice</h3>
            <div id="items">
                <div class="item fields">
                    <input name="item_name[]" placeholder="Nama barang/jasa" required>
                    <input name="qty[]" type="number" step="0.01" min="0.01" value="1" placeholder="Qty">
                    <input name="price[]" type="number" min="0" step="0.01" placeholder="Harga satuan" required>
                </div>
            </div>
            <button type="button" class="secondary" onclick="addItem()">+ Tambah item</button>

            <textarea name="notes" placeholder="Catatan"></textarea>
            <button name="save_invoice">Simpan Invoice</button>
        </form>
    </section>

    <section class="panel">
        <h2>Daftar Invoice</h2>
        <div class="table-wrap"><table>
            <tr><th>No</th><th>Tanggal</th><th>PT</th><th>Total</th><th>Terbayar</th><th>Status</th><th>Aksi</th></tr>
            <?php foreach ($invoices as $i): ?>
                <tr>
                    <td><?= e($i['invoice_no']) ?></td>
                    <td><?= e($i['invoice_date']) ?></td>
                    <td><?= e($i['customer']) ?></td>
                    <td><?= rupiah($i['total']) ?></td>
                    <td><?= rupiah($i['paid']) ?></td>
                    <td><?= badge($i['status']) ?></td>
                    <td><a href="?page=detail&id=<?= $i['id'] ?>">Detail / Bayar</a></td>
                </tr>
            <?php endforeach; ?>
        </table></div>
    </section>