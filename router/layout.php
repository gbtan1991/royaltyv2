<?php 


function render_layout($content){



  ob_start();
  include __DIR__ . '../../partials/header.php';
  $header = ob_get_clean();

  ob_start();
  include __DIR__ . '../../partials/sidebar.php';
  $sidebar = ob_get_clean();

  ob_start();
  include __DIR__ . '../../partials/footer.php';
  $footer = ob_get_clean();

  
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
    <div class="container">
        $sidebar
        <main>
            $content
        </main>
    </div>
    $footer
</body>
</html>
HTML;

}