<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$pesan_asal = "";
$geser = 3;
$hasil_proses = "";
$aksi = "";

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

function caesarDecrypt($text, $shift)
{
    return caesarEncrypt($text, 26 - ($shift % 26));
}

if (isset($_POST['proses'])) {
    $pesan_asal = $_POST['teks'];
    $geser = (int) $_POST['shift'];
    $aksi = $_POST['aksi'];

    if ($aksi == "encrypt") {
        $hasil_proses = caesarEncrypt($pesan_asal, $geser);
    } else {
        $hasil_proses = caesarDecrypt($pesan_asal, $geser);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard & Caesar Cipher Tool</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 600px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .btn-logout {
            background: #dc2626;
            color: white;
            text-decoration: none;
            padding: 6px 15px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 14px;
        }

        .btn-logout:hover {
            background: #b91c1c;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #4b5563;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-submit {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }

        .btn-submit:hover {
            background: #4338ca;
        }

        .result-box {
            background: #f3f4f6;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            border-left: 4px solid #4f46e5;
        }

        .result-box h4 {
            margin: 0 0 5px 0;
            color: #1f2937;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <div>
                <h3 style="margin: 0; color: #1f2937;">
                    Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                </h3>

                <small style="color: #6b7280;">
                    Sistem Keamanan Komputer - Modul Kriptografi
                </small>
            </div>

            <a href="logout.php" class="btn-logout">Logout</a>
        </div>

        <h4>Simulasi Caesar Cipher (Enkripsi & Dekripsi)</h4>

        <form method="POST" action="">
            <div class="form-group">
                <label>Masukkan Teks (Plaintext / Ciphertext):</label>

                <textarea name="teks" rows="3" required><?php
                echo htmlspecialchars($pesan_asal);
                ?></textarea>
            </div>

            <div class="form-group">
                <label>Jumlah Pergeseran (Shift Key):</label>

                <input type="number" name="shift" value="<?php echo $geser; ?>" min="1" max="25" required>
            </div>

            <div class="form-group">
                <label>Pilih Aksi:</label>

                <select name="aksi">
                    <option value="encrypt" <?php if ($aksi == "encrypt")
                        echo "selected"; ?>>
                        Enkripsi (Plaintext -> Ciphertext)
                    </option>

                    <option value="decrypt" <?php if ($aksi == "decrypt")
                        echo "selected"; ?>>
                        Dekripsi (Ciphertext -> Plaintext)
                    </option>
                </select>
            </div>

            <button type="submit" name="proses" class="btn-submit">
                Jalankan Proses
            </button>
        </form>

        <?php if (isset($_POST['proses'])): ?>
            <div class="result-box">
                <h4>Hasil Output:</h4>

                <p style="
                    word-break: break-all;
                    font-family: monospace;
                    font-size: 16px;
                    color: #047857;
                    margin: 0;
                ">
                    <?php echo htmlspecialchars($hasil_proses); ?>
                </p>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>