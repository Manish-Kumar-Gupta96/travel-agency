<?php

declare(strict_types=1);

namespace App\Notification;

class NotificationPreferenceManager
{
    /**
     * @var array<string,array<string,bool>>
     */
    private array $preferences = [];

    public function set(
        string $user,
        string $channel,
        bool $enabled
    ): void {

        $this->preferences[$user][$channel] = $enabled;
    }

    public function enabled(
        string $user,
        string $channel
    ): bool {

        return $this->preferences[$user][$channel]
            ?? true;
    }

    public function user(
        string $user
    ): array {

        return $this->preferences[$user] ?? [];
    }

    public function all(): array
    {
        return $this->preferences;
    }
}
