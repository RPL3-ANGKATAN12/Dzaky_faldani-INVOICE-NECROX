<?php
// ============================================================
// FOTO PROFIL - disimpan sebagai file uploads/avatars/{id_user}.jpg|png|webp
// (tidak perlu mengubah tabel database)
// ============================================================

function avatar_url($id) {
    $files = glob(__DIR__ . '/uploads/avatars/' . (int)$id . '.*');
    return $files ? 'uploads/avatars/' . basename($files[0]) . '?t=' . filemtime($files[0]) : null;
}

function save_avatar($id, $file) {
    if (empty($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK || $file['size'] > 2097152) {
        return false;
    }
    $info = @getimagesize($file['tmp_name']);
    $types = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_WEBP => 'webp'];
    $ext = $types[$info[2] ?? 0] ?? null;
    if (!$ext) return false;

    $dir = __DIR__ . '/uploads/avatars/';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    foreach (glob($dir . (int)$id . '.*') as $old) unlink($old);

    return move_uploaded_file($file['tmp_name'], $dir . (int)$id . '.' . $ext);
}