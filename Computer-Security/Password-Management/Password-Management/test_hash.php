<?php
$password_asli = "AdminSec123!";
// Mengubah password menjadi hash yang aman
$hash_bcrypt = password_hash($password_asli, PASSWORD_BCRYPT);
echo "Password Asli: " . $password_asli . "<br>";
echo "Hasil Hash Bcrypt: " . $hash_bcrypt . "<br><br>";
// Simulasi Verifikasi Password saat Login
if (password_verify("AdminSec123!", $hash_bcrypt)) {
    echo "<b>Status:</b> Password Cocok (Login Berhasil!)";
} else {
    echo "<b>Status:</b> Password Salah (Login Ditolak!)";
}
?>