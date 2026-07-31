<?php

declare(strict_types=1);

namespace App\Config;

class RuntimeConfigurationEngine
{
    /**
     * @var array<string,mixed>
     */
    private array $runtime = [];

    public function update(
        string $key,
        mixed $value
    ): void {

        $this->runtime[$key] = $value;
    }

    public function read(
        string $key,
        mixed $default = null
    ): mixed {

        return $this->runtime[$key]
            ?? $default;
    }

    public function reset(): void
    {
        $this->runtime = [];
    }

    public function all(): array
    {
        return $this->runtime;
    }
}
