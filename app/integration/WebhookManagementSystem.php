<?php

declare(strict_types=1);

namespace App\Integration;

class WebhookManagementSystem
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $webhooks = [];

    public function register(
        string $name,
        string $url,
        array $events = []
    ): void {

        $this->webhooks[$name] = [
            'url' => $url,
            'events' => $events,
            'created_at' => date('c'),
        ];
    }

    public function trigger(
        string $event,
        array $payload = []
    ): array {

        $sent = [];

        foreach ($this->webhooks as $name => $hook) {

            if (
                in_array(
                    $event,
                    $hook['events'],
                    true
                )
            ) {

                $sent[$name] = [
                    'url' => $hook['url'],
                    'payload' => $payload,
                ];
            }
        }

        return $sent;
    }

    public function all(): array
    {
        return $this->webhooks;
    }

    public function remove(
        string $name
    ): void {

        unset(
            $this->webhooks[$name]
        );
    }
}
