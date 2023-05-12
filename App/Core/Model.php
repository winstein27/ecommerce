<?php

namespace app\core;

class Model
{
    private static $conn;

    public static function getConn()
    {

        if (!isset(self::$conn)) {
            self::$conn = new \PDO("mysql:host=localhost;port=3306;dbname=fastparking;", "root", "bcd127");
        }

        return self::$conn;
    }
}
