<?php
require_once __DIR__ . '/../../src/CustomerRegistrationService.php';

use Webbh1\Auth\CustomerRegistrationService;

if (isset($_POST['dangky'])) {
    $registrationService = new CustomerRegistrationService();
    $tenkhachhang = $_POST['hovaten'] ?? '';
    $email = $_POST['email'] ?? '';
    $dienthoai = $_POST['dienthoai'] ?? '';
    $matkhau = $_POST['matkhau'] ?? '';
    $diachi = $_POST['diachi'] ?? '';

    $result = $registrationService->register(
        $tenkhachhang,
        $email,
        $dienthoai,
        $diachi,
        $matkhau,
        function (string $email) use ($mysqli): ?array {
            $stmt = $mysqli->prepare("SELECT id_dangky, email FROM tbl_dangky WHERE email = ? LIMIT 1");

            if (!$stmt) {
                return null;
            }

            $stmt->bind_param('s', $email);
            $stmt->execute();
            $queryResult = $stmt->get_result();
            $customer = $queryResult ? $queryResult->fetch_assoc() : null;
            $stmt->close();

            return $customer ?: null;
        },
        function (array $customerData) use ($mysqli): int {
            $stmt = $mysqli->prepare("INSERT INTO tbl_dangky (tenkhachhang, email, diachi, matkhau, dienthoai) VALUES (?, ?, ?, ?, ?)");

            if (!$stmt) {
                return 0;
            }

            $stmt->bind_param(
                'sssss',
                $customerData['tenkhachhang'],
                $customerData['email'],
                $customerData['diachi'],
                $customerData['matkhau'],
                $customerData['dienthoai']
            );

            $created = $stmt->execute();
            $insertId = $created ? (int) $mysqli->insert_id : 0;
            $stmt->close();

            return $insertId;
        }
    );

    if ($result['status'] === 'success') {
        echo "success: Bạn đã đăng kí thành công";
        $_SESSION['dangky'] = $result['full_name'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['id_khachhang'] = $result['customer_id'];
    } elseif ($result['status'] === 'fields_empty') {
        echo 'fail: Vui lòng nhập đầy đủ thông tin';
    } elseif ($result['status'] === 'invalid_email') {
        echo 'fail: Sai định dạng Email';
    } elseif ($result['status'] === 'invalid_phone') {
        echo 'fail: Số điện thoại chứa chữ';
    } elseif ($result['status'] === 'password_too_short') {
        echo 'fail: Mật khẩu quá ngắn';
    } elseif ($result['status'] === 'email_exists') {
        echo 'fail: Email đã tồn tại';
    } else {
        echo 'fail: Đăng ký thất bại';
    }
}
?>

<script>
    if ("<?php echo isset($_SESSION['dangky']); ?>" === "1") {
        window.location.href = "index.php?quanly=giohang";
    }
</script>

<style>
    table.dangky tr td { padding: 5px; }
    p { text-align: center; }
    .form-group { margin-bottom: 15px; }
</style>

<div class="container" style="margin-top: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h6 style="text-align: center; text-transform: uppercase; font-weight: bold;">Đăng kí thành viên</h6>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="hovaten">Họ và tên</label>
                    <input type="text" class="form-control" id="hovaten" name="hovaten">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="dienthoai">Điện thoại</label>
                    <input type="text" class="form-control" id="dienthoai" name="dienthoai">
                </div>
                <div class="form-group">
                    <label for="diachi">Địa chỉ</label>
                    <input type="text" class="form-control" id="diachi" name="diachi">
                </div>
                <div class="form-group">
                    <label for="matkhau">Mật khẩu</label>
                    <input type="password" class="form-control" id="matkhau" name="matkhau">
                </div>
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary" name="dangky">Đăng ký</button>
                    <br>
                    <a href="index.php?quanly=dangnhap" class="btn btn-link">Đăng nhập nếu có tài khoản</a>
                </div>
            </form>
        </div>
    </div>
</div>
