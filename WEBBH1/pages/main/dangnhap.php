<?php
require_once __DIR__ . '/../../src/CustomerLoginService.php';

use Webbh1\Auth\CustomerLoginService;

if (isset($_POST['dangnhap'])) {
    $loginService = new CustomerLoginService();
    $email = $_POST['email'] ?? '';
    $matkhau = $_POST['password'] ?? '';

    $result = $loginService->authenticate($email, $matkhau, function (string $email) use ($mysqli): ?array {
        $stmt = $mysqli->prepare('SELECT id_dangky, tenkhachhang, email, matkhau FROM tbl_dangky WHERE email = ? LIMIT 1');

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('s', $email);
        $stmt->execute();
        $queryResult = $stmt->get_result();
        $customer = $queryResult ? $queryResult->fetch_assoc() : null;
        $stmt->close();

        return $customer ?: null;
    });

    if ($result['status'] === 'success') {
        $_SESSION['dangky'] = $result['customer_name'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['id_khachhang'] = $result['customer_id'];
    } else {
        echo '<p style="color:red">Mật khẩu hoặc tài khoản sai. Vui lòng đăng nhập lại.</p>';
    }
}
?>

<script>
    if ("<?php echo isset($_SESSION['dangky']); ?>" === "1") {
        alert("Đăng nhập thành công");
        window.location.href = "index.php";
    }
</script>

<form action="" method="POST">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Đăng nhập khách hàng</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">Tài khoản</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email...">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu...">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" name="dangnhap" value="Đăng nhập">
                        </div>
                        <div class="form-group text-center">
                            <a href="index.php?quanly=dangky">Đăng ký tài khoản</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
