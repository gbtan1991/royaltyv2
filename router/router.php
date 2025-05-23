<?php
require_once __DIR__ . '/layout.php';

// Map of allowed pages => file paths
$routes = [
    'dashboard' => __DIR__ . '/../views/dashboard.php',
    'customer_view' => __DIR__ . '/../controllers/customer/customer_view.php',
    'transaction_view' => __DIR__ . '/../controllers/transaction/transaction_view.php',
    'claim_view' => __DIR__ . '/../controllers/claim/claim_view.php',
    'reward_view' => __DIR__ . '/../controllers/reward/reward_view.php',
    'admin_view' => __DIR__ . '/../controllers/admin/admin_view.php',
    'logout' => __DIR__ . '/../public/logout.php',
];

// Get requested page
$page = $_GET['page'] ?? 'dashboard';

if (isset($routes[$page]) && file_exists($routes[$page])) {
    ob_start();
    include $routes[$page];
    $pageContent = ob_get_clean();

    render_layout($pageContent);
} else {
    http_response_code(404);
    render_layout('<h2>404 - Page not found</h2>');
}
