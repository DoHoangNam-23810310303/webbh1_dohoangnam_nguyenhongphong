<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Webbh1\Auth\CustomerLoginService;

require_once __DIR__ . '/../src/CustomerLoginService.php';

// Unit test cho logic đăng nhập khách hàng.
final class dangnhapTest extends TestCase
{
    private CustomerLoginService $service;

    protected function setUp(): void
    {
        // Tạo mới service trước mỗi test case.
        $this->service = new CustomerLoginService();
    }

    public function testDangNhapTruongHop01ThanhCongVoiTaiKhoanHopLe(): void
    {
        // Giả lập dữ liệu khách hàng tồn tại trong hệ thống.
        $result = $this->service->authenticate('vana@gmail.com', '123456', function (string $email): array {
            return [
                'id_dangky' => 1,
                'tenkhachhang' => 'Nguyen Van A',
                'email' => $email,
                'matkhau' => md5('123456'),
            ];
        });

        $this->assertSame('success', $result['status']);
    }

    public function testDangNhapTruongHop02ThatBaiKhiSaiMatKhau(): void
    {
        $result = $this->service->authenticate('vana@gmail.com', '654321', function (string $email): array {
            return [
                'id_dangky' => 1,
                'tenkhachhang' => 'Nguyen Van A',
                'email' => $email,
                'matkhau' => md5('123456'),
            ];
        });

        $this->assertSame(['status' => 'invalid_credentials'], $result);
    }

    public function testDangNhapTruongHop03ThatBaiKhiEmailKhongTonTai(): void
    {
        // Trả về null để mô phỏng email không tồn tại.
        $result = $this->service->authenticate('sai_mail@gmail.com', '123456', fn (string $email): ?array => null);

        $this->assertSame(['status' => 'invalid_credentials'], $result);
    }

    public function testDangNhapTruongHop04ThatBaiKhiThieuEmail(): void
    {
        $result = $this->service->authenticate('', '123456', fn (string $email): ?array => null);

        $this->assertSame(['status' => 'fields_empty'], $result);
    }

    public function testDangNhapTruongHop05ThatBaiKhiThieuMatKhau(): void
    {
        $result = $this->service->authenticate('vana@gmail.com', '', fn (string $email): ?array => null);

        $this->assertSame(['status' => 'fields_empty'], $result);
    }

    public function testDangNhapTruongHop06ThatBaiKhiSaiLoaiTaiKhoan(): void
    {
        $result = $this->service->authenticate('admin@gmail.com', 'Admin123', fn (string $email): ?array => null);

        $this->assertSame(['status' => 'invalid_credentials'], $result);
    }

    public function testDangNhapTruongHop07ThatBaiKhiKhongNhapDuLieu(): void
    {
        $result = $this->service->authenticate('', '', fn (string $email): ?array => null);

        $this->assertSame(['status' => 'fields_empty'], $result);
    }
}
