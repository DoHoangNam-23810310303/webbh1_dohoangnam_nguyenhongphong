<?php
include('../../config/config.php');
require_once __DIR__ . '/../../../src/ProductManagementService.php';

use Webbh1\Product\ProductManagementService;

$productService = new ProductManagementService();

$tensanpham = isset($_POST['tensanpham']) ? $_POST['tensanpham'] : '';
$masp = isset($_POST['masp']) ? $_POST['masp'] : '';
$giasp = isset($_POST['giasp']) ? $_POST['giasp'] : '';
$soluong = isset($_POST['soluong']) ? $_POST['soluong'] : '';
$tomtat = isset($_POST['tomtat']) ? $_POST['tomtat'] : '';
$noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
$tinhtrang = isset($_POST['tinhtrang']) ? $_POST['tinhtrang'] : '';
$danhmuc = isset($_POST['danhmuc']) ? $_POST['danhmuc'] : '';

$hinhanh = isset($_FILES['hinhanh']['name']) ? $_FILES['hinhanh']['name'] : '';
$hinhanh_tmp = isset($_FILES['hinhanh']['tmp_name']) ? $_FILES['hinhanh']['tmp_name'] : '';
$hinhanh_time = $hinhanh !== '' ? time() . '_' . $hinhanh : '';

$is_test = isset($_POST['postman_test']) || isset($_GET['postman_test']);

function outputProductMessage(string $status): void
{
    $messages = [
        'empty_product_name' => 'fail: Trống tên sản phẩm',
        'empty_product_code' => 'fail: Trống mã sản phẩm',
        'invalid_price' => 'fail: Giá sản phẩm không hợp lệ',
        'invalid_quantity' => 'fail: Số lượng không hợp lệ',
        'empty_image' => 'fail: Trống hình ảnh',
        'invalid_category' => 'fail: Danh mục không hợp lệ',
        'product_code_exists' => 'fail: Mã sản phẩm đã tồn tại',
        'product_not_found' => 'fail: Không tìm thấy sản phẩm',
        'invalid_product_id' => 'fail: ID sản phẩm không hợp lệ',
        'create_failed' => 'fail: Thêm sản phẩm thất bại',
        'update_failed' => 'fail: Sửa sản phẩm thất bại',
        'delete_failed' => 'fail: Xóa sản phẩm thất bại',
        'success_create' => 'success: Thêm sản phẩm thành công',
        'success_update' => 'success: Sửa sản phẩm thành công',
        'success_delete' => 'success: Xóa sản phẩm thành công',
    ];

    echo $messages[$status] ?? 'fail: Lỗi không xác định';
}

if (isset($_POST['themsanpham'])) {
    $result = $productService->create(
        [
            'tensanpham' => $tensanpham,
            'masp' => $masp,
            'giasp' => $giasp,
            'soluong' => $soluong,
            'hinhanh' => $hinhanh_time,
            'tomtat' => $tomtat,
            'noidung' => $noidung,
            'tinhtrang' => $tinhtrang,
            'danhmuc' => $danhmuc,
        ],
        function (string $code) use ($mysqli): bool {
            $stmt = $mysqli->prepare('SELECT id_sanpham FROM tbl_sanpham WHERE masp = ? LIMIT 1');
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param('s', $code);
            $stmt->execute();
            $queryResult = $stmt->get_result();
            $exists = $queryResult && $queryResult->fetch_assoc();
            $stmt->close();
            return (bool) $exists;
        },
        function (array $product) use ($mysqli): int {
            $stmt = $mysqli->prepare('INSERT INTO tbl_sanpham(tensanpham,masp,giasp,soluong,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) VALUES(?,?,?,?,?,?,?,?,?)');
            if (!$stmt) {
                return 0;
            }
            $stmt->bind_param(
                'sssissssi',
                $product['tensanpham'],
                $product['masp'],
                $product['giasp'],
                $product['soluong'],
                $product['hinhanh'],
                $product['tomtat'],
                $product['noidung'],
                $product['tinhtrang'],
                $product['danhmuc']
            );
            $created = $stmt->execute();
            $insertId = $created ? (int) $mysqli->insert_id : 0;
            $stmt->close();
            return $insertId;
        }
    );

    if ($result['status'] === 'success') {
        if ($hinhanh_time !== '') {
            move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh_time);
        }
        outputProductMessage('success_create');
        if (!$is_test) {
            header('location:../../index.php?action=quanlysanpham&query=them');
        }
    } else {
        outputProductMessage($result['status']);
    }
} elseif (isset($_POST['suasanpham'])) {
    $productId = isset($_GET['idsanpham']) ? (int) $_GET['idsanpham'] : 0;

    $result = $productService->update(
        [
            'id_sanpham' => $productId,
            'tensanpham' => $tensanpham,
            'masp' => $masp,
            'giasp' => $giasp,
            'soluong' => $soluong,
            'hinhanh' => $hinhanh_time,
            'tomtat' => $tomtat,
            'noidung' => $noidung,
            'tinhtrang' => $tinhtrang,
            'danhmuc' => $danhmuc,
        ],
        function (int $id) use ($mysqli): bool {
            $stmt = $mysqli->prepare('SELECT id_sanpham FROM tbl_sanpham WHERE id_sanpham = ? LIMIT 1');
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $queryResult = $stmt->get_result();
            $exists = $queryResult && $queryResult->fetch_assoc();
            $stmt->close();
            return (bool) $exists;
        },
        function (int $id, array $product) use ($mysqli, $hinhanh_time, $hinhanh_tmp): bool {
            if ($hinhanh_time !== '') {
                move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh_time);
                $stmt = $mysqli->prepare('UPDATE tbl_sanpham SET tensanpham=?, masp=?, giasp=?, soluong=?, hinhanh=?, tomtat=?, noidung=?, tinhtrang=?, id_danhmuc=? WHERE id_sanpham=?');
                if (!$stmt) {
                    return false;
                }
                $stmt->bind_param(
                    'sssissssii',
                    $product['tensanpham'],
                    $product['masp'],
                    $product['giasp'],
                    $product['soluong'],
                    $product['hinhanh'],
                    $product['tomtat'],
                    $product['noidung'],
                    $product['tinhtrang'],
                    $product['danhmuc'],
                    $id
                );
            } else {
                $stmt = $mysqli->prepare('UPDATE tbl_sanpham SET tensanpham=?, masp=?, giasp=?, soluong=?, tomtat=?, noidung=?, tinhtrang=?, id_danhmuc=? WHERE id_sanpham=?');
                if (!$stmt) {
                    return false;
                }
                $stmt->bind_param(
                    'sssisssii',
                    $product['tensanpham'],
                    $product['masp'],
                    $product['giasp'],
                    $product['soluong'],
                    $product['tomtat'],
                    $product['noidung'],
                    $product['tinhtrang'],
                    $product['danhmuc'],
                    $id
                );
            }
            $updated = $stmt->execute();
            $stmt->close();
            return $updated;
        }
    );

    if ($result['status'] === 'success') {
        outputProductMessage('success_update');
        if (!$is_test) {
            header('location:../../index.php?action=quanlysanpham&query=them');
        }
    } else {
        outputProductMessage($result['status']);
    }
} else {
    $productId = isset($_GET['idsanpham']) ? (int) $_GET['idsanpham'] : 0;

    $result = $productService->delete(
        $productId,
        function (int $id) use ($mysqli): bool {
            $stmt = $mysqli->prepare('SELECT id_sanpham FROM tbl_sanpham WHERE id_sanpham = ? LIMIT 1');
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $queryResult = $stmt->get_result();
            $exists = $queryResult && $queryResult->fetch_assoc();
            $stmt->close();
            return (bool) $exists;
        },
        function (int $id) use ($mysqli): bool {
            $stmt = $mysqli->prepare('DELETE FROM tbl_sanpham WHERE id_sanpham = ?');
            if (!$stmt) {
                return false;
            }
            $stmt->bind_param('i', $id);
            $deleted = $stmt->execute();
            $stmt->close();
            return $deleted;
        }
    );

    if ($result['status'] === 'success') {
        outputProductMessage('success_delete');
        if (!$is_test) {
            header('location:../../index.php?action=quanlysanpham&query=them');
        }
    } else {
        outputProductMessage($result['status']);
    }
}
?>
