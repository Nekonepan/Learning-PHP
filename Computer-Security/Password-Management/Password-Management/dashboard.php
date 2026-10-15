<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding-top: 100px;
            background: #f9fafb;
        }

        .box {
            background: white;
            display: inline-block;
            padding:
                40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .btn-logout {
            display: inline-block;
            margin-top: 20px;

            padding: 8px 20px;
            background: #dc2626;
            color: white;
            text- decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn-logout:hover {
            background: #b91c1c;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>Selamat Datang, <?php echo
            htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>Anda berhasil masuk ke sistem (Mode Tanpa Database).</p>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</body>

</html>