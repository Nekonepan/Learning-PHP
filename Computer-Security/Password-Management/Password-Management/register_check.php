<?php
function cekKekuatanPassword($password)
{
    $pesan = [];
    // Syarat 1: Minimal 8 karakter
    if (strlen($password) < 8) {
        $pesan[] = "Password terlalu pendek (minimal 8 karakter).";
    }
    // Syarat 2: Harus mengandung angka
    if (!preg_match("#[0-9]+#", $password)) {
        $pesan[] = "Password harus mengandung setidaknya satu
angka.";
    }
    // Syarat 3: Harus mengandung huruf besar
    if (!preg_match("#[A-Z]+#", $password)) {
        $pesan[] = "Password harus mengandung setidaknya satu huruf
besar.";
    }
    return $pesan;
}
// Contoh Pengujian
$password_uji = "lemah";
$hasil_cek = cekKekuatanPassword($password_uji);
if (!empty($hasil_cek)) {
    echo "Password ditolak:<br>";
    foreach ($hasil_cek as $err) {
        echo "- " . $err . "<br>";
    }
} else {
    echo "Password kuat dan diterima!";
}
?>