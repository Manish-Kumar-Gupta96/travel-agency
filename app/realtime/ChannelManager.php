<?php

declare(strict_types=1);

namespace App\Realtime;

class ChannelManager
{
    /**
     * @var array<string,array<string>>
     */
    private array $channels = [];

    public function join(
        string $channel,
        string $user
    ): void {

        $this->channels[$channel] ??= [];

        if (!in_array(
            $user,
            $this->channels[$channel],
            true
        )) {
            $this->channels[$channel][] = $user;
        }
    }

    public function leave(
        string $channel,
        string $user
    ): void {

        if (!isset($this->channels[$channel])) {
            return;
        }

        $this->channels[$channel] = array_values(
            array_filter(
                $this->channels[$channel],
                fn ($item) => $item !== $user
            )
        );
    }

    public function members(
        string $channel
    ): array {

        return $this->channels[$channel] ?? [];
    }

    public function all(): array
    {
        return $this->channels;
    }
}
