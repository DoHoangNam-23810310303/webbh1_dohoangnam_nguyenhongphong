<?php
/**
 * UNIT TEST CHỨC NĂNG ĐĂNG NHẬP - WEBSITE ĐỒ THỂ THAO
 * Nhóm: [Tên nhóm của bạn]
 */

// 1. ĐƠN VỊ CẦN KIỂM THỬ (UNIT)
function check_login_logic($username, $password, $db_result_count) {
    // Trim để loại bỏ khoảng trắng thừa (giúp test case TC06, TC07 chính xác hơn)
    $username = trim($username);
    $password = trim($password);

    if (empty($username) || empty($password)) {
        return "fields_empty";
    }
    
    // Giả lập logic kiểm tra độ dài mật khẩu tối thiểu (ví dụ: 6 ký tự)
    if (strlen($password) < 3) {
        return "password_too_short";
    }

    if ($db_result_count > 0) {
        return "success";
    } else {
        return "fail";
    }
}

// 2. GIAO DIỆN BÁO CÁO (CSS)
echo '<style>
    body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; padding: 20px; background: #f4f7f6; }
    h2 { color: #2c3e50; text-align: center; text-transform: uppercase; }
    table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 20px; }
    th, td { padding: 12px; text-align: left; border: 1px solid #ddd; }
    th { background: #34495e; color: white; }
    tr:nth-child(even) { background-color: #f9f9f9; }
    .pass { color: #fff; background: #27ae60; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 0.9em; }
    .fail { color: #fff; background: #c0392b; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 0.9em; }
    .summary { background: #fff; padding: 15px; border-radius: 8px; border-left: 5px solid #3498db; font-weight: bold; font-size: 1.1em; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
</style>';

echo "<h2>BÁO CÁO UNIT TEST CHI TIẾT - CHỨC NĂNG ĐĂNG NHẬP</h2>";
echo "<table>
        <tr>
            <th>ID</th>
            <th>Kịch bản kiểm thử (Test Case)</th>
            <th>Dữ liệu đầu vào</th>
            <th>Kết quả kỳ vọng</th>
            <th>Kết quả thực tế</th>
            <th>Trạng thái</th>
        </tr>";

// --- THỰC HIỆN TEST CASES (Bổ sung thêm 5 trường hợp từ TC05 - TC09) ---
$test_cases = [
    ["id" => "TC01", "desc" => "Để trống tên đăng nhập", "user" => "", "pass" => "123", "db" => 0, "expected" => "fields_empty"],
    ["id" => "TC02", "desc" => "Để trống mật khẩu", "user" => "admin", "pass" => "", "db" => 0, "expected" => "fields_empty"],
    ["id" => "TC03", "desc" => "Đăng nhập đúng tài khoản", "user" => "admin", "pass" => "123", "db" => 1, "expected" => "success"],
    ["id" => "TC04", "desc" => "Tài khoản không tồn tại", "user" => "wronguser", "pass" => "123", "db" => 0, "expected" => "fail"],
    
    // --- 5 TRƯỜNG HỢP VIẾT THÊM ---
    [
        "id" => "TC05", 
        "desc" => "Mật khẩu quá ngắn (Dưới 3 ký tự)", 
        "user" => "admin", "pass" => "12", "db" => 1, 
        "expected" => "password_too_short"
    ],
    [
        "id" => "TC06", 
        "desc" => "Tên đăng nhập chỉ chứa khoảng trắng", 
        "user" => "   ", "pass" => "123456", "db" => 0, 
        "expected" => "fields_empty"
    ],
    [
        "id" => "TC07", 
        "desc" => "Mật khẩu chứa ký tự đặc biệt hợp lệ", 
        "user" => "user01", "pass" => "pass@word!#", "db" => 1, 
        "expected" => "success"
    ],
    [
        "id" => "TC08", 
        "desc" => "Tên đăng nhập viết hoa (Case sensitivity)", 
        "user" => "ADMIN", "pass" => "123", "db" => 0, 
        "expected" => "fail"
    ],
    [
        "id" => "TC09", 
        "desc" => "Tấn công SQL Injection cơ bản vào user", 
        "user" => "' OR '1'='1", "pass" => "123", "db" => 0, 
        "expected" => "fail"
    ]
];

$pass_count = 0;

foreach ($test_cases as $case) {
    $actual = check_login_logic($case['user'], $case['pass'], $case['db']);
    $status = ($actual === $case['expected']) ? "PASS" : "FAIL";
    $class = ($status === "PASS") ? "pass" : "fail";
    if ($status === "PASS") $pass_count++;

    echo "<tr>
            <td>{$case['id']}</td>
            <td>{$case['desc']}</td>
            <td>User: '{$case['user']}', Pass: '{$case['pass']}', DB: {$case['db']}</td>
            <td><b>{$case['expected']}</b></td>
            <td><i>{$actual}</i></td>
            <td><span class='$class'>$status</span></td>
          </tr>";
}

echo "</table>";

// TỔNG KẾT
$total = count($test_cases);
$percent = round(($pass_count / $total) * 100, 2);
echo "<div class='summary'>TỔNG KẾT: $pass_count / $total kịch bản thành công ($percent%)</div>";
?>