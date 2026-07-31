<?php

declare(strict_types=1);

namespace App\Template;

class NotificationQueueManager
{
    /**
     * @var array<int,array<string,mixed>>
     */
    private array $queue = [];

    public function add(
        string $channel,
        string $recipient,
        array $payload
    ): void {

        $this->queue[] = [
            'channel' => $channel,
            'recipient' => $recipient,
            'payload' => $payload,
            'created_at' => date('c'),
        ];
    }

    public function next(): ?array
    {
        return array_shift(
            $this->queue
        );
    }

    public function size(): int
    {
        return count(
            $this->queue
        );
    }

    public function all(): array
    {
        return $this->queue;
    }
}
