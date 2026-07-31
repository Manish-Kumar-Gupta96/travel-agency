<?php

declare(strict_types=1);

namespace App\Realtime;

class EventBroadcaster
{
    /**
     * @var array<string,array<int,callable>>
     */
    private array $listeners = [];

    public function listen(
        string $event,
        callable $callback
    ): void {

        $this->listeners[$event][] = $callback;
    }

    public function broadcast(
        string $event,
        mixed $payload = null
    ): void {

        foreach (
            $this->listeners[$event] ?? []
            as $listener
        ) {
            $listener($payload);
        }
    }

    public function events(): array
    {
        return array_keys(
            $this->listeners
        );
    }
}
