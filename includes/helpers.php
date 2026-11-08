<?php
// Fungsi bantuan

function rows($sql) {
    global $mysqli;
    return $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
}

function badge($status) {
    $k = trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($status)), '-');
    return '<span class="badge badge-' . $k . '">' . e($status) . '</span>';
}