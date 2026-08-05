<?php

declare(strict_types=1);

namespace App\Core\Logging;

use Throwable;

class FileLogger implements Logger
{
    protected string $path;
    protected string $channel;

    public function __construct(
        string $path = '',
        string $channel = 'app'
    ) {
        $this->path = $path !== '' ? $path : storage_path('logs');
        $this->channel = $channel;

        if (!is_dir($this->path)) {
            mkdir($this->path, 0755, true);
        }
    }

    /**
     * Emergency Log
     */
    public function emergency(
        string $message,
        array $context = []
    ): void {
        $this->log('EMERGENCY', $message, $context);
    }

    /**
     * Alert Log
     */
    public function alert(
        string $message,
        array $context = []
    ): void {
        $this->log('ALERT', $message, $context);
    }

    /**
     * Critical Log
     */
    public function critical(
        string $message,
        array $context = []
    ): void {
        $this->log('CRITICAL', $message, $context);
    }

    /**
     * Error Log
     */
    public function error(
        string $message,
        array $context = []
    ): void {
        $this->log('ERROR', $message, $context);
    }

    /**
     * Warning Log
     */
    public function warning(
        string $message,
        array $context = []
    ): void {
        $this->log('WARNING', $message, $context);
    }

    /**
     * Notice Log
     */
    public function notice(
        string $message,
        array $context = []
    ): void {
        $this->log('NOTICE', $message, $context);
    }

    /**
     * Info Log
     */
    public function info(
        string $message,
        array $context = []
    ): void {
        $this->log('INFO', $message, $context);
    }

    /**
     * Debug Log
     */
    public function debug(
        string $message,
        array $context = []
    ): void {
        $this->log('DEBUG', $message, $context);
    }

    /**
     * Write Log
     */
    public function log(
        string $level,
        string $message,
        array $context = []
    ): void {
        $date = date('Y-m-d H:i:s');
        $contextString = $this->formatContext($context);

        $line = "[{$date}] [{$level}] {$message}{$contextString}" . PHP_EOL;

        file_put_contents(
            $this->file(),
            $line,
            FILE_APPEND | LOCK_EX
        );
    }

    /**
     * Exception Logging
     */
    public function exception(
        Throwable $exception
    ): void {
        $this->error(
            $exception->getMessage(),
            [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString()
            ]
        );
    }

    /**
     * Format Context
     */
    protected function formatContext(
        array $context
    ): string {
        if (empty($context)) {
            return '';
        }

        return ' ' . json_encode(
            $context,
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * Get Current Log File
     */
    protected function file(): string
    {
        return $this->path
            . DIRECTORY_SEPARATOR
            . $this->channel
            . '-'
            . date('Y-m-d')
            . '.log';
    }

    /**
     * Set Channel
     */
    public function channel(
        string $channel
    ): static {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Get Channel
     */
    public function getChannel(): string
    {
        return $this->channel;
    }

    /**
     * Log File Path
     */
    public function path(): string
    {
        return $this->path;
    }

    /**
     * Clear All Logs
     */
    public function clear(): bool
    {
        $files = glob(
            $this->path
            . DIRECTORY_SEPARATOR
            . '*.log'
        );

        if (!$files) {
            return true;
        }

        foreach ($files as $file) {
            unlink($file);
        }

        return true;
    }

    /**
     * Get Log Size
     */
    public function size(): int
    {
        $file = $this->file();

        if (!file_exists($file)) {
            return 0;
        }

        return filesize($file);
    }

    /**
     * Check Log Exists
     */
    public function exists(): bool
    {
        return file_exists($this->file());
    }
}
