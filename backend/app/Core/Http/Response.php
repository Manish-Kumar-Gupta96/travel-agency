<?php

namespace App\Core\Http;

class Response
{
    protected mixed $content = null;
    protected int $statusCode = 200;
    protected array $headers = [];

    /**
     * Set response content
     */
    public function setContent(
        mixed $content
    ): static
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Set status code
     */
    public function status(
        int $code
    ): static
    {
        $this->statusCode = $code;
        return $this;
    }

    /**
     * Add Header
     */
    public function header(
        string $key,
        string $value
    ): static
    {
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * JSON Response
     */
    public function json(
        mixed $data,
        int $status = 200
    ): static
    {
        $this->headers['Content-Type'] = 'application/json; charset=UTF-8';
        $this->statusCode = $status;

        $this->content = json_encode(
            $data,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );

        return $this;
    }

    /**
     * HTML Response
     */
    public function html(
        string $content,
        int $status = 200
    ): static
    {
        $this->headers['Content-Type'] = 'text/html; charset=UTF-8';
        $this->statusCode = $status;
        $this->content = $content;

        return $this;
    }

    /**
     * Redirect Response
     */
    public function redirect(
        string $url,
        int $status = 302
    ): static
    {
        $this->headers['Location'] = $url;
        $this->statusCode = $status;

        return $this;
    }

    /**
     * Download File
     */
    public function download(
        string $file,
        ?string $name = null
    ): static
    {
        if (!file_exists($file)) {
            return $this->status(404);
        }

        $filename = $name ?? basename($file);

        $this->headers['Content-Disposition'] = 'attachment; filename="' . $filename . '"';
        $this->headers['Content-Type'] = mime_content_type($file);
        $this->content = file_get_contents($file);

        return $this;
    }

    /**
     * Send Response
     */
    public function send(): void
    {
        http_response_code(
            $this->statusCode
        );

        foreach ($this->headers as $key => $value) {
            header(
                $key . ': ' . $value
            );
        }

        echo $this->content;
    }

    /**
     * Get Status Code
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get Content
     */
    public function getContent(): mixed
    {
        return $this->content;
    }

    /**
     * Success Response Helper
     */
    public function success(
        mixed $data = null,
        string $message = "Success"
    ): static
    {
        return $this->json(
            [
                "status" => true,
                "message" => $message,
                "data" => $data
            ]
        );
    }

    /**
     * Error Response Helper
     */
    public function error(
        string $message,
        int $status = 400,
        mixed $errors = null
    ): static
    {
        return $this->json(
            [
                "status" => false,
                "message" => $message,
                "errors" => $errors
            ],
            $status
        );
    }
}
