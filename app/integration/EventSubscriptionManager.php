<?php

declare(strict_types=1);

namespace App\Integration;

class EventSubscriptionManager
{
    /**
     * @var array<string,array<int,callable>>
     */
    private array $listeners = [];

    public function subscribe(
        string $event,
        callable $listener
    ): void {

        $this->listeners[$event][] = $listener;
    }

    public function dispatch(
        string $event,
        mixed $data = null
    ): array {

        $responses = [];

        foreach (
            $this->listeners[$event] ?? []
            as $listener
        ) {

            $responses[] =
                call_user_func(
                    $listener,
                    $data
                );
        }

        return $responses;
    }

    public function events(): array
    {
        return array_keys(
            $this->listeners
        );
    }
}
