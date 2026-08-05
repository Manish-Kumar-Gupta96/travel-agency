<?php

declare(strict_types=1);

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    protected PDO $connection;
    protected string $table = "";
    protected array $where = [];
    protected array $bindings = [];
    protected string $orderBy = "";
    protected ?string $distinctColumn = null;
    protected array $joins = [];

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function join(string $table, string $first, string $operator = null, string $second = null): self
    {
        if ($operator === null) {
            $this->joins[] = " INNER JOIN {$table} ON {$first}";
        } else {
            $this->joins[] = " INNER JOIN {$table} ON {$first} {$operator} {$second}";
        }
        return $this;
    }

    public function where(string $column, mixed $operator = null, mixed $value = null, string $boolean = 'AND'): self
    {
        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }

        $this->where[] = [
            'type' => 'basic',
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
            'boolean' => $boolean
        ];
        return $this;
    }

    public function orWhere(string $column, mixed $operator = null, mixed $value = null): self
    {
        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }
        return $this->where($column, $operator, $value, 'OR');
    }

    public function whereBetween(string $column, mixed $min, mixed $max, string $boolean = 'AND'): self
    {
        $this->where[] = [
            'type' => 'whereBetween',
            'column' => $column,
            'min' => $min,
            'max' => $max,
            'boolean' => $boolean
        ];
        return $this;
    }

    public function like(string $column, mixed $value, string $boolean = 'AND'): self
    {
        $this->where[] = [
            'type' => 'like',
            'column' => $column,
            'value' => $value,
            'boolean' => $boolean
        ];
        return $this;
    }

    public function orLike(string $column, mixed $value): self
    {
        return $this->like($column, $value, 'OR');
    }

    public function whereMonth(string $column, mixed $value, string $boolean = 'AND'): self
    {
        $this->where[] = [
            'type' => 'whereMonth',
            'column' => $column,
            'value' => $value,
            'boolean' => $boolean
        ];
        return $this;
    }

    public function whereYear(string $column, mixed $value, string $boolean = 'AND'): self
    {
        $this->where[] = [
            'type' => 'whereYear',
            'column' => $column,
            'value' => $value,
            'boolean' => $boolean
        ];
        return $this;
    }

    public function groupStart(string $boolean = 'AND'): self
    {
        $this->where[] = [
            'type' => 'groupStart',
            'boolean' => $boolean
        ];
        return $this;
    }

    public function groupEnd(): self
    {
        $this->where[] = [
            'type' => 'groupEnd'
        ];
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self
    {
        $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';
        $this->orderBy = " ORDER BY {$column} {$direction}";
        return $this;
    }

    public function distinct(string $column): self
    {
        $this->distinctColumn = $column;
        return $this;
    }

    protected function compileWheres(): string
    {
        if (empty($this->where)) {
            return "";
        }

        $sql = " WHERE ";
        $compiledBindings = [];

        foreach ($this->where as $index => $clause) {
            $type = $clause['type'];
            $boolean = $clause['boolean'] ?? 'AND';

            if ($index > 0) {
                $prevClause = $this->where[$index - 1];
                if ($prevClause['type'] !== 'groupStart' && $type !== 'groupEnd') {
                    $sql .= " {$boolean} ";
                }
            }

            if ($type === 'groupStart') {
                $sql .= " (";
            } elseif ($type === 'groupEnd') {
                $sql .= ") ";
            } elseif ($type === 'basic') {
                $column = $clause['column'];
                $operator = $clause['operator'];
                $value = $clause['value'];

                if ($value === null && ($operator === '=' || $operator === 'IS')) {
                    $sql .= "{$column} IS NULL";
                } else {
                    $sql .= "{$column} {$operator} ?";
                    $compiledBindings[] = $value;
                }
            } elseif ($type === 'like') {
                $column = $clause['column'];
                $value = $clause['value'];
                $sql .= "{$column} LIKE ?";
                $compiledBindings[] = "%{$value}%";
            } elseif ($type === 'whereMonth') {
                $column = $clause['column'];
                $value = $clause['value'];
                $sql .= "MONTH({$column}) = ?";
                $compiledBindings[] = $value;
            } elseif ($type === 'whereYear') {
                $column = $clause['column'];
                $value = $clause['value'];
                $sql .= "YEAR({$column}) = ?";
                $compiledBindings[] = $value;
            } elseif ($type === 'whereBetween') {
                $column = $clause['column'];
                $min = $clause['min'];
                $max = $clause['max'];
                $sql .= "{$column} BETWEEN ? AND ?";
                $compiledBindings[] = $min;
                $compiledBindings[] = $max;
            }
        }

        $this->bindings = $compiledBindings;
        return $sql;
    }

    public function get(): array
    {
        $query = "SELECT * FROM {$this->table}";
        if (!empty($this->joins)) {
            $query .= implode("", $this->joins);
        }
        $query .= $this->compileWheres();
        if (!empty($this->orderBy)) {
            $query .= $this->orderBy;
        }

        $statement = $this->connection->prepare($query);
        $statement->execute($this->bindings);

        return $statement->fetchAll();
    }

    public function first(): ?array
    {
        $query = "SELECT * FROM {$this->table}";
        if (!empty($this->joins)) {
            $query .= implode("", $this->joins);
        }
        $query .= $this->compileWheres();
        if (!empty($this->orderBy)) {
            $query .= $this->orderBy;
        }
        $query .= " LIMIT 1";

        $statement = $this->connection->prepare($query);
        $statement->execute($this->bindings);
        $result = $statement->fetch();

        return $result ?: null;
    }

    public function count(string $column = '*'): int
    {
        if ($this->distinctColumn !== null) {
            $sql = "SELECT COUNT(DISTINCT {$this->distinctColumn}) as total FROM {$this->table}";
        } else {
            $sql = "SELECT COUNT({$column}) as total FROM {$this->table}";
        }
        if (!empty($this->joins)) {
            $sql .= implode("", $this->joins);
        }
        $sql .= $this->compileWheres();

        $statement = $this->connection->prepare($sql);
        $statement->execute($this->bindings);
        $result = $statement->fetch();

        return (int) ($result['total'] ?? 0);
    }

    public function sum(string $column): float
    {
        $sql = "SELECT SUM({$column}) as total FROM {$this->table}";
        if (!empty($this->joins)) {
            $sql .= implode("", $this->joins);
        }
        $sql .= $this->compileWheres();

        $statement = $this->connection->prepare($sql);
        $statement->execute($this->bindings);
        $result = $statement->fetch();

        return (float) ($result['total'] ?? 0);
    }

    public function avg(string $column): float
    {
        $sql = "SELECT AVG({$column}) as total FROM {$this->table}";
        if (!empty($this->joins)) {
            $sql .= implode("", $this->joins);
        }
        $sql .= $this->compileWheres();

        $statement = $this->connection->prepare($sql);
        $statement->execute($this->bindings);
        $result = $statement->fetch();

        return (float) ($result['total'] ?? 0);
    }

    public function exists(): bool
    {
        return $this->count() > 0;
    }

    public function insert(array $data): int
    {
        $columns = implode(",", array_keys($data));
        $values = implode(",", array_fill(0, count($data), "?"));

        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";

        $statement = $this->connection->prepare($query);
        $statement->execute(array_values($data));

        return (int) $this->connection->lastInsertId();
    }

    public function update(array $data): bool
    {
        $columns = [];
        $updateBindings = [];

        foreach ($data as $column => $value) {
            $columns[] = "{$column} = ?";
            $updateBindings[] = $value;
        }

        $query = "UPDATE {$this->table} SET " . implode(",", $columns);
        $wheres = $this->compileWheres();
        $query .= $wheres;

        $statement = $this->connection->prepare($query);
        return $statement->execute(array_merge($updateBindings, $this->bindings));
    }

    public function delete(): bool
    {
        $query = "DELETE FROM {$this->table}";
        $query .= $this->compileWheres();

        $statement = $this->connection->prepare($query);
        return $statement->execute($this->bindings);
    }
}
