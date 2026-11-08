<?php
// Login & logout

// ---------- LOGOUT ----------
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// ---------- LOGIN ----------
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);

    $stmt = $mysqli->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['uid']  = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        log_activity('Login');
        header('Location: index.php');
        exit;
    }

    $error = 'Username atau password salah.';
}