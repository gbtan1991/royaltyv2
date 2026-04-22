<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Change this line to be more explicit:
$basePath = dirname(__DIR__);
require_once $basePath . '/app/Helpers/Route.php';

use Bramus\Router\Router;
use Dotenv\Dotenv;
use App\Helpers\Route;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// 1. Create the Bramus Engine
$router = new Router();
$router->setBasePath('/royaltyv2/public');

// 2. Initialize our Helper with the Engine
Route::init($router);

// 3. Load your route definitions
require_once __DIR__ . '/../routes/web.php';

// Return the engine so index.php can call $router->run()
return $router;