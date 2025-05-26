<?php 


function render_layout($content){

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
  include __DIR__ . '../../partials/components/button-dashboard.php';
  $buttonsDashboard = ob_get_clean();

  
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
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
   
</body>
</html>
HTML;

}