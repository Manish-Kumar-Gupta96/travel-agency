<?php

declare(strict_types=1);

namespace App\Core\Foundation;

use App\Core\Container\Container;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Routing\Router;

class Application
{
    protected static ?self $instance = null;
    protected Container $container;

    public function __construct()
    {
        self::$instance = $this;
        $this->container = new Container();
        $this->registerCoreServices();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function registerCoreServices(): void
    {
        $this->container->singleton(
            Request::class,
            function () {
                return new Request();
            }
        );

        $this->container->singleton(
            Response::class,
            function () {
                return new Response();
            }
        );

        $this->container->singleton(
            Router::class,
            function (Container $c) {
                return new Router($c);
            }
        );
    }

    public function run(): void
    {
        $request = $this->container->resolve(Request::class);
        $router = $this->container->resolve(Router::class);

        /** @var Response $response */
        $response = $router->dispatch(
            $request->method(),
            $request->uri()
        );

        $response->send();
    }

    public function container(): Container
    {
        return $this->container;
    }
}
