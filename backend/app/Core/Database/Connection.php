<?php

declare(strict_types=1);

namespace App\Core\Database;

use PDO;
use PDOException;

class Connection
{
    protected static ?PDO $connection = null;

    public static function get(): PDO
    {
        if (self::$connection !== null) {
            return self::$connection;
        }

        try {
            $config = require BASE_PATH . '/config/database.php';
            $database = $config['connections']['mysql'] ?? $config['mysql'] ?? [];

            $dsn = sprintf(
                "%s:host=%s;port=%s;dbname=%s;charset=utf8mb4",
                $database['driver'],
                $database['host'],
                $database['port'],
                $database['database']
            );

            self::$connection = new PDO(
                $dsn,
                $database['username'],
                $database['password'],
                $database['options']
            );

            return self::$connection;
        } catch (PDOException $exception) {
            throw new PDOException(
                "Database Connection Failed: " . $exception->getMessage()
            );
        }
    }

    public static function disconnect(): void
    {
        self::$connection = null;
    }
}
