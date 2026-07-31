<?php

declare(strict_types=1);

namespace App\Queue;

class TaskSchedulerSystem
{
    /**
     * @var array<int,array<string,mixed>>
     */
    private array $tasks = [];

    public function schedule(
        string $name,
        int $timestamp,
        callable $task
    ): void {

        $this->tasks[] = [
            'name' => $name,
            'time' => $timestamp,
            'task' => $task,
        ];
    }

    public function runDue(): array
    {
        $executed = [];
        $now = time();

        foreach ($this->tasks as $task) {

            if ($task['time'] <= $now) {

                $executed[$task['name']] =
                    call_user_func(
                        $task['task']
                    );
            }
        }

        return $executed;
    }

    public function all(): array
    {
        return $this->tasks;
    }
}
