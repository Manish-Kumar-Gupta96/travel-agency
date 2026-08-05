<?php

declare(strict_types=1);

namespace App\Core\Security;

class Permission
{
    public static function check(array $user, string $permission): bool
    {
        $permissions = $user['permissions'] ?? [];
        return in_array($permission, $permissions, true);
    }
}
