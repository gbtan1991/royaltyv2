<?php

if (!function_exists('view')) {

    function view($path, $data = [])
    {

       extract($data);

       $basePath = __DIR__ . '/../../views/';

       $fullPath = $basePath . $path . '.php';


       if (file_exists($fullPath)) {
        return require $fullPath;
       }

       die ("View [{$path}] not found in {$fullPath}");
    }
}

if (!function_exists('redirect')) {
    /**
     * Redirects to a path relative to the public folder
     */
    function redirect($path)
    {
        $baseUrl = "/royaltyv2/public/";
        $target = $baseUrl . ltrim($path, '/');
        
        if (!headers_sent()) {
            header("Location: " . $target);
        } else {
            // JavaScript fallback if output has already started
            echo '<script>window.location.href="' . $target . '";</script>';
        }
        exit();
    }
}