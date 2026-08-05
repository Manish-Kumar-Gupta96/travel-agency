<?php

declare(strict_types=1);

namespace App\Core\Events;

interface Listener
{
    /**
     * Handle Event
     */
    public function handle(
        Event $event
    ): void;

    /**
     * Listener Priority
     */
    public function priority(): int;
}
