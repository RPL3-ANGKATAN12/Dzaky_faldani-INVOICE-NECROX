<section class="panel">
        <h2>Foto profil</h2>
        <?php if (isset($_GET['photo'])): ?>
            <p class="<?= $_GET['photo'] === 'ok' ? 'success' : 'error' ?>"><?= $_GET['photo'] === 'ok' ? 'Foto tersimpan.' : 'Foto gagal diunggah. Gunakan JPG, PNG, atau WebP maksimal 2 MB.' ?></p>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data" class="photo-form">
            <label class="photo-pick">
                <span class="photo-preview <?= $av ? 'has' : '' ?>" <?= $av ? 'style="background-image:url(' . e($av) . ')"' : '' ?>>+</span>
                <span>Pilih foto<small>JPG, PNG, atau WebP, maks 2 MB</small></span>
                <input type="file" name="photo" accept="image/*" required hidden>
            </label>
            <button name="save_photo">Simpan foto</button>
        </form>
    </section>

    <section class="panel">
        <h2>Pengaturan Perusahaan</h2>

        <?php
        if (isset($_GET['saved'])) {
            echo '<p class="success">Pengaturan disimpan.</p>';
        }

        $settings = [];
        foreach (rows('SELECT * FROM settings') as $r) {
            $settings[$r['setting_key']] = $r['setting_value'];
        }
        ?>

        <form method="post">
            <input name="company_name" placeholder="Nama perusahaan" value="<?= e($settings['company_name'] ?? '') ?>">
            <textarea name="company_address" placeholder="Alamat perusahaan"><?= e($settings['company_address'] ?? '') ?></textarea>
            <button name="settings">Simpan Pengaturan</button>
        </form>
    </section>