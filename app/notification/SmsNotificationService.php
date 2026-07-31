<?php

declare(strict_types=1);

namespace App\Notification;

class SmsNotificationService
{
    /**
     * @var array<int,array<string,mixed>>
     */
    private array $messages = [];

    public function send(
        string $number,
        string $message
    ): bool {

        $this->messages[] = [
            'number' => $number,
            'message' => $message,
            'sent_at' => date('c'),
        ];

        return true;
    }

    public function history(): array
    {
        return $this->messages;
    }

    public function clear(): void
    {
        $this->messages = [];
    }
}
