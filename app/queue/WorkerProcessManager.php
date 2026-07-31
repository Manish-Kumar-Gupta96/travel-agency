<?php

declare(strict_types=1);

namespace App\Queue;

class WorkerProcessManager
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $workers = [];

    public function register(
        string $name,
        array $configuration = []
    ): void {

        $this->workers[$name] = [
            'config' => $configuration,
            'status' => 'idle',
            'created_at' => date('c'),
        ];
    }

    public function start(
        string $name
    ): void {

        if (isset($this->workers[$name])) {

            $this->workers[$name]['status'] =
                'running';
        }
    }

    public function stop(
        string $name
    ): void {

        if (isset($this->workers[$name])) {

            $this->workers[$name]['status'] =
                'stopped';
        }
    }

    public function all(): array
    {
        return $this->workers;
    }
}
