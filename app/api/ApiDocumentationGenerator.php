<?php

declare(strict_types=1);

namespace App\Api;

class ApiDocumentationGenerator
{
    /**
     * @var array<int,array<string,mixed>>
     */
    private array $endpoints = [];

    public function addEndpoint(
        string $method,
        string $path,
        string $description
    ): void {

        $this->endpoints[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'description' => $description,
        ];
    }

    public function generate(): array
    {
        return [
            'generated_at' => date('c'),
            'endpoints' => $this->endpoints,
        ];
    }

    public function json(): string
    {
        return json_encode(
            $this->generate(),
            JSON_PRETTY_PRINT |
            JSON_UNESCAPED_SLASHES
        );
    }
}
