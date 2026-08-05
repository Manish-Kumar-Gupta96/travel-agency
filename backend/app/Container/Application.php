<?php

namespace App\Container;

use App\Http\Request;
use App\Http\Response;
use App\Routing\Router;
use Throwable;

class Application
{
    /**
     * Service Container
     */
    protected Container $container;

    /**
     * Registered Providers
     */
    protected array $providers = [];

    /**
     * Booted Flag
     */
    protected bool $booted = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->container = new Container();

        $this->container->instance(
            Container::class,
            $this->container
        );

        $this->container->instance(
            Application::class,
            $this
        );
    }

    /**
     * Get Container
     */
    public function container(): Container
    {
        return $this->container;
    }

    /**
     * Register Service Provider
     */
    public function register(
        string $provider
    ): static {

        /**
         * @var ServiceProvider $instance
         */
        $instance = new $provider(
            $this->container
        );

        $instance->load();

        $this->providers[] = $instance;

        return $this;
    }

    /**
     * Bootstrap Application
     */
    public function boot(): void
    {
        if ($this->booted) {
            return;
        }

        $this->booted = true;
    }

    /**
     * Handle HTTP Request
     */
    public function handle(
        Request $request
    ): Response {

        $this->boot();

        /** @var Router $router */
        $router = $this->container->make(
            Router::class
        );

        return $router->dispatch(
            $request
        );
    }

    /**
     * Run Application
     */
    public function run(): void
    {
        try {

            $request = Request::capture();

            $response = $this->handle(
                $request
            );

            $response->send();

        } catch (Throwable $exception) {

            if (
                $this->container->has(
                    \App\Exceptions\ExceptionHandler::class
                )
            ) {

                $this->container
                    ->make(
                        \App\Exceptions\ExceptionHandler::class
                    )
                    ->render($exception);

                return;
            }

            http_response_code(500);

            echo $exception->getMessage();
        }
    }

    /**
     * Resolve Service
     */
    public function make(
        string $abstract
    ): mixed {

        return $this->container->make(
            $abstract
        );
    }

    /**
     * Register Singleton
     */
    public function singleton(
        string $abstract,
        \Closure|string|null $concrete = null
    ): static {

        $this->container->singleton(
            $abstract,
            $concrete
        );

        return $this;
    }

    /**
     * Bind Service
     */
    public function bind(
        string $abstract,
        \Closure|string|null $concrete = null
    ): static {

        $this->container->bind(
            $abstract,
            $concrete
        );

        return $this;
    }
}
