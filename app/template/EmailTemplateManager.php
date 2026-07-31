<?php

declare(strict_types=1);

namespace App\Template;

class EmailTemplateManager
{
    /**
     * @var array<string,array<string,mixed>>
     */
    private array $templates = [];

    public function create(
        string $name,
        string $subject,
        string $body
    ): void {

        $this->templates[$name] = [
            'subject' => $subject,
            'body' => $body,
            'created_at' => date('c'),
        ];
    }

    public function get(
        string $name
    ): ?array {

        return $this->templates[$name] ?? null;
    }

    public function remove(
        string $name
    ): void {

        unset(
            $this->templates[$name]
        );
    }

    public function all(): array
    {
        return $this->templates;
    }
}
