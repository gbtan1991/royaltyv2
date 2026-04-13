<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Bramus\Router\Router;

// Load environment
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

$router = new Router();

// Test Route
$router->get('/', function() {
    echo "<h1>Royalty V2: Modern Edition</h1>";
    echo "<p>PSR-4 Autoloading is working!</p>";
});

$router->run();