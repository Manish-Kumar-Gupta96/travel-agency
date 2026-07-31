<?php

declare(strict_types=1);

namespace App\Storage;

class UploadManager
{
    public function validate(
        array $file,
        array $allowedTypes = []
    ): bool {

        if (
            !isset(
                $file['tmp_name'],
                $file['type']
            )
        ) {
            return false;
        }

        if (!empty($allowedTypes)) {

            return in_array(
                $file['type'],
                $allowedTypes,
                true
            );
        }

        return true;
    }

    public function store(
        array $file,
        string $destination
    ): bool {

        if (
            !isset(
                $file['tmp_name']
            )
        ) {
            return false;
        }

        return move_uploaded_file(
            $file['tmp_name'],
            $destination
        );
    }

    public function size(
        array $file
    ): int {

        return (int) (
            $file['size'] ?? 0
        );
    }
}
