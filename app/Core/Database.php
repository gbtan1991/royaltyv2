<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;

    private function __construct() {} // Block direct instantiation

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            try {
                // These come from your .env file
                $dsn = sprintf(
                    "mysql:host=%s;dbname=%s;charset=utf8mb4",
                    $_ENV['DB_HOST'],
                    $_ENV['DB_NAME']
                );

                self::$instance = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
            } catch (PDOException $e) {
                // In production, log this instead of showing it
                die("Database Connection Error: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}