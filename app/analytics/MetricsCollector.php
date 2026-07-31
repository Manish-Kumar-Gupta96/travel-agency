<?php

declare(strict_types=1);

namespace App\Analytics;

class MetricsCollector
{
    /**
     * @var array<string,array<int,float>>
     */
    private array $metrics = [];

    public function add(
        string $name,
        float $value
    ): void {

        $this->metrics[$name][] = $value;
    }

    public function average(
        string $name
    ): float {

        $values = $this->metrics[$name] ?? [];

        if (empty($values)) {
            return 0;
        }

        return array_sum($values)
            /
            count($values);
    }

    public function total(
        string $name
    ): float {

        return array_sum(
            $this->metrics[$name] ?? []
        );
    }

    public function all(): array
    {
        return $this->metrics;
    }
}
