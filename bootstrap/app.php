<?php
// bootstrap/app.php
require_once __DIR__ . '/../vendor/autoload.php';

use Bramus\Router\Router;
use Dotenv\Dotenv;
use App\Helpers\Utils;


// This actually reads the .env file and fills $_ENV
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
// --------------------

$router = new Router();
$router->setBasePath('/royaltyv2/public');

// Load the routes
require_once __DIR__ . '/../routes/web.php';

// Return the router object so index.php can use it
return $router;