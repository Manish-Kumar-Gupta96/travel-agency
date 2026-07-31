<?php

declare(strict_types=1);

namespace App\Analytics;

class AnalyticsEngine
{
    /**
     * @var array<int,array<string,mixed>>
     */
    private array $events = [];

    public function record(
        string $event,
        array $data = []
    ): void {

        $this->events[] = [
            'event' => $event,
            'data' => $data,
            'created_at' => date('c'),
        ];
    }

    public function events(
        ?string $name = null
    ): array {

        if ($name === null) {
            return $this->events;
        }

        return array_values(
            array_filter(
                $this->events,
                fn ($event) =>
                    $event['event'] === $name
            )
        );
    }

    public function count(): int
    {
        return count(
            $this->events
        );
    }
}
