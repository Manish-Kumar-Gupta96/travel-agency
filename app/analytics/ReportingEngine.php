<?php

declare(strict_types=1);

namespace App\Analytics;

class ReportingEngine
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $reports = [];

    public function create(
        string $name,
        array $data
    ): void {

        $this->reports[$name] = [
            'data' => $data,
            'generated_at' => date('c'),
        ];
    }

    public function get(
        string $name
    ): ?array {

        return $this->reports[$name] ?? null;
    }

    public function all(): array
    {
        return $this->reports;
    }

    public function remove(
        string $name
    ): void {

        unset(
            $this->reports[$name]
        );
    }
}
