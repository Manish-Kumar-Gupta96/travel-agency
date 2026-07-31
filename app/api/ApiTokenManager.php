<?php

declare(strict_types=1);

namespace App\Api;

class ApiTokenManager
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $tokens = [];

    public function create(
        string $userId,
        array $abilities = []
    ): string {

        $token = bin2hex(
            random_bytes(32)
        );

        $this->tokens[$token] = [
            'user' => $userId,
            'abilities' => $abilities,
            'created_at' => date('c'),
        ];

        return $token;
    }

    public function find(
        string $token
    ): ?array {

        return $this->tokens[$token] ?? null;
    }

    public function can(
        string $token,
        string $ability
    ): bool {

        return in_array(
            $ability,
            $this->tokens[$token]['abilities'] ?? [],
            true
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
