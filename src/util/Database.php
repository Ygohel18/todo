<?php

namespace App\Util;

use PDO;
use PDOException;

class Database
{
    private static $connection;

    public static function getConnection(): PDO
    {
        if (!self::$connection) {
            try {
                $host = $_SERVER['DB_HOST'];
                $username = $_SERVER['DB_USER'];
                $password = $_SERVER['DB_PASSWORD'];
                $database = $_SERVER['DB_DATABASE'];
                self::$connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
