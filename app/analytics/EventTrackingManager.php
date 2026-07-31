<?php

declare(strict_types=1);

namespace App\Analytics;

class EventTrackingManager
{
    /**
     * @var array<string,array<int,array<string,mixed>>>
     */
    private array $tracked = [];

    public function track(
        string $category,
        string $event,
        array $payload = []
    ): void {

        $this->tracked[$category][] = [
            'event' => $event,
            'payload' => $payload,
            'time' => date('c'),
        ];
    }

    public function category(
        string $category
    ): array {

        return $this->tracked[$category] ?? [];
    }

    public function all(): array
    {
        return $this->tracked;
    }
}
