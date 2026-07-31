<?php

declare(strict_types=1);

namespace App\Api;

class ApiAuthGuard
{
    /**
     * @var array<string,string>
     */
    private array $tokens = [];

    public function register(
        string $token,
        string $userId
    ): void {

        $this->tokens[$token] = $userId;
    }

    public function authenticate(
        string $token
    ): ?string {

        return $this->tokens[$token] ?? null;
    }

    public function check(
        string $token
    ): bool {

        return isset(
            $this->tokens[$token]
        );
    }

    public function revoke(
        string $token
    ): void {

        unset(
            $this->tokens[$token]
        );
    }
}
