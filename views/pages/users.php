<section class="panel">
        <h2>Tambah Pengguna</h2>

                <form method="post" class="fields">
            <input name="name" placeholder="Nama" required>
            <input name="username" placeholder="Username" required>
            <input name="password" type="password" placeholder="Password" required>
            <select name="role">
                <option>staff</option>
                <option>admin</option>
            </select>
            <button name="add_user">Tambah</button>
        </form>

        <div class="table-wrap"><table>
            <tr><th>Nama</th><th>Username</th><th>Role</th></tr>
            <?php foreach (rows('SELECT name, username, role FROM users') as $u): ?>
                <tr>
                    <td><?= e($u['name']) ?></td>
                    <td><?= e($u['username']) ?></td>
                    <td><?= e($u['role']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table></div>
    </section>