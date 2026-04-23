<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Webbh1\Auth\CustomerRegistrationService;

require_once __DIR__ . '/../src/CustomerRegistrationService.php';

// Unit test cho logic đăng ký khách hàng.
final class dangkiTest extends TestCase
{
    private CustomerRegistrationService $service;

    protected function setUp(): void
    {
        // Tạo mới service trước mỗi test case.
        $this->service = new CustomerRegistrationService();
    }

    public function testDangKyTruongHop01ThanhCongVoiDuLieuHopLe(): void
    {
        // Email chưa tồn tại và thao tác lưu thành công.
        $result = $this->service->register(
            'Nguyen Van A',
            'vana@gmail.com',
            '0901234567',
            'HCM',
            '123456',
            fn (string $email): ?array => null,
            fn (array $customer): int => 1
        );

        $this->assertSame('success', $result['status']);
    }

    public function testDangKyTruongHop02ThatBaiKhiThieuHoVaTen(): void
    {
        $result = $this->service->register(
            '',
            'vanb@gmail.com',
            '0901234568',
            'HCM',
            '123456',
            fn (string $email): ?array => null,
            fn (array $customer): int => 1
        );

        $this->assertSame(['status' => 'fields_empty'], $result);
    }

    public function testDangKyTruongHop03ThatBaiKhiSaiDinhDangEmail(): void
    {
        // Kiểm tra lỗi khi email không đúng định dạng.
        $result = $this->service->register(
            'Nguyen C',
            'error_mail',
            '0901234569',
            'HCM',
            '123456',
            fn (string $email): ?array => null,
            fn (array $customer): int => 1
        );

        $this->assertSame(['status' => 'invalid_email'], $result);
    }

    public function testDangKyTruongHop04ThatBaiKhiSoDienThoaiChuaChu(): void
    {
        $result = $this->service->register(
            'Nguyen D',
            'vand@gmail.com',
            '090abc123',
            'HCM',
            '123456',
            fn (string $email): ?array => null,
            fn (array $customer): int => 1
        );

        $this->assertSame(['status' => 'invalid_phone'], $result);
    }

    public function testDangKyTruongHop05ThatBaiKhiMatKhauQuaNgan(): void
    {
        $result = $this->service->register(
            'Nguyen E',
            'vane@gmail.com',
            '0901234570',
            'HCM',
            '123',
            fn (string $email): ?array => null,
            fn (array $customer): int => 1
        );

        $this->assertSame(['status' => 'password_too_short'], $result);
    }
}
