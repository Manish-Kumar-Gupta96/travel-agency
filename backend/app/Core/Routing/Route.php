<?php

declare(strict_types=1);

namespace App\Core\Routing;

use Closure;

class Route
{
    protected string $method;
    protected string $uri;
    protected mixed $action;
    protected array $middleware = [];
    protected array $parameters = [];
    protected ?string $name = null;
    protected array $constraints = [];

    /**
     * Create Route
     */
    public function __construct(
        string $method,
        string $uri,
        mixed $action
    ) {
        $this->method = strtoupper($method);
        $this->uri = $this->normalizeUri($uri);
        $this->action = $action;
    }

    /**
     * Normalize URI
     */
    protected function normalizeUri(
        string $uri
    ): string {
        $uri = trim($uri, '/');

        if ($uri === '') {
            return '/';
        }

        return '/' . $uri;
    }

    /**
     * Get Method
     */
    public function method(): string
    {
        return $this->method;
    }

    /**
     * Get URI
     */
    public function uri(): string
    {
        return $this->uri;
    }

    /**
     * Get Action
     */
    public function action(): mixed
    {
        return $this->action;
    }

    /**
     * Add Middleware
     */
    public function middleware(
        array|string $middleware
    ): static {
        if (is_array($middleware)) {
            $this->middleware = array_merge(
                $this->middleware,
                $middleware
            );
        } else {
            $this->middleware[] = $middleware;
        }

        return $this;
    }

    /**
     * Get Middleware
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    /**
     * Assign Route Name
     */
    public function name(
        string $name
    ): static {
        $this->name = $name;
        return $this;
    }

    /**
     * Get Route Name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Add Parameter Constraint
     */
    public function where(
        string $parameter,
        string $pattern
    ): static {
        $this->constraints[$parameter] = $pattern;
        return $this;
    }

    /**
     * Get Constraints
     */
    public function constraints(): array
    {
        return $this->constraints;
    }

    /**
     * Check Closure Action
     */
    public function isClosure(): bool
    {
        return $this->action instanceof Closure;
    }

    /**
     * Check Controller Action
     */
    public function isController(): bool
    {
        return is_array($this->action)
            &&
            count($this->action) === 2;
    }

    /**
     * Check Route Match
     */
    public function matches(
        string $method,
        string $uri
    ): bool {
        if (
            strtoupper($method)
            !==
            $this->method
        ) {
            return false;
        }

        $pattern = $this->compilePattern();

        return preg_match(
            $pattern,
            $this->normalizeUri($uri)
        ) === 1;
    }

    /**
     * Extract Route Parameters
     */
    public function extractParameters(
        string $uri
    ): array {
        $pattern = $this->compilePattern();
        $matches = [];

        preg_match(
            $pattern,
            $this->normalizeUri($uri),
            $matches
        );

        array_shift($matches);

        $keys = $this->parameterNames();
        $this->parameters = [];

        foreach ($keys as $index => $key) {
            if (isset($matches[$index])) {
                $this->parameters[$key] = $matches[$index];
            }
        }

        return $this->parameters;
    }

    /**
     * Generate Regex Pattern
     */
    protected function compilePattern(): string
    {
        $uri = preg_replace_callback(
            '/\{([^}]+)\}/',
            function ($matches) {
                $parameter = $matches[1];
                $constraint = $this->constraints[$parameter] ?? '[^\/]+';
                return '(' . $constraint . ')';
            },
            $this->uri
        );

        return '#^' . $uri . '$#';
    }

    /**
     * Get Parameter Names
     */
    protected function parameterNames(): array
    {
        preg_match_all(
            '/\{([^}]+)\}/',
            $this->uri,
            $matches
        );

        return $matches[1] ?? [];
    }

    /**
     * Get Parameters
     */
    public function parameters(): array
    {
        return $this->parameters;
    }

    /**
     * Add Parameter
     */
    public function setParameter(
        string $key,
        mixed $value
    ): void {
        $this->parameters[$key] = $value;
    }

    /**
     * Get Action Type
     */
    public function actionType(): string
    {
        if ($this->isClosure()) {
            return 'closure';
        }

        if ($this->isController()) {
            return 'controller';
        }

        return 'unknown';
    }

    /**
     * Get Controller Class
     */
    public function controller(): ?string
    {
        if (!$this->isController()) {
            return null;
        }

        return $this->action[0];
    }

    /**
     * Get Controller Method
     */
    public function controllerMethod(): ?string
    {
        if (!$this->isController()) {
            return null;
        }

        return $this->action[1];
    }

    /**
     * Replace Route Prefix
     */
    public function prefix(
        string $prefix
    ): static {
        $prefix = trim($prefix, '/');
        $this->uri = '/' . $prefix . $this->uri;
        return $this;
    }

    /**
     * Generate URL From Route
     */
    public function generate(
        array $parameters = []
    ): string {
        $url = $this->uri;

        foreach ($parameters as $key => $value) {
            $url = str_replace(
                '{' . $key . '}',
                (string) $value,
                $url
            );
        }

        return $url;
    }

    /**
     * Check Required Parameters
     */
    public function missingParameters(
        array $parameters
    ): array {
        $missing = [];

        foreach ($this->parameterNames() as $parameter) {
            if (!array_key_exists($parameter, $parameters)) {
                $missing[] = $parameter;
            }
        }

        return $missing;
    }

    /**
     * Route Definition Array
     */
    public function toArray(): array
    {
        return [
            'method' => $this->method,
            'uri' => $this->uri,
            'name' => $this->name,
            'middleware' => $this->middleware,
            'action_type' => $this->actionType(),
            'controller' => $this->controller(),
            'controller_method' => $this->controllerMethod(),
            'constraints' => $this->constraints
        ];
    }

    /**
     * Clone Route
     */
    public function duplicate(): static
    {
        return clone $this;
    }

    /**
     * Set Action
     */
    public function setAction(
        mixed $action
    ): static {
        $this->action = $action;
        return $this;
    }

    /**
     * Set URI
     */
    public function setUri(
        string $uri
    ): static {
        $this->uri = $this->normalizeUri($uri);
        return $this;
    }

    /**
     * Check Route Has Middleware
     */
    public function hasMiddleware(
        string $middleware
    ): bool {
        return in_array(
            $middleware,
            $this->middleware,
            true
        );
    }

    /**
     * Check Named Route
     */
    public function hasName(): bool
    {
        return $this->name !== null;
    }

    /**
     * Magic Convert
     */
    public function __toString(): string
    {
        return $this->method . ' ' . $this->uri;
    }
}
