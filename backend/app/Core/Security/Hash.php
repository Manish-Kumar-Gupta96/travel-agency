<?php

declare(strict_types=1);

namespace App\Core\Security;

class Hash
{
    public static function make(
        string $password
    ): string {
        return password_hash(
            $password,
            PASSWORD_DEFAULT
        );
    }

    public static function verify(
        string $password,
        string $hash
    ): bool {
        return password_verify(
            $password,
            $hash
        );
    }

    public static function needsRehash(
        string $hash
    ): bool {
        return password_needs_rehash(
            $hash,
            PASSWORD_DEFAULT
        );
    }
}
