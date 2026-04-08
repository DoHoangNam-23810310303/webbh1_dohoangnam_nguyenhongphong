<?php
session_start();
include('config/config.php');
require_once __DIR__ . '/../src/AdminLoginService.php';

use Webbh1\Auth\AdminLoginService;

if (isset($_POST['dangnhap'])) {
    $loginService = new AdminLoginService();
    $taikhoan = $_POST['username'] ?? '';
    $matkhau = $_POST['password'] ?? '';

    $result = $loginService->authenticate($taikhoan, $matkhau, function (string $username) use ($mysqli): ?array {
        $stmt = $mysqli->prepare("SELECT username, password FROM tbl_admin WHERE username = ? LIMIT 1");

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('s', $username);
        $stmt->execute();
        $queryResult = $stmt->get_result();
        $admin = $queryResult ? $queryResult->fetch_assoc() : null;
        $stmt->close();

        return $admin ?: null;
    });

    if ($result['status'] === 'success') {
        $_SESSION['dangnhap'] = $result['username'];
        header('location:index.php');
        exit();
    }

    echo '<script>alert("Tài khoản hoặc mật khẩu không đúng, vui lòng nhập lại");</script>';
    header('location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
     body {
            background: #f2f2f2;
            background-image: url(../images/p63.webp);
            background-size: cover;
            background-repeat: no-repeat;
            }


        .wrapper-login {
            width: 25%;
            margin: 0 auto;
            margin-top: 100px; /* Để căn giữa form theo chiều dọc */
        }
    </style>
</head>
<body>
<div class="wrapper-login">
    <form action="" method="POST">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Đăng nhập Admin</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="username">Tài khoản</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" name="dangnhap" value="Đăng nhập">
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
