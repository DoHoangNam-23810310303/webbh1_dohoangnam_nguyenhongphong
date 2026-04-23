<?php

declare(strict_types=1);

namespace Webbh1\Auth;

final class AdminLoginService
{
    public function authenticate(string $username, string $password, callable $findAdminByUsername): array
    {
        $username = trim($username);
        $password = trim($password);

        if ($username === '' || $password === '') {
            return ['status' => 'fields_empty'];
        }

        $admin = $findAdminByUsername($username);

        if (!is_array($admin) || !isset($admin['username'], $admin['password'])) {
            return ['status' => 'invalid_credentials'];
        }

        if (md5($password) !== (string) $admin['password']) {
            return ['status' => 'invalid_credentials'];
        }

        return [
            'status' => 'success',
            'username' => (string) $admin['username'],
        ];
    }
}
