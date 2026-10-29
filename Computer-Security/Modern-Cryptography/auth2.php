<?php
session_start();

// Simulasi Database: Password "admin123" telah di-hash
// Hasil MD5 dari "admin123" adalah "0192023a7bbd73250516f069df18b500"
$database_user = [
    'username' => 'admin',
    'password' => '0192023a7bbd73250516f069df18b500',
    'role' => 'Administrator'
];

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password_input = trim($_POST['password']);

    // Mengubah input password menjadi hash MD5
    $password_md5 = md5($password_input);

    // Validasi pencocokan username dan hash MD5
    if ($username === $database_user['username'] && $password_md5 === $database_user['password']) {
        $_SESSION['username'] = $database_user['username'];
        $_SESSION['role'] = $database_user['role'];
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Username atau Password salah!";
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>