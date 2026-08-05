<?php

namespace App\Authorization;

class Gate
{
    public function allows(string $permission, array $user): bool
    {
        return \App\Core\Security\Permission::check($user, $permission);
    }
}
