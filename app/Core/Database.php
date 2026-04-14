<?php


// As we are using psr-4 autoloading, this is a declaration calling the namespace of this class to avoid using too much includes and required statements.
namespace App\Core;

// Imports the built-in PHP database tools.
use PDO;
use PDOException;

class Database
{
    // This is a singleton pattern to ensure we only have one database connection throughout the application.
    private static $instance = null;

    private function __construct() {} // Block direct instantiation of the class.

    // This method returns the PDO connection instance, creating it if doesn't already exist.
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            try {
                // These come from the .env file
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