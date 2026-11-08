<section class="panel">
        <h2>Riwayat Aktivitas</h2>
        <div class="table-wrap"><table>
            <tr><th>Pengguna</th><th>Aktivitas</th><th>Waktu</th></tr>
            <?php
            $logs = rows(
                'SELECT l.*, u.name FROM activity_logs l
                 LEFT JOIN users u ON u.id = l.user_id
                 ORDER BY l.id DESC LIMIT 100'
            );
            foreach ($logs as $l):
            ?>
                <tr>
                    <td><?= e($l['name'] ?? 'System') ?></td>
                    <td><?= e($l['activity']) ?></td>
                    <td><?= e($l['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table></div>
    </section>