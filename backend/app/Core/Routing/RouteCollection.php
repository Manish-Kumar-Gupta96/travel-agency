<?php

declare(strict_types=1);

namespace App\Core\Routing;

use Closure;

class RouteCollection
{
    protected array $routes = [];
    protected array $namedRoutes = [];
    protected array $groupStack = [];

    /**
     * Add Route
     */
    public function add(
        Route $route
    ): Route {
        $this->applyGroupAttributes($route);

        $this->routes[] = $route;

        if ($route->hasName()) {
            $this->namedRoutes[$route->getName()] = $route;
        }

        return $route;
    }

    /**
     * Register GET Route
     */
    public function get(
        string $uri,
        mixed $action
    ): Route {
        return $this->add(
            new Route('GET', $uri, $action)
        );
    }

    /**
     * Register POST Route
     */
    public function post(
        string $uri,
        mixed $action
    ): Route {
        return $this->add(
            new Route('POST', $uri, $action)
        );
    }

    /**
     * Register PUT Route
     */
    public function put(
        string $uri,
        mixed $action
    ): Route {
        return $this->add(
            new Route('PUT', $uri, $action)
        );
    }

    /**
     * Register PATCH Route
     */
    public function patch(
        string $uri,
        mixed $action
    ): Route {
        return $this->add(
            new Route('PATCH', $uri, $action)
        );
    }

    /**
     * Register DELETE Route
     */
    public function delete(
        string $uri,
        mixed $action
    ): Route {
        return $this->add(
            new Route('DELETE', $uri, $action)
        );
    }

    /**
     * Get All Routes
     */
    public function all(): array
    {
        return $this->routes;
    }

    /**
     * Count Routes
     */
    public function count(): int
    {
        return count($this->routes);
    }

    /**
     * Find Matching Route
     */
    public function match(
        string $method,
        string $uri
    ): ?Route {
        foreach ($this->routes as $route) {
            if ($route->matches($method, $uri)) {
                $route->extractParameters($uri);
                return $route;
            }
        }

        return null;
    }

    /**
     * Find Route By Name
     */
    public function getByName(
        string $name
    ): ?Route {
        return $this->namedRoutes[$name] ?? null;
    }

    /**
     * Generate URL By Route Name
     */
    public function url(
        string $name,
        array $parameters = []
    ): ?string {
        $route = $this->getByName($name);

        if (!$route) {
            return null;
        }

        return $route->generate($parameters);
    }

    /**
     * Route Group
     */
    public function group(
        array $attributes,
        Closure $callback
    ): void {
        $this->groupStack[] = $attributes;
        $callback($this);
        array_pop($this->groupStack);
    }

    /**
     * Apply Group Attributes
     */
    protected function applyGroupAttributes(
        Route $route
    ): void {
        if (empty($this->groupStack)) {
            return;
        }

        $prefix = '';
        $middleware = [];

        foreach ($this->groupStack as $group) {
            if (isset($group['prefix'])) {
                $prefix .= '/' . trim($group['prefix'], '/');
            }

            if (isset($group['middleware'])) {
                $middleware = array_merge(
                    $middleware,
                    (array) $group['middleware']
                );
            }
        }

        if ($prefix !== '') {
            $route->prefix($prefix);
        }

        if (!empty($middleware)) {
            $route->middleware($middleware);
        }
    }

    /**
     * Remove Route
     */
    public function remove(
        Route $route
    ): void {
        foreach ($this->routes as $key => $item) {
            if ($item === $route) {
                unset($this->routes[$key]);
            }
        }

        $this->routes = array_values($this->routes);
    }

    /**
     * Clear Routes
     */
    public function clear(): void
    {
        $this->routes = [];
        $this->namedRoutes = [];
    }

    /**
     * Get Routes As Array
     */
    public function toArray(): array
    {
        $routes = [];

        foreach ($this->routes as $route) {
            $routes[] = $route->toArray();
        }

        return $routes;
    }

    /**
     * Search Routes
     */
    public function search(
        string $keyword
    ): array {
        $results = [];

        foreach ($this->routes as $route) {
            if (str_contains($route->uri(), $keyword)) {
                $results[] = $route;
            }
        }

        return $results;
    }

    /**
     * Get Routes By Method
     */
    public function getByMethod(
        string $method
    ): array {
        $results = [];

        foreach ($this->routes as $route) {
            if ($route->method() === strtoupper($method)) {
                $results[] = $route;
            }
        }

        return $results;
    }

    /**
     * Check Named Route Exists
     */
    public function hasName(
        string $name
    ): bool {
        return isset($this->namedRoutes[$name]);
    }

    /**
     * Get Named Routes
     */
    public function namedRoutes(): array
    {
        return $this->namedRoutes;
    }

    /**
     * Replace Existing Route
     */
    public function replace(
        Route $oldRoute,
        Route $newRoute
    ): bool {
        foreach ($this->routes as $key => $route) {
            if ($route === $oldRoute) {
                $this->routes[$key] = $newRoute;
                return true;
            }
        }

        return false;
    }

    /**
     * Export Routes For Cache
     */
    public function export(): array
    {
        return [
            'routes' => $this->toArray(),
            'count' => $this->count()
        ];
    }

    /**
     * Import Cached Routes
     */
    public function import(
        array $data
    ): void {
        if (!isset($data['routes'])) {
            return;
        }

        foreach ($data['routes'] as $routeData) {
            $route = new Route(
                $routeData['method'],
                $routeData['uri'],
                [
                    $routeData['controller'],
                    $routeData['controller_method']
                ]
            );

            if (!empty($routeData['name'])) {
                $route->name($routeData['name']);
            }

            if (!empty($routeData['middleware'])) {
                $route->middleware($routeData['middleware']);
            }

            $this->add($route);
        }
    }

    /**
     * Iterator Support
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->routes);
    }

    /**
     * Debug Routes
     */
    public function debug(): array
    {
        return [
            'total_routes' => $this->count(),
            'routes' => $this->toArray()
        ];
    }
}
