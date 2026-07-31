<?php

declare(strict_types=1);

namespace App\GraphQL;

class GraphqlGateway
{
    /**
     * @var array<string,callable>
     */
    private array $queries = [];

    /**
     * @var array<string,callable>
     */
    private array $mutations = [];

    public function registerQuery(
        string $name,
        callable $resolver
    ): void {

        $this->queries[$name] = $resolver;
    }

    public function registerMutation(
        string $name,
        callable $resolver
    ): void {

        $this->mutations[$name] = $resolver;
    }

    public function execute(
        string $type,
        string $name,
        array $arguments = []
    ): mixed {

        $resolver = match ($type) {
            'query' => $this->queries[$name] ?? null,
            'mutation' => $this->mutations[$name] ?? null,
            default => null,
        };

        if ($resolver === null) {
            return null;
        }

        return call_user_func(
            $resolver,
            $arguments
        );
    }

    public function schema(): array
    {
        return [
            'queries' => array_keys($this->queries),
            'mutations' => array_keys($this->mutations),
        ];
    }
}
