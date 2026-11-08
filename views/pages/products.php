<section class="panel">
        <h2>Tambah Produk</h2>
        <form method="post" class="fields">
            <input name="sku" placeholder="SKU">
            <input name="name" placeholder="Nama produk" required>
            <select name="category_id">
                <option value="0">Kategori</option>
                <?php foreach (rows('SELECT * FROM categories') as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= e($c['name']) ?></option>
                <?php endforeach; ?>
            </select>
            <input name="unit" placeholder="Satuan" value="pcs">
            <input type="number" name="price" placeholder="Harga" min="0" required>
            <input type="number" name="stock" placeholder="Stok" min="0" value="0">
            <button name="save_product">Simpan Produk</button>
        </form>
    </section>

    <section class="panel">
        <h2>Daftar Produk</h2>
        <div class="table-wrap"><table>
            <tr><th>SKU</th><th>Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td><?= e($p['sku']) ?></td>
                    <td><?= e($p['name']) ?></td>
                    <td><?= e($p['category']) ?></td>
                    <td><?= rupiah($p['price']) ?></td>
                    <td><?= $p['stock'] ?> <?= e($p['unit']) ?></td>
                    <td>
                        <a class="danger" href="?page=products&delete=<?= $p['id'] ?>" onclick="return confirm('Hapus produk?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table></div>
    </section>