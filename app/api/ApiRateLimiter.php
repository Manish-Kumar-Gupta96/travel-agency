<?php

declare(strict_types=1);

namespace App\Api;

class ApiRateLimiter
{
    /**
     * @var array<string,array<int>>
     */
    private array $requests = [];

    public function allow(
        string $identifier,
        int $limit = 60,
        int $window = 60
    ): bool {

        $now = time();

        $this->requests[$identifier] =
            array_filter(
                $this->requests[$identifier] ?? [],
                fn ($time) =>
                    $time > ($now - $window)
            );

        if (
            count($this->requests[$identifier])
            >= $limit
        ) {
            return false;
        }

        $this->requests[$identifier][] = $now;

        return true;
    }

    public function reset(
        string $identifier
    ): void {

        unset(
            $this->requests[$identifier]
        );
    }
}
