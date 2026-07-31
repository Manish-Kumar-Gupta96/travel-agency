<?php

declare(strict_types=1);

namespace App\Notification;

class MailTemplateEngine
{
    /**
     * @var array<string,string>
     */
    private array $templates = [];

    public function register(
        string $name,
        string $template
    ): void {

        $this->templates[$name] = $template;
    }

    public function render(
        string $name,
        array $data = []
    ): string {

        $template = $this->templates[$name] ?? '';

        foreach ($data as $key => $value) {

            $template = str_replace(
                '{{' . $key . '}}',
                (string) $value,
                $template
            );
        }

        return $template;
    }

    public function has(
        string $name
    ): bool {

        return isset(
            $this->templates[$name]
        );
    }
}
