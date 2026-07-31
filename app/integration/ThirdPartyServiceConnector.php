<?php

declare(strict_types=1);

namespace App\Integration;

class ThirdPartyServiceConnector
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $connections = [];

    public function connect(
        string $service,
        array $credentials
    ): void {

        $this->connections[$service] = [
            'credentials' => $credentials,
            'connected_at' => date('c'),
            'status' => 'active',
        ];
    }

    public function disconnect(
        string $service
    ): void {

        unset(
            $this->connections[$service]
        );
    }

    public function connected(
        string $service
    ): bool {

        return isset(
            $this->connections[$service]
        );
    }

    public function all(): array
    {
        return $this->connections;
    }
}
