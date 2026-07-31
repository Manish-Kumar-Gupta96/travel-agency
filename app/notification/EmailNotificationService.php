<?php

declare(strict_types=1);

namespace App\Notification;

class EmailNotificationService
{
    /**
     * @var array<int,array<string,mixed>>
     */
    private array $emails = [];

    public function send(
        string $email,
        string $subject,
        string $content
    ): bool {

        $this->emails[] = [
            'to' => $email,
            'subject' => $subject,
            'content' => $content,
            'sent_at' => date('c'),
        ];

        return true;
    }

    public function history(): array
    {
        return $this->emails;
    }

    public function count(): int
    {
        return count(
            $this->emails
        );
    }
}
