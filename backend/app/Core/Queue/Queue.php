<?php

declare(strict_types=1);

namespace App\Core\Queue;

interface Queue
{
    /**
     * Push Job Into Queue
     */
    public function push(
        Job $job
    ): string;

    /**
     * Get Next Job
     */
    public function pop(
        string $queue = 'default'
    ): ?Job;

    /**
     * Delete Completed Job
     */
    public function delete(
        string $id
    ): bool;

    /**
     * Release Job Back
     */
    public function release(
        Job $job,
        int $delay = 0
    ): bool;

    /**
     * Failed Job
     */
    public function failed(
        Job $job,
        \Throwable $exception
    ): bool;

    /**
     * Get Queue Size
     */
    public function size(
        string $queue = 'default'
    ): int;

    /**
     * Clear Queue
     */
    public function clear(
        string $queue = 'default'
    ): bool;
}
