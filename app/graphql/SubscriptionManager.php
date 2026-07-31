<?php

declare(strict_types=1);

namespace App\GraphQL;

class SubscriptionManager
{
    /**
     * @var array<string,array<int,callable>>
     */
    private array $subscriptions = [];

    public function subscribe(
        string $event,
        callable $listener
    ): void {

        $this->subscriptions[$event][] = $listener;
    }

    public function publish(
        string $event,
        mixed $payload = null
    ): void {

        foreach (
            $this->subscriptions[$event] ?? []
            as $listener
        ) {
            $listener($payload);
        }
    }

    public function subscribers(
        string $event
    ): int {

        return count(
            $this->subscriptions[$event] ?? []
        );
    }

    public function clear(): void
    {
        $this->subscriptions = [];
    }
}
