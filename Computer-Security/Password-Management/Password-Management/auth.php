<?php
session_start();

$database_user = [
    'username' => 'admin',
    'password' => '$2y$10$l9J3CB4.pRi3u/9b.F3aeeYDA20rOSOAv6YB6iPAzzu4FTI4RyHNO',
    'role' => 'Administrator',
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (
    !is_string($username)
    || !is_string($password)
    || $username !== $database_user['username']
    || !password_verify($password, $database_user['password'])
) {
    $_SESSION['error'] = 'Username atau password salah!';
    header('Location: index.php');
    exit;
}

session_regenerate_id(true);
$_SESSION['username'] = $database_user['username'];
$_SESSION['role'] = $database_user['role'];

header('Location: dashboard.php');
exit;