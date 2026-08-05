<?php

namespace App\Container;

abstract class ServiceProvider
{
    /**
     * Application Container
     */
    protected Container $app;

    /**
     * Provider Loaded Flag
     */
    protected bool $loaded = false;

    /**
     * Constructor
     */
    public function __construct(
        Container $app
    ) {
        $this->app = $app;
    }

    /**
     * Register Services
     */
    abstract public function register(): void;

    /**
     * Boot Services
     */
    public function boot(): void
    {
        // Override in child providers if needed.
    }

    /**
     * Boot Provider Once
     */
    final public function load(): void
    {
        if ($this->loaded) {
            return;
        }

        $this->register();
        $this->boot();

        $this->loaded = true;
    }

    /**
     * Get Container
     */
    public function app(): Container
    {
        return $this->app;
    }

    /**
     * Bind Service
     */
    protected function bind(
        string $abstract,
        \Closure|string|null $concrete = null
    ): void {
        $this->app->bind(
            $abstract,
            $concrete
        );
    }

    /**
     * Register Singleton
     */
    protected function singleton(
        string $abstract,
        \Closure|string|null $concrete = null
    ): void {
        $this->app->singleton(
            $abstract,
            $concrete
        );
    }

    /**
     * Register Existing Instance
     */
    protected function instance(
        string $abstract,
        mixed $instance
    ): void {
        $this->app->instance(
            $abstract,
            $instance
        );
    }

    /**
     * Resolve Service
     */
    protected function make(
        string $abstract
    ): mixed {
        return $this->app->make(
            $abstract
        );
    }

    /**
     * Check Binding
     */
    protected function has(
        string $abstract
    ): bool {
        return $this->app->has(
            $abstract
        );
    }
}
