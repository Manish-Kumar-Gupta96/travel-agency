<?php

declare(strict_types=1);

namespace App\Storage;

class CloudStorageAdapter
{
    /**
     * @var array<string,string>
     */
    private array $files = [];

    public function upload(
        string $path,
        string $content
    ): string {

        $this->files[$path] = $content;

        return $path;
    }

    public function download(
        string $path
    ): ?string {

        return $this->files[$path] ?? null;
    }

    public function exists(
        string $path
    ): bool {

        return isset(
            $this->files[$path]
        );
    }

    public function delete(
        string $path
    ): void {

        unset(
            $this->files[$path]
        );
    }

    public function all(): array
    {
        return array_keys(
            $this->files
        );
    }
}
