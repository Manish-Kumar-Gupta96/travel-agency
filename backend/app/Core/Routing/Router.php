<?php

declare(strict_types=1);

namespace App\Core\Routing;

use App\Core\Container\Container;
use App\Core\Http\Request;
use App\Core\Http\Response;
use Closure;

class Router
{
    protected RouteCollection $routes;
    protected Container $container;
    protected ?Route $matchedRoute = null;

    public function __construct(
        Container $container
    ) {
        $this->container = $container;
        $this->routes = new RouteCollection();
    }

    public function get(string $uri, mixed $action): Route
    {
        return $this->routes->get($uri, $action);
    }

    public function post(string $uri, mixed $action): Route
    {
        return $this->routes->post($uri, $action);
    }

    public function put(string $uri, mixed $action): Route
    {
        return $this->routes->put($uri, $action);
    }

    public function patch(string $uri, mixed $action): Route
    {
        return $this->routes->patch($uri, $action);
    }

    public function delete(string $uri, mixed $action): Route
    {
        return $this->routes->delete($uri, $action);
    }

    public function group(array $attributes, Closure $callback): void
    {
        $this->routes->group($attributes, $callback);
    }

    public function dispatch(
        string $method,
        string $uri
    ): Response {
        $route = $this->routes->match($method, $uri);

        if (!$route) {
            return (new Response())->error('Route Not Found', 404);
        }

        $this->matchedRoute = $route;
        $middlewares = $route->getMiddleware();

        $pipeline = function (Request $req) use ($route) {
            $action = $route->action();
            $parameters = $route->parameters();

            if ($route->isClosure()) {
                $reflection = new \ReflectionFunction($action);
                $args = [];
                foreach ($reflection->getParameters() as $param) {
                    $name = $param->getName();
                    $type = $param->getType();
                    if ($type && !$type->isBuiltin()) {
                        if ($type->getName() === Request::class) {
                            $args[] = $req;
                        } elseif ($type->getName() === Response::class) {
                            $args[] = $this->container->resolve(Response::class);
                        } else {
                            try {
                                $args[] = $this->container->resolve($type->getName());
                            } catch (\Exception $e) {
                                $args[] = null;
                            }
                        }
                    } elseif (array_key_exists($name, $parameters)) {
                        $args[] = $parameters[$name];
                    } else {
                        $args[] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;
                    }
                }
                $result = call_user_func_array($action, $args);
            } elseif ($route->isController()) {
                [$controllerClass, $methodName] = $action;

                $controllerInstance = $this->container->resolve($controllerClass);

                $reflection = new \ReflectionMethod($controllerClass, $methodName);
                $args = [];
                foreach ($reflection->getParameters() as $param) {
                    $name = $param->getName();
                    $type = $param->getType();
                    if ($type && !$type->isBuiltin()) {
                        if ($type->getName() === Request::class) {
                            $args[] = $req;
                        } elseif ($type->getName() === Response::class) {
                            $args[] = $this->container->resolve(Response::class);
                        } else {
                            try {
                                $args[] = $this->container->resolve($type->getName());
                            } catch (\Exception $e) {
                                $args[] = null;
                            }
                        }
                    } elseif (array_key_exists($name, $parameters)) {
                        $args[] = $parameters[$name];
                    } else {
                        $args[] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;
                    }
                }
                $result = call_user_func_array([$controllerInstance, $methodName], $args);
            } else {
                throw new \RuntimeException('Invalid route action');
            }

            if ($result instanceof Response) {
                return $result;
            }

            $response = new Response();
            if (is_array($result) || is_object($result)) {
                return $response->json($result);
            }
            return $response->setContent($result);
        };

        foreach (array_reverse($middlewares) as $middlewareName) {
            $pipeline = function (Request $req) use ($middlewareName, $pipeline) {
                $parts = explode(':', $middlewareName);
                $className = $parts[0];
                $parameters = array_slice($parts, 1);

                if (class_exists($className)) {
                    $middlewareInstance = $this->container->resolve($className);
                    if (!empty($parameters)) {
                        return $middlewareInstance->handle($req, $pipeline, ...$parameters);
                    }
                    return $middlewareInstance->handle($req, $pipeline);
                }

                if (is_callable($middlewareName)) {
                    return $middlewareName($req, $pipeline);
                }

                return $pipeline($req);
            };
        }

        $request = $this->container->resolve(Request::class);
        return $pipeline($request);
    }

    public function routes(): RouteCollection
    {
        return $this->routes;
    }

    public function getMatchedRoute(): ?Route
    {
        return $this->matchedRoute;
    }
}
