<?php

declare(strict_types=1);

namespace App\Media;

class FileVersionManager
{
    /**
     * @var array<string,array<int,array<string,mixed>>>
     */
    private array $versions = [];

    public function createVersion(
        string $file,
        string $content
    ): int {

        $version = count(
            $this->versions[$file] ?? []
        ) + 1;

        $this->versions[$file][] = [
            'version' => $version,
            'content' => $content,
            'created_at' => date('c'),
        ];

        return $version;
    }

    public function latest(
        string $file
    ): ?array {

        $items = $this->versions[$file] ?? [];

        return end($items) ?: null;
    }

    public function history(
        string $file
    ): array {

        return $this->versions[$file] ?? [];
    }

    public function rollback(
        string $file,
        int $version
    ): ?array {

        foreach (
            $this->versions[$file] ?? []
            as $item
        ) {
            if ($item['version'] === $version) {
                return $item;
            }
        }

        return null;
    }
}
