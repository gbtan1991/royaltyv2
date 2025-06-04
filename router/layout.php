<?php 


function render_layout($content, $currentPage = '', $category = '') {

    require_once __DIR__ . '../../config/config.php';

    $baseUrl = BASE_URL ?? "";



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
    } else {
        //include __DIR__ . '/components/buttons/default.php';
        
    }
    $buttonsDashboard = ob_get_clean();

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
    <script src="{$baseUrl}assets/js/dashboard.js"></script>
    <script src="{$baseUrl}assets/js/customer.js"></script>
    <script src="{$baseUrl}assets/js/transaction.js"></script>
</body>
</html>
HTML;

}

