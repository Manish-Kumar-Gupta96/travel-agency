<?php

declare(strict_types=1);

namespace App\Queue;

class BackgroundJobManager
{
    /**
     * @var array<string,callable>
     */
    private array $jobs = [];

    public function register(
        string $name,
        callable $handler
    ): void {

        $this->jobs[$name] = $handler;
    }

    public function execute(
        string $name,
        mixed $data = null
    ): mixed {

        if (!isset($this->jobs[$name])) {
            return null;
        }

        return call_user_func(
            $this->jobs[$name],
            $data
        );
    }

    public function available(): array
    {
        return array_keys(
            $this->jobs
        );
    }
}
