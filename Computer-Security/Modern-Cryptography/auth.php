<?php
session_start();
$database_user = [
    'username' => 'admin',
    'password' => 'admin123',
    'role' => 'Administrator'
];
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    // Validasi pencocokan data dengan "database" array
    if (
        $username === $database_user['username'] && $password ===
        $database_user['password']
    ) {
        // Jika Berhasil
        $_SESSION['username'] = $database_user['username'];
        $_SESSION['role'] = $database_user['role'];
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika Gagal, set pesan alert error
        $_SESSION['error'] = "Username atau Password salah!";
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>