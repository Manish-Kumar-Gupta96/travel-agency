<?php

declare(strict_types=1);

namespace App\Analytics;

class KpiTrackingSystem
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $kpis = [];

    public function define(
        string $name,
        float $target
    ): void {

        $this->kpis[$name] = [
            'target' => $target,
            'value' => 0,
            'updated_at' => date('c'),
        ];
    }

    public function update(
        string $name,
        float $value
    ): void {

        if (!isset($this->kpis[$name])) {
            return;
        }

        $this->kpis[$name]['value'] = $value;
        $this->kpis[$name]['updated_at'] = date('c');
    }

    public function progress(
        string $name
    ): float {

        if (!isset($this->kpis[$name])) {
            return 0;
        }

        $kpi = $this->kpis[$name];

        if ($kpi['target'] <= 0) {
            return 0;
        }

        return (
            $kpi['value'] /
            $kpi['target']
        ) * 100;
    }

    public function all(): array
    {
        return $this->kpis;
    }
}
