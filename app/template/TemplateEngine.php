<?php

declare(strict_types=1);

namespace App\Template;

class TemplateEngine
{
    /**
     * @var array<string,string>
     */
    private array $templates = [];

    public function register(
        string $name,
        string $content
    ): void {

        $this->templates[$name] = $content;
    }

    public function render(
        string $name,
        array $variables = []
    ): string {

        $template = $this->templates[$name] ?? '';

        foreach ($variables as $key => $value) {

            $template = str_replace(
                '{{'.$key.'}}',
                (string) $value,
                $template
            );
        }

        return $template;
    }

    public function exists(
        string $name
    ): bool {

        return isset(
            $this->templates[$name]
        );
    }

    public function all(): array
    {
        return $this->templates;
    }
}
