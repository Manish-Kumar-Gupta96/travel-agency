<?php

declare(strict_types=1);

namespace App\Core\Events;

abstract class Event
{
    protected array $data = [];
    protected string $name;

    public function __construct(
        array $data = []
    ) {
        $this->data = $data;
        $this->name = static::class;
    }

    /**
     * Get Event Data
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * Get Event Name
     */
    public function name(): string
    {
        return $this->name;
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
     * Check Data Exists
     */
    public function has(
        string $key
    ): bool {
        return array_key_exists($key, $this->data);
    }

    /**
     * Convert Array
     */
    public function toArray(): array
    {
        return [
            'event' => $this->name,
            'data' => $this->data
        ];
    }
}
