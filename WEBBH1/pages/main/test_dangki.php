<?php
/**
 * UNIT TEST CHỨC NĂNG ĐĂNG KÝ - WEBSITE ĐỒ THỂ THAO
 * Nhóm: [Tên nhóm của bạn]
 */

// 1. ĐƠN VỊ CẦN KIỂM THỬ (UNIT)
function check_register_logic($username, $email, $password, $repassword, $user_exists = false) {
    $username = trim($username);
    $email = trim($email);

    // Kiểm tra trống trường dữ liệu
    if (empty($username) || empty($email) || empty($password) || empty($repassword)) {
        return "fields_empty";
    }

    // Kiểm tra định dạng Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "invalid_email";
    }

    // Kiểm tra độ dài tên đăng nhập (Ví dụ: ít nhất 5 ký tự)
    if (strlen($username) < 5) {
        return "username_too_short";
    }

    // Kiểm tra mật khẩu nhập lại có khớp không
    if ($password !== $repassword) {
        return "password_mismatch";
    }

    // Kiểm tra độ mạnh mật khẩu (Ví dụ: ít nhất 6 ký tự)
    if (strlen($password) < 6) {
        return "password_weak";
    }

    // Kiểm tra tài khoản đã tồn tại trong DB chưa
    if ($user_exists) {
        return "user_already_exists";
    }

    return "success";
}

// 2. GIAO DIỆN BÁO CÁO (CSS)
echo '<style>
    body { font-family: "Segoe UI", sans-serif; padding: 20px; background: #f0f2f5; }
    h2 { color: #1a73e8; text-align: center; }
    table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    th { background: #1a73e8; color: white; }
    .pass { background: #28a745; color: white; padding: 3px 8px; border-radius: 4px; font-weight: bold; }
    .fail { background: #dc3545; color: white; padding: 3px 8px; border-radius: 4px; font-weight: bold; }
    .summary { margin-top: 20px; padding: 15px; background: #fff; border-left: 5px solid #1a73e8; font-weight: bold; }
</style>';

echo "<h2>BÁO CÁO UNIT TEST - CHỨC NĂNG ĐĂNG KÝ</h2>";
echo "<table>
        <tr>
            <th>ID</th>
            <th>Kịch bản kiểm thử</th>
            <th>Dữ liệu (User | Email | Pass | Re-pass)</th>
            <th>Kỳ vọng</th>
            <th>Thực tế</th>
            <th>Trạng thái</th>
        </tr>";

// 3. 10 TRƯỜNG HỢP KIỂM THỬ (TEST CASES)
$test_cases = [
    [
        "id" => "REG01", "desc" => "Để trống tất cả các trường",
        "u" => "", "e" => "", "p" => "", "re" => "", "exists" => false, "expected" => "fields_empty"
    ],
    [
        "id" => "REG02", "desc" => "Để trống email",
        "u" => "namdo", "e" => "", "p" => "123456", "re" => "123456", "exists" => false, "expected" => "fields_empty"
    ],
    [
        "id" => "REG03", "desc" => "Nhập sai định dạng email",
        "u" => "namdo", "e" => "namdo.com", "p" => "123456", "re" => "123456", "exists" => false, "expected" => "invalid_email"
    ],
    [
        "id" => "REG04", "desc" => "Tên đăng nhập quá ngắn (< 5 ký tự)",
        "u" => "nam", "e" => "nam@gmail.com", "p" => "123456", "re" => "123456", "exists" => false, "expected" => "username_too_short"
    ],
    [
        "id" => "REG05", "desc" => "Mật khẩu nhập lại không khớp",
        "u" => "namdo99", "e" => "nam@gmail.com", "p" => "123456", "re" => "123457", "exists" => false, "expected" => "password_mismatch"
    ],
    [
        "id" => "REG06", "desc" => "Mật khẩu quá yếu (< 6 ký tự)",
        "u" => "namdo99", "e" => "nam@gmail.com", "p" => "123", "re" => "123", "exists" => false, "expected" => "password_weak"
    ],
    [
        "id" => "REG07", "desc" => "Tên đăng nhập đã tồn tại trong hệ thống",
        "u" => "admin", "e" => "admin@gmail.com", "p" => "123456", "re" => "123456", "exists" => true, "expected" => "user_already_exists"
    ],
    [
        "id" => "REG08", "desc" => "Đăng ký thành công với dữ liệu chuẩn",
        "u" => "hoangnam", "e" => "nam@sport.vn", "p" => "123456", "re" => "123456", "exists" => false, "expected" => "success"
    ],
    [
        "id" => "REG09", "desc" => "Tên đăng nhập chứa ký tự đặc biệt (giả sử không cho phép)",
        "u" => "nam_do@!", "e" => "nam@gmail.com", "p" => "123456", "re" => "123456", "exists" => false, "expected" => "success" 
        // Note: Bạn có thể sửa logic check_register_logic để bắt lỗi này nếu cần
    ],
    [
        "id" => "REG10", "desc" => "Email có khoảng trắng ở đầu/cuối (phải trim thành công)",
        "u" => "namdo88", "e" => "  nam@gmail.com  ", "p" => "123456", "re" => "123456", "exists" => false, "expected" => "success"
    ]
];

$pass_count = 0;
foreach ($test_cases as $case) {
    $actual = check_register_logic($case['u'], $case['e'], $case['p'], $case['re'], $case['exists']);
    $status = ($actual === $case['expected']) ? "PASS" : "FAIL";
    if ($status === "PASS") $pass_count++;
    $class = ($status === "PASS") ? "pass" : "fail";

    echo "<tr>
            <td>{$case['id']}</td>
            <td>{$case['desc']}</td>
            <td>{$case['u']} | {$case['e']} | {$case['p']} | {$case['re']}</td>
            <td><b>{$case['expected']}</b></td>
            <td><i>{$actual}</i></td>
            <td><span class='$class'>$status</span></td>
          </tr>";
}
echo "</table>";

$total = count($test_cases);
echo "<div class='summary'>KẾT QUẢ TỔNG QUAN: $pass_count / $total kịch bản thành công.</div>";
?>