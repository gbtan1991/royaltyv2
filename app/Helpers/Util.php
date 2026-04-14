<?php

namespace App\Helpers;

class Util
{
    public static function dd($data)
    {
        echo '<pre style="background-color: #1a1a1a; color: #00ff00; padding: 20px; border-radius: 8px; font-family: monospace; line-height: 1.5; overflow: auto; margin: 20px;">';

        // Use var_dump or print_r with formatting
        if (is_array($data) || is_object($data)) {
            print_r($data);
        } else {
            var_dump($data);
        }

        echo '</pre>';
        die(); // This is the "Die" part—it stops the page right here
    }
}