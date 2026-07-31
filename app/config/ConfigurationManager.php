<?php

declare(strict_types=1);

namespace App\Config;

class ConfigurationManager
{
    /**
     * @var array<string,mixed>
     */
    private array $config = [];

    public function set(
        string $key,
        mixed $value
    ): void {

        $this->config[$key] = $value;
    }

    public function get(
        string $key,
        mixed $default = null
    ): mixed {

        return $this->config[$key] ?? $default;
    }

    public function has(
        string $key
    ): bool {

        return array_key_exists(
            $key,
            $this->config
        );
    }

    public function all(): array
    {
        return $this->config;
    }

    public function remove(
        string $key
    ): void {

        unset(
            $this->config[$key]
        );
    }
}
