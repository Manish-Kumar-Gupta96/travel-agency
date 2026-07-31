<?php

declare(strict_types=1);

namespace App\Analytics;

class DataVisualizationManager
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $charts = [];

    public function create(
        string $name,
        string $type,
        array $data
    ): void {

        $this->charts[$name] = [
            'type' => $type,
            'data' => $data,
            'created_at' => date('c'),
        ];
    }

    public function render(
        string $name
    ): ?array {

        return $this->charts[$name] ?? null;
    }

    public function types(): array
    {
        return array_map(
            fn ($chart) => $chart['type'],
            $this->charts
        );
    }

    public function all(): array
    {
        return $this->charts;
    }
}
