<?php

namespace App\Core;

class Database
{
    private static $conn;

    public static function getConn()
    {

        if (!isset(self::$conn)) {
            self::$conn = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . '; dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        }

        return self::$conn;
    }
}
