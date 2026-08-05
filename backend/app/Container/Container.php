<?php

namespace App\Container;

use Closure;
use ReflectionClass;
use ReflectionNamedType;
use RuntimeException;

class Container
{
    /**
     * Registered Bindings
     */
    protected array $bindings = [];

    /**
     * Shared Instances
     */
    protected array $instances = [];

    /**
     * Singleton Flags
     */
    protected array $singletons = [];

    /**
     * Bind Service
     */
    public function bind(
        string $abstract,
        Closure|string|null $concrete = null,
        bool $singleton = false
    ): void {

        if ($concrete === null) {
            $concrete = $abstract;
        }

        $this->bindings[$abstract] = $concrete;

        if ($singleton) {
            $this->singletons[$abstract] = true;
        }
    }

    /**
     * Register Singleton
     */
    public function singleton(
        string $abstract,
        Closure|string|null $concrete = null
    ): void {

        $this->bind(
            $abstract,
            $concrete,
            true
        );
    }

    /**
     * Register Existing Instance
     */
    public function instance(
        string $abstract,
        mixed $instance
    ): void {

        $this->instances[$abstract] = $instance;
    }

    /**
     * Resolve Service
     */
    public function make(
        string $abstract
    ): mixed {

        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $concrete = $this->bindings[$abstract] ?? $abstract;

        if ($concrete instanceof Closure) {

            $object = $concrete($this);

        } else {

            $object = $this->build($concrete);

        }

        if (isset($this->singletons[$abstract])) {
            $this->instances[$abstract] = $object;
        }

        return $object;
    }

    /**
     * Build Class
     */
    protected function build(
        string $class
    ): object {

        if (!class_exists($class)) {
            throw new RuntimeException(
                "Class {$class} does not exist."
            );
        }

        $reflection = new ReflectionClass($class);

        if (!$reflection->isInstantiable()) {
            throw new RuntimeException(
                "Class {$class} is not instantiable."
            );
        }

        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return new $class();
        }

        $dependencies = [];

        foreach ($constructor->getParameters() as $parameter) {

            $type = $parameter->getType();

            if (
                !$type instanceof ReflectionNamedType ||
                $type->isBuiltin()
            ) {

                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                    continue;
                }

                throw new RuntimeException(
                    "Unable to resolve parameter {$parameter->getName()} for {$class}."
                );
            }

            $dependencies[] = $this->make(
                $type->getName()
            );
        }

        return $reflection->newInstanceArgs(
            $dependencies
        );
    }

    /**
     * Check Binding
     */
    public function has(
        string $abstract
    ): bool {

        return isset($this->bindings[$abstract])
            || isset($this->instances[$abstract]);
    }

    /**
     * Remove Binding
     */
    public function forget(
        string $abstract
    ): void {

        unset(
            $this->bindings[$abstract],
            $this->instances[$abstract],
            $this->singletons[$abstract]
        );
    }

    /**
     * Flush Container
     */
    public function flush(): void
    {

        $this->bindings = [];
        $this->instances = [];
        $this->singletons = [];
    }
}
