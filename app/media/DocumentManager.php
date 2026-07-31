<?php

declare(strict_types=1);

namespace App\Media;

class DocumentManager
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $documents = [];

    public function create(
        string $id,
        string $content,
        array $metadata = []
    ): void {

        $this->documents[$id] = [
            'content' => $content,
            'metadata' => $metadata,
            'created_at' => date('c'),
        ];
    }

    public function get(
        string $id
    ): ?array {

        return $this->documents[$id] ?? null;
    }

    public function update(
        string $id,
        string $content
    ): void {

        if (isset($this->documents[$id])) {

            $this->documents[$id]['content'] = $content;
            $this->documents[$id]['updated_at'] = date('c');
        }
    }

    public function all(): array
    {
        return $this->documents;
    }
}
