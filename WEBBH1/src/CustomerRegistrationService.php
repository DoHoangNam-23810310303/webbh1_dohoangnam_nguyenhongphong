<?php

declare(strict_types=1);

namespace Webbh1\Auth;

final class CustomerRegistrationService
{
    public function register(
        string $fullName,
        string $email,
        string $phone,
        string $address,
        string $password,
        callable $findCustomerByEmail,
        callable $createCustomer
    ): array {
        $fullName = trim($fullName);
        $email = trim($email);
        $phone = trim($phone);
        $address = trim($address);
        $password = trim($password);

        if ($fullName === '' || $email === '' || $phone === '' || $address === '' || $password === '') {
            return ['status' => 'fields_empty'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['status' => 'invalid_email'];
        }

        if (!ctype_digit($phone)) {
            return ['status' => 'invalid_phone'];
        }

        if (strlen($password) < 6) {
            return ['status' => 'password_too_short'];
        }

        if ($findCustomerByEmail($email) !== null) {
            return ['status' => 'email_exists'];
        }

        $customerId = $createCustomer([
            'tenkhachhang' => $fullName,
            'email' => $email,
            'diachi' => $address,
            'matkhau' => md5($password),
            'dienthoai' => $phone,
        ]);

        if (!$customerId) {
            return ['status' => 'register_failed'];
        }

        return [
            'status' => 'success',
            'customer_id' => (int) $customerId,
            'full_name' => $fullName,
            'email' => $email,
        ];
    }
}
