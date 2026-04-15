<?php

namespace App\Controllers\admin;

use App\Models\Admin; // Import the Model instead of the Database

class AdminController {
    
    protected function render($view, $data = []) {
        extract($data);
        $viewFile = __DIR__ . "/../../../views/admin/{$view}.php";
        
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View file not found.");
        }
    }

    public function index() {
        // The Controller just asks the Model for data
        $admins = Admin::getAll();

        // Then it hands that data to the View
        $this->render('index', ['admins' => $admins]);
    }
}