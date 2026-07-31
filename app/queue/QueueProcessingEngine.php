<?php

declare(strict_types=1);

namespace App\Queue;

class QueueProcessingEngine
{
    /**
     * @var array<int,array<string,mixed>>
     */
    private array $queue = [];

    public function push(
        string $job,
        array $payload = []
    ): void {

        $this->queue[] = [
            'job' => $job,
            'payload' => $payload,
            'created_at' => date('c'),
        ];
    }

    public function pop(): ?array
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
