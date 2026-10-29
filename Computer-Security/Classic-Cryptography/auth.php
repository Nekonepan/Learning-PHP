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
    if (
        $username === $database_user['username'] && $password ===
        $database_user['password']
    ) {
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