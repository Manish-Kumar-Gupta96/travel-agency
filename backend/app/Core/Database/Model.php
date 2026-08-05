<?php

declare(strict_types=1);

namespace App\Core\Database;

use PDO;

abstract class Model
{
    protected static string $table;
    protected PDO $connection;
    protected array $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->connection = Connection::get();
        $this->attributes = $attributes;
    }

    public function __get(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __set(string $key, $value): void
    {
        $this->attributes[$key] = $value;
    }

    public static function query(): QueryBuilder
    {
        $instance = new static();
        return (new QueryBuilder($instance->connection))->table(static::$table);
    }

    public static function all(): array
    {
        return static::query()->get();
    }

    public static function find(
        int $id
    ): ?array {
        return static::query()
            ->where('id', '=', $id)
            ->first();
    }

    public static function create(
        array $data
    ): int {
        return static::query()->insert($data);
    }

    public function update(
        int $id,
        array $data
    ): bool {
        return static::query()
            ->where('id', '=', $id)
            ->update($data);
    }

    public function delete(
        int $id
    ): bool {
        return static::query()
            ->where('id', '=', $id)
            ->delete();
    }

    public function __call(string $method, array $parameters)
    {
        return static::query()->$method(...$parameters);
    }
}
