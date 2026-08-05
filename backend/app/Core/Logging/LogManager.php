<?php

declare(strict_types=1);

namespace App\Core\Logging;

use InvalidArgumentException;

class LogManager
{
    protected array $channels = [];
    protected string $default = 'app';

    public function __construct(
        array $config = []
    ) {
        $this->default = $config['default'] ?? 'app';
        $this->registerChannels($config);
    }

    /**
     * Register Channels
     */
    protected function registerChannels(
        array $config
    ): void {
        $channels = $config['channels'] ?? [];

        foreach ($channels as $name => $logger) {
            $this->channels[$name] = $logger;
        }
    }

    /**
     * Add Logger Channel
     */
    public function add(
        string $name,
        Logger $logger
    ): static {
        $this->channels[$name] = $logger;
        return $this;
    }

    /**
     * Get Logger
     */
    public function channel(
        ?string $name = null
    ): Logger
    {
        $name = $name ?? $this->default;

        if (!isset($this->channels[$name])) {
            throw new InvalidArgumentException(
                "Logger channel {$name} not found"
            );
        }

        return $this->channels[$name];
    }

    /**
     * Set Default Channel
     */
    public function setDefault(
        string $name
    ): void {
        $this->default = $name;
    }

    /**
     * Get Default Channel
     */
    public function getDefault(): string
    {
        return $this->default;
    }

    /**
     * Write Log
     */
    public function log(
        string $level,
        string $message,
        array $context = []
    ): void {
        $this->channel()->log($level, $message, $context);
    }

    /**
     * Error Shortcut
     */
    public function error(
        string $message,
        array $context = []
    ): void {
        $this->channel()->error($message, $context);
    }

    /**
     * Info Shortcut
     */
    public function info(
        string $message,
        array $context = []
    ): void {
        $this->channel()->info($message, $context);
    }

    /**
     * Warning Shortcut
     */
    public function warning(
        string $message,
        array $context = []
    ): void {
        $this->channel()->warning($message, $context);
    }

    /**
     * Debug Shortcut
     */
    public function debug(
        string $message,
        array $context = []
    ): void {
        $this->channel()->debug($message, $context);
    }

    /**
     * Emergency Shortcut
     */
    public function emergency(
        string $message,
        array $context = []
    ): void {
        $this->channel()->emergency($message, $context);
    }

    /**
     * Get Channel List
     */
    public function channels(): array
    {
        return array_keys($this->channels);
    }

    /**
     * Check Channel Exists
     */
    public function hasChannel(
        string $name
    ): bool
    {
        return isset($this->channels[$name]);
    }

    /**
     * Remove Channel
     */
    public function remove(
        string $name
    ): void
    {
        unset($this->channels[$name]);
    }

    /**
     * Magic Logger Access
     */
    public function __call(
        string $method,
        array $arguments
    ): mixed {
        return $this->channel()->$method(...$arguments);
    }
}
