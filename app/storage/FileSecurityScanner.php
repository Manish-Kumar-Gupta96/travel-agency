<?php

declare(strict_types=1);

namespace App\Storage;

class FileSecurityScanner
{
    /**
     * @var string[]
     */
    private array $blockedExtensions = [
        'php',
        'exe',
        'sh',
        'bat',
    ];

    public function scan(
        string $filename
    ): bool {

        $extension = strtolower(
            pathinfo(
                $filename,
                PATHINFO_EXTENSION
            )
        );

        return !in_array(
            $extension,
            $this->blockedExtensions,
            true
        );
    }

    public function safeName(
        string $filename
    ): string {

        return preg_replace(
            '/[^a-zA-Z0-9\._-]/',
            '',
            $filename
        );
    }
}
