<?php

declare(strict_types=1);

namespace App\Notification;

class NotificationManager
{
    /**
     * @var array<string,callable>
     */
    private array $channels = [];

    public function registerChannel(
        string $name,
        callable $handler
    ): void {

        $this->channels[$name] = $handler;
    }

    public function send(
        string $channel,
        mixed $recipient,
        array $message = []
    ): mixed {

        if (!isset($this->channels[$channel])) {
            return null;
        }

        return call_user_func(
            $this->channels[$channel],
            $recipient,
            $message
        );
    }

    public function availableChannels(): array
    {
        return array_keys(
            $this->channels
        );
    }
}
