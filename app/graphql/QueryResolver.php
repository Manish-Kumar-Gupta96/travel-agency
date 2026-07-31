<?php

declare(strict_types=1);

namespace App\GraphQL;

class QueryResolver
{
    /**
     * @var array<string,callable>
     */
    private array $resolvers = [];

    public function register(
        string $field,
        callable $resolver
    ): void {

        $this->resolvers[$field] = $resolver;
    }

    public function resolve(
        string $field,
        array $arguments = []
    ): mixed {

        if (!isset($this->resolvers[$field])) {
            return null;
        }

        return call_user_func(
            $this->resolvers[$field],
            $arguments
        );
    }

    public function exists(
        string $field
    ): bool {

        return isset(
            $this->resolvers[$field]
        );
    }

    public function all(): array
    {
        return array_keys(
            $this->resolvers
        );
    }
}
