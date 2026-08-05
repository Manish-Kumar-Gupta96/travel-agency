<?php

declare(strict_types=1);

namespace App\Core\Events;

use InvalidArgumentException;

class EventDispatcher
{
    protected array $listeners = [];

    /**
     * Register Listener
     */
    public function listen(
        string $event,
        Listener $listener
    ): static {
        $this->listeners[$event][] = $listener;
        return $this;
    }

    /**
     * Remove Listener
     */
    public function remove(
        string $event,
        Listener $listener
    ): static {
        if (!isset($this->listeners[$event])) {
            return $this;
        }

        foreach ($this->listeners[$event] as $key => $item) {
            if ($item === $listener) {
                unset($this->listeners[$event][$key]);
            }
        }

        return $this;
    }

    /**
     * Dispatch Event
     */
    public function dispatch(
        Event $event
    ): void {
        $name = $event::class;

        if (!isset($this->listeners[$name])) {
            return;
        }

        $listeners = $this->listeners[$name];

        usort(
            $listeners,
            function (
                Listener $a,
                Listener $b
            ) {
                return $b->priority() <=> $a->priority();
            }
        );

        foreach ($listeners as $listener) {
            $listener->handle($event);
        }
    }

    /**
     * Register Multiple Listeners
     */
    public function subscribe(
        string $event,
        array $listeners
    ): static {
        foreach ($listeners as $listener) {
            if ($listener instanceof Listener) {
                $this->listen($event, $listener);
            }
        }

        return $this;
    }

    /**
     * Check Event Has Listeners
     */
    public function hasListeners(
        string $event
    ): bool {
        return !empty($this->listeners[$event]);
    }

    /**
     * Get Event Listeners
     */
    public function listeners(
        string $event
    ): array {
        return $this->listeners[$event] ?? [];
    }

    /**
     * Get All Registered Events
     */
    public function events(): array
    {
        return array_keys($this->listeners);
    }

    /**
     * Clear Event Listeners
     */
    public function clear(
        ?string $event = null
    ): static {
        if ($event) {
            unset($this->listeners[$event]);
        } else {
            $this->listeners = [];
        }

        return $this;
    }

    /**
     * Count Listeners
     */
    public function count(
        string $event
    ): int {
        return count($this->listeners[$event] ?? []);
    }

    /**
     * Dispatch With Result
     */
    public function dispatchWithResult(
        Event $event
    ): array {
        $results = [];
        $name = $event::class;

        if (!isset($this->listeners[$name])) {
            return $results;
        }

        foreach ($this->listeners[$name] as $listener) {
            $results[] = $listener->handle($event);
        }

        return $results;
    }

    /**
     * Check Wildcard Listener
     */
    public function wildcard(
        string $pattern,
        Listener $listener
    ): static {
        $this->listeners['*'][$pattern][] = $listener;
        return $this;
    }

    /**
     * Dispatch Wildcard Events
     */
    protected function dispatchWildcard(
        Event $event
    ): void {
        if (!isset($this->listeners['*'])) {
            return;
        }

        foreach ($this->listeners['*'] as $pattern => $listeners) {
            if (
                fnmatch(
                    $pattern,
                    $event::class
                )
            ) {
                foreach ($listeners as $listener) {
                    $listener->handle($event);
                }
            }
        }
    }

    /**
     * Dispatch All
     */
    public function fire(
        Event $event
    ): void {
        $this->dispatch($event);
        $this->dispatchWildcard($event);
    }

    /**
     * Get All Listeners
     */
    public function all(): array
    {
        return $this->listeners;
    }
}
