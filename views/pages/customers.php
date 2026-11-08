<section class="panel">
        <h2>Tambah Data PT / Pelanggan</h2>
        <form method="post" class="fields">
            <input name="name" placeholder="Nama PT" required>
            <input name="code" placeholder="Kode PT">
            <input name="phone" placeholder="Telepon">
            <input name="email" placeholder="Email">
            <input name="address" placeholder="Alamat">
            <button name="save_customer">Simpan PT</button>
        </form>
    </section>

    <section class="panel">
        <h2>Daftar PT</h2>
        <div class="table-wrap"><table>
            <tr><th>Nama</th><th>Kode</th><th>Telepon</th><th>Email</th><th>Aksi</th></tr>
            <?php foreach ($customers as $c): ?>
                <tr>
                    <td><?= e($c['name']) ?></td>
                    <td><?= e($c['company_code']) ?></td>
                    <td><?= e($c['phone']) ?></td>
                    <td><?= e($c['email']) ?></td>
                    <td>
                        <a class="danger" href="?page=customers&delete=<?= $c['id'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table></div>
    </section>