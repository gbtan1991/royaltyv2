<?php
require_once __DIR__ . '/layout.php';

// Map of allowed pages => file paths
$routes = [
    'dashboard' => __DIR__ . '/../views/dashboard.php',
    'customer_view' => __DIR__ . '/../controllers/customer/customer_view.php',
    'add_customer' => __DIR__ . '/../views/customer/add_customer.php',
    'save_customer' => __DIR__ . '/../controllers/customer/add_customer.php',

    'transaction_view' => __DIR__ . '/../controllers/transaction/transaction_view.php',
    'add_transaction' => __DIR__ . '/../views/transaction/add_transaction.php',

    
    'claim_view' => __DIR__ . '/../controllers/claim/claim_view.php',
    'reward_view' => __DIR__ . '/../controllers/reward/reward_view.php',
    'admin_view' => __DIR__ . '/../controllers/admin/admin_view.php',
    'logout' => __DIR__ . '/../public/logout.php',
];

$pageCategories = [
    'dashboard' => '',

    'customer_view' => 'customer',
    'add_customer' => 'customer',

    'transaction_view' => 'transaction',
    'claim_view' => 'claim',
    'reward_view' => 'reward',
    'admin_view' => 'admin',
];

$category = $pageCategories[$_GET['page'] ?? 'dashboard'] ?? '';

// Get requested page
$page = $_GET['page'] ?? 'dashboard';

if (isset($routes[$page]) && file_exists($routes[$page])) {
    ob_start();
    include $routes[$page];
    $pageContent = ob_get_clean();

    render_layout($pageContent, $page, $category);
} else {
    http_response_code(404);
    render_layout('<h2>404 - Page not found</h2>');
}
