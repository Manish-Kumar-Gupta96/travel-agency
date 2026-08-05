<?php

declare(strict_types=1);

namespace App\Core\Security;

class CSRF
{
    public static function generate(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;

        return $token;
    }

    public static function verify(?string $token): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $sessionToken = $_SESSION['csrf_token'] ?? null;
        if ($sessionToken === null || $token === null) {
            return false;
        }

        return hash_equals($sessionToken, $token);
    }
}
