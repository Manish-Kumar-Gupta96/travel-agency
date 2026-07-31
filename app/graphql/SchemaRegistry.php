<?php

declare(strict_types=1);

namespace App\GraphQL;

class SchemaRegistry
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $types = [];

    public function registerType(
        string $name,
        array $definition
    ): void {

        $this->types[$name] = $definition;
    }

    public function getType(
        string $name
    ): ?array {

        return $this->types[$name] ?? null;
    }

    public function has(
        string $name
    ): bool {

        return isset(
            $this->types[$name]
        );
    }

    public function all(): array
    {
        return $this->types;
    }
}
