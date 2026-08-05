<?php

namespace App\Core\Http;

class Request
{
    protected array $query = [];
    protected array $body = [];
    protected array $files = [];
    protected array $headers = [];
    protected string $method;
    protected string $uri;

    public function __construct()
    {
        $this->method = strtoupper(
            $_SERVER['REQUEST_METHOD'] ?? 'GET'
        );

        $this->uri = parse_url(
            $_SERVER['REQUEST_URI'] ?? '/',
            PHP_URL_PATH
        );

        $this->query = $_GET ?? [];
        $this->body = $this->parseBody();
        $this->files = $_FILES ?? [];
        $this->headers = $this->loadHeaders();
    }

    /**
     * Get HTTP Method
     */
    public function method(): string
    {
        return $this->method;
    }

    /**
     * Get Request URI
     */
    public function uri(): string
    {
        return $this->uri;
    }

    /**
     * Check request method
     */
    public function isMethod(
        string $method
    ): bool
    {
        return $this->method === strtoupper($method);
    }

    /**
     * Get query parameter
     */
    public function query(
        ?string $key = null,
        mixed $default = null
    ): mixed
    {
        if ($key === null) {
            return $this->query;
        }

        return $this->query[$key] ?? $default;
    }

    /**
     * Get body input
     */
    public function input(
        ?string $key = null,
        mixed $default = null
    ): mixed
    {
        if ($key === null) {
            return $this->body;
        }

        return $this->body[$key] ?? $default;
    }

    /**
     * Get all input data
     */
    public function all(): array
    {
        return array_merge(
            $this->query,
            $this->body
        );
    }

    /**
     * Check input exists
     */
    public function has(
        string $key
    ): bool
    {
        return isset($this->body[$key]);
    }

    /**
     * Get uploaded file
     */
    public function file(
        string $key
    ): mixed
    {
        return $this->files[$key] ?? null;
    }

    /**
     * Get Header
     */
    public function header(
        string $key,
        mixed $default = null
    ): mixed
    {
        $key = strtolower($key);
        return $this->headers[$key] ?? $default;
    }

    /**
     * Get JSON body
     */
    protected function parseBody(): array
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

        if (
            str_contains(
                $contentType,
                'application/json'
            )
        ) {
            $content = file_get_contents(
                "php://input"
            );

            $json = json_decode(
                $content,
                true
            );

            return is_array($json) ? $json : [];
        }

        return $_POST ?? [];
    }

    /**
     * Load request headers
     */
    protected function loadHeaders(): array
    {
        $headers = [];

        foreach ($_SERVER as $key => $value) {
            if (
                str_starts_with(
                    $key,
                    'HTTP_'
                )
            ) {
                $header = strtolower(
                    str_replace(
                        '_',
                        '-',
                        substr(
                            $key,
                            5
                        )
                    )
                );

                $headers[$header] = $value;
            }
        }

        return $headers;
    }

    /**
     * Get Client IP
     */
    public function ip(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }

    /**
     * Check AJAX request
     */
    public function ajax(): bool
    {
        return $this->header(
            'x-requested-with'
        ) === 'XMLHttpRequest';
    }

    /**
     * Sanitize input
     */
    public function sanitize(
        mixed $value
    ): mixed
    {
        if (is_string($value)) {
            return htmlspecialchars(
                trim($value),
                ENT_QUOTES,
                'UTF-8'
            );
        }

        return $value;
    }

    /**
     * Bearer Token
     */
    public function bearerToken(): ?string
    {
        $header = $this->header(
            'authorization'
        );

        if (
            $header &&
            str_starts_with(
                $header,
                'Bearer '
            )
        ) {
            return substr(
                $header,
                7
            );
        }

        return null;
    }
}
