<?php

declare(strict_types=1);

namespace Webbh1\Auth;

final class CustomerLoginService
{
    public function authenticate(string $email, string $password, callable $findCustomerByEmail): array
    {
        $email = trim($email);
        $password = trim($password);

        if ($email === '' || $password === '') {
            return ['status' => 'fields_empty'];
        }

        $customer = $findCustomerByEmail($email);

        if (!is_array($customer) || !isset($customer['email'], $customer['matkhau'])) {
            return ['status' => 'invalid_credentials'];
        }

        if (md5($password) !== (string) $customer['matkhau']) {
            return ['status' => 'invalid_credentials'];
        }

        return [
            'status' => 'success',
            'customer_name' => (string) ($customer['tenkhachhang'] ?? ''),
            'email' => (string) $customer['email'],
            'customer_id' => (int) ($customer['id_dangky'] ?? 0),
        ];
    }
}
