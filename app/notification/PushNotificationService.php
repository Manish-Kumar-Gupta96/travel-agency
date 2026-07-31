<?php

declare(strict_types=1);

namespace App\Notification;

class PushNotificationService
{
    /**
     * @var array<int,array<string,mixed>>
     */
    private array $notifications = [];

    public function send(
        string $device,
        array $payload
    ): bool {

        $this->notifications[] = [
            'device' => $device,
            'payload' => $payload,
            'sent_at' => date('c'),
        ];

        return true;
    }

    public function all(): array
    {
        return $this->notifications;
    }

    public function count(): int
    {
        return count(
            $this->notifications
        );
    }
}
