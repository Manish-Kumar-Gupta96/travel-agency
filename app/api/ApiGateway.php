<?php

declare(strict_types=1);

namespace App\Api;

class ApiGateway
{
    /**
     * @var array<string,callable>
     */
    private array $routes = [];

    public function register(
        string $method,
        string $path,
        callable $handler
    ): void {

        $key = strtoupper($method) . ':' . $path;

        $this->routes[$key] = $handler;
    }

    public function handle(
        string $method,
        string $path,
        array $payload = []
    ): mixed {

        $key = strtoupper($method) . ':' . $path;

        if (!isset($this->routes[$key])) {
            return null;
        }

        return call_user_func(
            $this->routes[$key],
            $payload
        );
    }

    public function routes(): array
    {
        return array_keys(
            $this->routes
        );
    }
}
