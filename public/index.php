<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Bramus\Router\Router;
use App\Models\Customer;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

$router = new Router();

$router->get('/', function() {
    $customerModel = new Customer();
    $customers = $customerModel->all();

    echo "<h1>Royalty V2: Customer List</h1>";
    
    if (empty($customers)) {
        echo "<p>No customers found. Try adding some to your database!</p>";
    } else {
        echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
        echo "<thead><tr><th>ID</th><th>Username</th><th>Full Name</th><th>Points</th></tr></thead>";
        echo "<tbody>";
        foreach ($customers as $user) {
            echo "<tr>";
            echo "<td>{$user['id']}</td>";
            echo "<td>{$user['username']}</td>";
            echo "<td>{$user['fullname']}</td>";
            echo "<td><strong>{$user['total_points']}</strong></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
});

$router->run();