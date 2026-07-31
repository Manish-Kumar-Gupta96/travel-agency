<?php

declare(strict_types=1);

namespace App\Storage;

class FileStorageManager
{
    public function __construct(
        private readonly string $basePath
    ) {
        if (!is_dir($this->basePath)) {
            mkdir(
                $this->basePath,
                0755,
                true
            );
        }
    }

    public function put(
        string $path,
        string $content
    ): bool {

        $file = $this->basePath . '/' . ltrim($path, '/');

        $directory = dirname($file);

        if (!is_dir($directory)) {
            mkdir(
                $directory,
                0755,
                true
            );
        }

        return file_put_contents(
            $file,
            $content,
            LOCK_EX
        ) !== false;
    }

    public function get(
        string $path
    ): ?string {

        $file = $this->basePath . '/' . ltrim($path, '/');

        if (!is_file($file)) {
            return null;
        }

        return file_get_contents($file);
    }

    public function exists(
        string $path
    ): bool {

        return is_file(
            $this->basePath . '/' . ltrim($path, '/')
        );
    }

    public function delete(
        string $path
    ): bool {

        $file = $this->basePath . '/' . ltrim($path, '/');

        return is_file($file)
            && unlink($file);
    }
}
