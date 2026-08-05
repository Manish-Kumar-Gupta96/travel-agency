<?php

declare(strict_types=1);

namespace App\Core\Queue;

abstract class Job
{
    protected array $data = [];
    protected int $tries = 3;
    protected int $timeout = 60;
    protected string $queue = 'default';
    protected ?string $id = null;
    protected int $delay = 0;

    public function __construct(
        array $data = []
    ) {
        $this->data = $data;
    }

    /**
     * Execute Job
     */
    abstract public function handle(): void;

    /**
     * Failed Job Handler
     */
    public function failed(
        \Throwable $exception
    ): void {
    }

    /**
     * Get Job Data
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * Get Single Data
     */
    public function get(
        string $key,
        mixed $default = null
    ): mixed {
        return $this->data[$key] ?? $default;
    }

    /**
     * Set Data
     */
    public function set(
        string $key,
        mixed $value
    ): static {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * Attempts
     */
    public function tries(): int
    {
        return $this->tries;
    }

    /**
     * Timeout
     */
    public function timeout(): int
    {
        return $this->timeout;
    }

    /**
     * Set Attempts
     */
    public function setTries(
        int $tries
    ): static {
        $this->tries = $tries;
        return $this;
    }

    /**
     * Set Timeout
     */
    public function setTimeout(
        int $seconds
    ): static {
        $this->timeout = $seconds;
        return $this;
    }

    /**
     * Get Queue Name
     */
    public function queue(): string
    {
        return $this->queue;
    }

    /**
     * Set Queue Name
     */
    public function onQueue(
        string $queue
    ): static {
        $this->queue = $queue;
        return $this;
    }

    /**
     * Set Delay
     */
    public function delay(
        int $seconds
    ): static {
        $this->delay = $seconds;
        return $this;
    }

    /**
     * Get Delay
     */
    public function getDelay(): int
    {
        return $this->delay;
    }

    /**
     * Get Job ID
     */
    public function id(): string
    {
        if (!$this->id) {
            $this->id = bin2hex(
                random_bytes(16)
            );
        }

        return $this->id;
    }

    /**
     * Serialize Job
     */
    public function serialize(): string
    {
        return serialize($this);
    }

    /**
     * Restore Job
     */
    public static function restore(
        string $data
    ): static {
        return unserialize($data);
    }

    /**
     * Convert Job To Array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'queue' => $this->queue(),
            'data' => $this->data,
            'tries' => $this->tries,
            'timeout' => $this->timeout
        ];
    }
}
