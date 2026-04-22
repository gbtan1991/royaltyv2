<?php

namespace App\Helpers;

class Route {
    private static $router;

    /**
     * Hand the Bramus Router instance to this helper
     */
    public static function init($router) {
        self::$router = $router;
    }

    /**
     * Handle GET requests
     */
    public static function get($path, $handler) {
        self::addRoute('get', $path, $handler);
    }

    /**
     * Handle POST requests
     */
    public static function post($path, $handler) {
        self::addRoute('post', $path, $handler);
    }

    /**
     * The magic translator logic
     */
    private static function addRoute($method, $path, $handler) {
        if (is_array($handler)) {
            // Converts [Controller::class, 'method'] to 'Namespace\Controller@method'
            $handler = $handler[0] . '@' . $handler[1];
        }
        
        // Pass the final string or closure to Bramus
        self::$router->$method($path, $handler);
    }
}