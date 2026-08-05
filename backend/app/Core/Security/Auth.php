<?php

declare(strict_types=1);

namespace App\Core\Security;

class Auth
{
    protected static ?array $user = null;

    public static function login(
        array $user
    ): string {
        return JWT::generate(
            [
                'user_id' => $user['id'],
                'email' => $user['email'],
                'role' => $user['role'] ?? 'guest',
                'permissions' => $user['permissions'] ?? []
            ]
        );
    }

    public static function setUser(
        array $user
    ): void {
        self::$user = $user;
    }

    public static function user(): ?array
    {
        return self::$user;
    }

    public static function check(): bool
    {
        return self::$user !== null;
    }

    public static function logout(): void
    {
        self::$user = null;
    }
}
