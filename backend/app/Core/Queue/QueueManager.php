<?php

declare(strict_types=1);

namespace App\Core\Queue;

use InvalidArgumentException;

class QueueManager
{
    protected array $drivers = [];
    protected string $default = 'database';

    public function __construct(
        array $config = []
    ) {
        $this->default = $config['default'] ?? 'database';
        $this->registerDrivers($config);
    }

    /**
     * Register Queue Drivers
     */
    protected function registerDrivers(
        array $config
    ): void {
        $drivers = $config['drivers'] ?? [];

        foreach ($drivers as $name => $driver) {
            $this->drivers[$name] = $driver;
        }
    }

    /**
     * Add Queue Driver
     */
    public function add(
        string $name,
        Queue $queue
    ): static {
        $this->drivers[$name] = $queue;
        return $this;
    }

    /**
     * Get Queue Driver
     */
    public function driver(
        ?string $name = null
    ): Queue
    {
        $name = $name ?? $this->default;

        if (!isset($this->drivers[$name])) {
            throw new InvalidArgumentException(
                "Queue driver {$name} not found"
            );
        }

        return $this->drivers[$name];
    }

    /**
     * Set Default Queue
     */
    public function setDefault(
        string $name
    ): void
    {
        $this->default = $name;
    }

    /**
     * Get Default Queue
     */
    public function getDefault(): string
    {
        return $this->default;
    }

    /**
     * Dispatch Job
     */
    public function push(
        Job $job
    ): string {
        return $this->driver()->push($job);
    }

    /**
     * Get Next Job
     */
    public function pop(
        string $queue = 'default'
    ): ?Job
    {

        return $this->driver()

            ->pop(

                $queue

            );

    }





    /**
     * Delete Job
     */
    public function delete(
        string $id
    ): bool
    {

        return $this->driver()

            ->delete(

                $id

            );

    }





    /**
     * Release Job
     */
    public function release(
        Job $job,
        int $delay = 0
    ): bool
    {

        return $this->driver()

            ->release(

                $job,

                $delay

            );

    }





    /**
     * Mark Failed Job
     */
    public function failed(
        Job $job,
        \Throwable $exception
    ): bool
    {

        return $this->driver()

            ->failed(

                $job,

                $exception

            );

    }





    /**
     * Queue Size
     */
    public function size(
        string $queue = 'default'
    ): int
    {

        return $this->driver()

            ->size(

                $queue

            );

    }





    /**
     * Clear Queue
     */
    public function clear(
        string $queue = 'default'
    ): bool
    {

        return $this->driver()

            ->clear(

                $queue

            );

    }





    /**
     * Driver List
     */
    public function drivers(): array
    {

        return array_keys(

            $this->drivers

        );

    }





    /**
     * Check Driver
     */
    public function hasDriver(
        string $name
    ): bool
    {

        return isset(

            $this->drivers[$name]

        );

    }





    /**
     * Remove Driver
     */
    public function removeDriver(
        string $name
    ): void
    {

        unset(

            $this->drivers[$name]

        );

    }





    /**
     * Magic Queue Access
     */
    public function __call(
        string $method,
        array $arguments
    ): mixed
    {

        return $this->driver()

            ->$method(

                ...$arguments

            );

    }


}
