<?php

declare(strict_types=1);

namespace App\Analytics;

class DashboardWidgetEngine
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $widgets = [];

    public function register(
        string $name,
        array $configuration = []
    ): void {

        $this->widgets[$name] = [
            'config' => $configuration,
            'created_at' => date('c'),
        ];
    }

    public function get(
        string $name
    ): ?array {

        return $this->widgets[$name] ?? null;
    }

    public function remove(
        string $name
    ): void {

        unset(
            $this->widgets[$name]
        );
    }

    public function all(): array
    {
        return $this->widgets;
    }
}
