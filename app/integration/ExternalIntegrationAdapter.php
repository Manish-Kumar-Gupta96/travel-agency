<?php

declare(strict_types=1);

namespace App\Integration;

class ExternalIntegrationAdapter
{
    /**
     * @var array<string,callable>
     */
    private array $adapters = [];

    public function register(
        string $service,
        callable $adapter
    ): void {

        $this->adapters[$service] = $adapter;
    }

    public function execute(
        string $service,
        mixed $data = null
    ): mixed {

        if (!isset($this->adapters[$service])) {
            return null;
        }

        return call_user_func(
            $this->adapters[$service],
            $data
        );
    }

    public function services(): array
    {
        return array_keys(
            $this->adapters
        );
    }
}
