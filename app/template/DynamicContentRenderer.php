<?php

declare(strict_types=1);

namespace App\Template;

class DynamicContentRenderer
{
    public function render(
        string $content,
        array $data = []
    ): string {

        foreach ($data as $key => $value) {

            $content = str_replace(
                ':' . $key,
                (string) $value,
                $content
            );
        }

        return $content;
    }

    public function preview(
        string $content,
        array $sample = []
    ): string {

        return $this->render(
            $content,
            $sample
        );
    }
}
