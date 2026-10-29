<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$input_teks = "";
$hasil_md5 = "";
$verifikasi_teks = "";
$verifikasi_hash = "";
$status_verifikasi = "";

// Proses Generate MD5
if (isset($_POST['generate'])) {
    $input_teks = $_POST['input_teks'];
    $hasil_md5 = md5($input_teks); // Fungsi bawaan PHP untuk MD5
}

// Proses Verifikasi Integritas
if (isset($_POST['verify'])) {
    $verifikasi_teks = $_POST['verifikasi_teks'];
    $verifikasi_hash = trim($_POST['verifikasi_hash']);
    $calculated_hash = md5($verifikasi_teks);

    if (strtolower($calculated_hash) === strtolower($verifikasi_hash)) {
        $status_verifikasi = "<div class='alert-success'><b>MATCH!</b> Integritas file/teks terjaga. Tidak ada perubahan.</div>";
    } else {
        $status_verifikasi = "<div class='alert-danger'><b>MISMATCH!</b> Peringatan: Teks telah dimodifikasi. Hash berbeda!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - MD5 Check Utility</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .btn-logout {
            background: #dc3545;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .card-section {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-primary {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .hash-result {
            font-family: monospace;
            font-size: 18px;
            color: #198754;
            background: #e8f5e9;
            padding: 10px;
            border-radius: 4px;
            word-break: break-all;
        }

        .alert-success {
            color: #0f5132;
            background-color: #d1e7dd;
            padding: 15px;
            border-radius: 4px;
            margin-top: 15px;
        }

        .alert-danger {
            color: #842029;
            background-color: #f8d7da;
            padding: 15px;
            border-radius: 4px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>MD5 Check Utility - Web Version</h2>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>

        <!-- Fitur 1: Generate MD5 -->
        <div class="card-section">
            <h3>1. Buat MD5 Checksum</h3>
            <p><small>Masukkan teks (misal: "Aplikasi" atau "aplikasi") untuk melihat perbedaan hash yang
                    dihasilkan.</small></p>
            <form method="POST">
                <textarea name="input_teks" rows="3" required
                    placeholder="Masukkan teks asli di sini..."><?= htmlspecialchars($input_teks) ?></textarea>
                <button type="submit" name="generate" class="btn-primary">Generate Hash MD5</button>
            </form>

            <?php if ($hasil_md5): ?>
                <div style="margin-top: 15px;">
                    <strong>Hasil Hash (32 Karakter Hex):</strong>
                    <div class="hash-result"><?= $hasil_md5 ?></div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Fitur 2: Verifikasi MD5 -->
        <div class="card-section">
            <h3>2. Verifikasi Integritas Data (Authentication)</h3>
            <p><small>Uji perubahan 1 bit. Masukkan teks yang sudah diubah sedikit, lalu cocokkan dengan Hash MD5
                    aslinya.</small></p>
            <form method="POST">
                <label>Teks Arsip Saat Ini:</label>
                <textarea name="verifikasi_teks" rows="2" required
                    placeholder="Masukkan teks untuk diuji..."><?= htmlspecialchars($verifikasi_teks) ?></textarea>

                <label>Paste MD5 Checksum Asli:</label>
                <input type="text" name="verifikasi_hash" required value="<?= htmlspecialchars($verifikasi_hash) ?>"
                    placeholder="Contoh: 4B97E98235F061A3923C4B005E9704A9">

                <button type="submit" name="verify" class="btn-primary">Verifikasi Sekarang</button>
            </form>
            <?= $status_verifikasi ?>
        </div>
    </div>
</body>

</html>