<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Praktikum Keamanan Komputer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana,
                sans-serif;
            background: #eef2f3;
            display: flex;
            justify-content:
                center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: #ffffff;
            padding: 30px;
            border-radius:
                10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        .card h2 {
            text-align: center;
            color: #333;
            margin-bottom:
                20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing:
                border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size:
                14px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #4f46e5;
            border: none;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #4338ca;
        }

        .alert {
            background: #fee2e2;
            color: #991b1b;
            padding:
                10px;
            border-radius: 5px;
            font-size: 13px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Silakan Login</h2>
        <!-- Menampilkan alert jika username/password salah -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
        <form action="auth.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn">Login</button>
        </form>
    </div>
</body>

</html>