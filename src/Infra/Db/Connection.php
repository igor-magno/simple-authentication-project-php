<?php

namespace Src\Infra\Db;

use PDO;

class Connection
{
    private static $instance;

    public static function get(): PDO
    {
        if (!isset(self::$instance))
            self::$instance = new PDO(
                'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';port=' . $_ENV['DB_PORT'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD'],
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
            );
        return self::$instance;
    }
}
