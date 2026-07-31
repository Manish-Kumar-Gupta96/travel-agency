<?php

declare(strict_types=1);

namespace App\Realtime;

class PresenceTracker
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $users = [];

    public function online(
        string $user,
        array $metadata = []
    ): void {

        $this->users[$user] = [
            'status' => 'online',
            'metadata' => $metadata,
            'last_seen' => time(),
        ];
    }

    public function offline(
        string $user
    ): void {

        if (isset($this->users[$user])) {
            $this->users[$user]['status'] = 'offline';
            $this->users[$user]['last_seen'] = time();
        }
    }

    public function isOnline(
        string $user
    ): bool {

        return (
            $this->users[$user]['status'] ?? null
        ) === 'online';
    }

    public function all(): array
    {
        return $this->users;
    }
}
