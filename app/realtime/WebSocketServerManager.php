<?php

declare(strict_types=1);

namespace App\Realtime;

class WebSocketServerManager
{
    /**
     * @var array<string,resource|object>
     */
    private array $connections = [];

    public function connect(
        string $id,
        mixed $connection
    ): void {

        $this->connections[$id] = $connection;
    }

    public function disconnect(
        string $id
    ): void {

        unset(
            $this->connections[$id]
        );
    }

    public function send(
        string $id,
        mixed $message
    ): bool {

        if (!isset($this->connections[$id])) {
            return false;
        }

        $connection = $this->connections[$id];

        if (method_exists($connection, 'send')) {
            $connection->send($message);
        }

        return true;
    }

    public function count(): int
    {
        return count(
            $this->connections
        );
    }

    public function all(): array
    {
        return $this->connections;
    }
}
