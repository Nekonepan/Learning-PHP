<?php
session_start();

function caesarEncrypt($text, $shift)
{
    $result = "";
    $shift = $shift % 26;

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];

        if (ctype_upper($char)) {
            $result .= chr((ord($char) + $shift - 65) % 26 + 65);
        } elseif (ctype_lower($char)) {
            $result .= chr((ord($char) + $shift - 97) % 26 + 97);
        } else {
            $result .= $char;
        }
    }

    return $result;
}

$shift_key = 3;

$database_user = [
    'username' => 'admin',
    'password' => 'dgplq123',
    'role' => 'Administrator'
];

if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password_input = trim($_POST['password'] ?? '');

    $password_ciphertext = caesarEncrypt(
        $password_input,
        $shift_key
    );

    if (
        $username === $database_user['username'] &&
        $password_ciphertext === $database_user['password']
    ) {
        session_regenerate_id(true);

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