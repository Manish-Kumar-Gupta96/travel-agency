<?php

declare(strict_types=1);

namespace App\Core\Container;

class Container
{
    protected array $bindings = [];

    public function bind(
        string $abstract,
        mixed $concrete
    ): void {
        $this->bindings[$abstract] = $concrete;
    }

    public function singleton(
        string $abstract,
        mixed $concrete
    ): void {
        $this->bindings[$abstract] = [
            'singleton' => true,
            'instance' => null,
            'concrete' => $concrete
        ];
    }

    public function resolve(
        string $abstract
    ): mixed {
        if (!isset($this->bindings[$abstract])) {
            return new $abstract();
        }

        $binding = $this->bindings[$abstract];

        if (
            is_array($binding)
            &&
            isset($binding['singleton'])
        ) {
            if ($binding['instance'] === null) {
                $binding['instance'] = $this->build($binding['concrete']);
                $this->bindings[$abstract] = $binding;
            }

            return $binding['instance'];
        }

        return $this->build($binding);
    }

    protected function build(
        mixed $concrete
    ): mixed {
        if (is_callable($concrete)) {
            return $concrete($this);
        }

        return new $concrete();
    }
}
