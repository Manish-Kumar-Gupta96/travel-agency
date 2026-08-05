<?php

namespace App\Exceptions;

use Throwable;

class ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     */
    public function render(Throwable $exception): void
    {
        $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
        
        if ($statusCode < 100 || $statusCode > 599) {
            $statusCode = 500;
        }

        http_response_code($statusCode);
        header('Content-Type: application/json; charset=UTF-8');
        
        $errorPayload = [
            'success' => false,
            'message' => $exception->getMessage()
        ];
        
        if (filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN)) {
            $errorPayload['trace'] = $exception->getTraceAsString();
        }
        
        echo json_encode($errorPayload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
