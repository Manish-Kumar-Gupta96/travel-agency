<?php

declare(strict_types=1);

namespace App\Notification;

class NotificationDeliveryTracker
{
    /**
     * @var array<int,array<string,mixed>>
     */
    private array $deliveries = [];

    public function record(
        string $channel,
        string $recipient,
        string $status
    ): void {

        $this->deliveries[] = [
            'channel' => $channel,
            'recipient' => $recipient,
            'status' => $status,
            'time' => date('c'),
        ];
    }

    public function all(): array
    {
        return $this->deliveries;
    }

    public function failed(): array
    {
        return array_values(
            array_filter(
                $this->deliveries,
                fn ($item) =>
                    $item['status'] === 'failed'
            )
        );
    }
}
