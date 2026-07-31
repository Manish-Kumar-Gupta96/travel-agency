<?php

declare(strict_types=1);

namespace App\Config;

class EnvironmentVariableManager
{
    /**
     * @var array<string,string>
     */
    private array $variables = [];

    public function set(
        string $name,
        string $value
    ): void {

        $this->variables[$name] = $value;
    }

    public function get(
        string $name,
        ?string $default = null
    ): ?string {

        return $this->variables[$name]
            ?? $default;
    }

    public function exists(
        string $name
    ): bool {

        return isset(
            $this->variables[$name]
        );
    }

    public function all(): array
    {
        return $this->variables;
    }
}
