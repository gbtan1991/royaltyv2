<?php

function render_layout($content, $currentPage = '', $category = '') {
    require_once __DIR__ . '../../config/config.php';

    $baseUrl = BASE_URL ?? '';

    ob_start();
    include __DIR__ . '../../partials/header.php';
    $header = ob_get_clean();

    ob_start();
    include __DIR__ . '../../partials/sidebar.php';
    $sidebar = ob_get_clean();

    ob_start();
    include __DIR__ . '../../partials/footer.php';
    $footer = ob_get_clean();

    ob_start();
    $buttonComponentPath = __DIR__ . "../../partials/components/buttons/{$category}/{$currentPage}.php";
    if (file_exists($buttonComponentPath)) {
        include $buttonComponentPath;
    }
    $buttonsDashboard = ob_get_clean();

    // JS includes — simple if-else
    $scriptTag = '';

    if ($category === 'dashboard') {
        $scriptTag = "<script src=\"{$baseUrl}assets/js/dashboard.js\"></script>";
    } elseif ($category === 'customer') {
        $scriptTag = "<script src=\"{$baseUrl}assets/js/customer.js\"></script>";
    } elseif ($category === 'transaction') {
        $scriptTag = "<script src=\"{$baseUrl}assets/js/transaction.js\"></script>";
    } elseif ($category === 'claim') {
        $scriptTag = "<script src=\"{$baseUrl}assets/js/claim.js\"></script>";
    }

    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Royalty Rewards App</title>
    <link rel="icon" type="image/x-icon" href="{$baseUrl}assets/image/royalty-logo.ico" />
    <link rel="stylesheet" href="{$baseUrl}assets/css/style.css" />
</head>
<body>
    $header
    <div>
        $sidebar
        <div class="main-content">
            $buttonsDashboard
            $content
        </div>
    </div>
    $footer
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    $scriptTag
</body>
</html>
HTML;
}
