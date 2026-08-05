<?php

namespace App\Auth;

class PasswordHasher
{
    public function make(string $password): string
    {
        return \App\Core\Security\Hash::make($password);
    }

    public function check(string $password, string $hash): bool
    {
        return \App\Core\Security\Hash::verify($password, $hash);
    }
}
