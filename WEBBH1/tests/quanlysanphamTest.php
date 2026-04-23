<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Webbh1\Product\ProductManagementService;

require_once __DIR__ . '/../src/ProductManagementService.php';

// Unit test cho logic thêm/xóa sản phẩm.
final class quanlysanphamTest extends TestCase
{
    private ProductManagementService $service;

    protected function setUp(): void
    {
        // Tạo mới service trước mỗi test case.
        $this->service = new ProductManagementService();
    }

    public function testQuanLySanPhamTruongHop01ThemThanhCong(): void
    {
        // Mã sản phẩm chưa tồn tại và lưu thành công.
        $result = $this->service->create(
            [
                'tensanpham' => 'Nike air max',
                'masp' => 'NK01',
                'giasp' => '2000000',
                'soluong' => '10',
                'hinhanh' => 'nike.jpg',
                'tomtat' => 'Mo ta ngan',
                'noidung' => 'Mo ta chi tiet',
                'tinhtrang' => '1',
                'danhmuc' => '2',
            ],
            fn (string $code): bool => false,
            fn (array $product): int => 1
        );

        $this->assertSame('success', $result['status']);
    }

    public function testQuanLySanPhamTruongHop02ThatBaiKhiTrongTenSanPham(): void
    {
        $result = $this->service->create(
            [
                'tensanpham' => '',
                'masp' => 'NK02',
                'giasp' => '1500000',
                'soluong' => '5',
                'hinhanh' => 'nike2.jpg',
                'tomtat' => 'Mo ta ngan',
                'noidung' => 'Mo ta chi tiet',
                'tinhtrang' => '1',
                'danhmuc' => '2',
            ],
            fn (string $code): bool => false,
            fn (array $product): int => 1
        );

        $this->assertSame(['status' => 'empty_product_name'], $result);
    }

    public function testQuanLySanPhamTruongHop03ThatBaiKhiTrongMaSanPham(): void
    {
        $result = $this->service->create(
            [
                'tensanpham' => 'Adidas Neo',
                'masp' => '',
                'giasp' => '1200000',
                'soluong' => '20',
                'hinhanh' => 'adidas.jpg',
                'tomtat' => 'Mo ta ngan',
                'noidung' => 'Mo ta chi tiet',
                'tinhtrang' => '1',
                'danhmuc' => '2',
            ],
            fn (string $code): bool => false,
            fn (array $product): int => 1
        );

        $this->assertSame(['status' => 'empty_product_code'], $result);
    }

    public function testQuanLySanPhamTruongHop04ThatBaiKhiGiaKhongPhaiLaSo(): void
    {
        $result = $this->service->create(
            [
                'tensanpham' => 'Puma RS',
                'masp' => 'PM01',
                'giasp' => 'Abc',
                'soluong' => '10',
                'hinhanh' => 'puma.jpg',
                'tomtat' => 'Mo ta ngan',
                'noidung' => 'Mo ta chi tiet',
                'tinhtrang' => '1',
                'danhmuc' => '2',
            ],
            fn (string $code): bool => false,
            fn (array $product): int => 1
        );

        $this->assertSame(['status' => 'invalid_price'], $result);
    }

    public function testQuanLySanPhamTruongHop05ThatBaiKhiGiaSanPhamAm(): void
    {
        $result = $this->service->create(
            [
                'tensanpham' => 'Bitis Hunter',
                'masp' => 'BT01',
                'giasp' => '-500000',
                'soluong' => '15',
                'hinhanh' => 'bitis.jpg',
                'tomtat' => 'Mo ta ngan',
                'noidung' => 'Mo ta chi tiet',
                'tinhtrang' => '1',
                'danhmuc' => '2',
            ],
            fn (string $code): bool => false,
            fn (array $product): int => 1
        );

        $this->assertSame(['status' => 'invalid_price'], $result);
    }

    public function testQuanLySanPhamTruongHop06ThatBaiKhiSoLuongKhongPhaiLaSo(): void
    {
        $result = $this->service->create(
            [
                'tensanpham' => 'Converse',
                'masp' => 'CV01',
                'giasp' => '800000',
                'soluong' => 'Xyz',
                'hinhanh' => 'converse.jpg',
                'tomtat' => 'Mo ta ngan',
                'noidung' => 'Mo ta chi tiet',
                'tinhtrang' => '1',
                'danhmuc' => '2',
            ],
            fn (string $code): bool => false,
            fn (array $product): int => 1
        );

        $this->assertSame(['status' => 'invalid_quantity'], $result);
    }

    public function testQuanLySanPhamTruongHop07XoaSanPhamThanhCong(): void
    {
        // Giả lập sản phẩm tồn tại và xóa thành công.
        $result = $this->service->delete(
            23,
            fn (int $id): bool => true,
            fn (int $id): bool => true
        );

        $this->assertSame(['status' => 'success', 'product_id' => 23], $result);
    }
}
