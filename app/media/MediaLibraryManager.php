<?php

declare(strict_types=1);

namespace App\Media;

class MediaLibraryManager
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $media = [];

    public function add(
        string $id,
        array $metadata = []
    ): void {

        $this->media[$id] = array_merge(
            [
                'id' => $id,
                'created_at' => date('c'),
            ],
            $metadata
        );
    }

    public function get(
        string $id
    ): ?array {

        return $this->media[$id] ?? null;
    }

    public function remove(
        string $id
    ): void {

        unset(
            $this->media[$id]
        );
    }

    public function all(): array
    {
        return $this->media;
    }
}
