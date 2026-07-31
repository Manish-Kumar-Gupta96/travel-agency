<?php

declare(strict_types=1);

namespace App\Config;

class FeatureFlagSystem
{
    /**
     * @var array<string,bool>
     */
    private array $flags = [];

    public function enable(
        string $feature
    ): void {

        $this->flags[$feature] = true;
    }

    public function disable(
        string $feature
    ): void {

        $this->flags[$feature] = false;
    }

    public function active(
        string $feature
    ): bool {

        return $this->flags[$feature]
            ?? false;
    }

    public function all(): array
    {
        return $this->flags;
    }
}
