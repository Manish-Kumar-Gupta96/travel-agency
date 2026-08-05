<?php

namespace App\Auth;

use App\Core\Security\JWT;

class TokenManager
{
    public function generate(array $payload): string
    {
        return JWT::generate($payload);
    }

    public function decode(string $token): object
    {
        return JWT::decode($token);
    }
}
