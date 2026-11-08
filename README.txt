JOTUN WEB FULL - PHP + MySQL (XAMPP)

FITUR
- Login admin/staff dengan password hash
- Dashboard ringkasan invoice, total tagihan, pembayaran dan sisa
- Data PT/pelanggan dan data produk/kategori/stok
- Invoice dengan banyak item, kuantitas, harga dan total otomatis
- Detail invoice, catat pembayaran dan status lunas/sebagian
- Laporan rekap per PT dan ekspor CSV berdasarkan tanggal
- Pengguna dengan role, log aktivitas dan pengaturan perusahaan
- Layout responsif, cetak detail invoice dari browser

INSTALASI
1. Ekstrak folder JOTUN_WEB_FULL ke C:\xampp\htdocs\
2. Jalankan Apache dan MySQL di XAMPP.
3. Buka http://localhost/phpmyadmin lalu Import file database.sql.
4. Buka http://localhost/JOTUN_WEB_FULL/setup.php untuk membuat admin.
5. Login melalui http://localhost/JOTUN_WEB_FULL/ dengan akun tadi.

Catatan: Ini aplikasi lokal dasar. Ganti kredensial database pada config.php bila MySQL Anda memakai password. Jangan gunakan di server publik tanpa hardening, validasi tambahan, HTTPS, CSRF, dan backup.
