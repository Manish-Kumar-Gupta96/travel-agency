<?php

declare(strict_types=1);

namespace App\Api;

class ApiVersionManager
{
    private string $default = 'v1';

    /**
     * @var array<string,array<string,mixed>>
     */
    private array $versions = [];

    public function register(
        string $version,
        array $config = []
    ): void {

        $this->versions[$version] = $config;
    }

    public function exists(
        string $version
    ): bool {

        return isset(
            $this->versions[$version]
        );
    }

    public function setDefault(
        string $version
    ): void {

        $this->default = $version;
    }

    public function current(): string
    {
        return $this->default;
    }

    public function all(): array
    {
        return $this->versions;
    }
}
