<?php
/** @var \Bramus\Router\Router $router */
session_start();
$_SESSION["username"] = "gbtan23";
$_SESSION["role"] = "admin";




session_destroy();



$router->get('/', function() {





    echo "<h1>Home Page</h1>"; 
    echo "<p>Welcome, " . $_SESSION["username"] . "!</p> you are logged in as " . $_SESSION["role"] . ".";
    echo "<a href='search'>Go to Search</a>"; 
    echo "<br><a href='about'>Go to About</a>";
    echo "<br><a href='contact'>Go to Contact</a>";
});

$router->get('/search', function() {
    require __DIR__ . '/../views/search.php'; 
});

$router->get("/about", function() {
    require __DIR__ . '/../views/about.php'; 
});

$router->get('/contact', function() {
    require __DIR__ . '/../views/contact.php'; 
});

// Admin Resource Routes
$router->get('/admin', 'App\Controllers\admin\AdminController@index');          // List all
$router->get('/admin/create', 'App\Controllers\admin\AdminController@create');   // Show form to add
$router->post('/admin/store', 'App\Controllers\admin\AdminController@store');    // Save new record
$router->get('/admin/show/(\d+)', 'App\Controllers\admin\AdminController@show'); // View one
$router->get('/admin/edit/(\d+)', 'App\Controllers\admin\AdminController@edit'); // Show form to edit
$router->post('/admin/update/(\d+)', 'App\Controllers\admin\AdminController@update'); // Save changes
$router->post('/admin/destroy/(\d+)', 'App\Controllers\admin\AdminController@destroy'); // Delete

// You can keep the customer ones separate
$router->get('/search', '\App\Controllers\CustomerController@index');


// Customer Resours Routes
$router->get('/customer', 'App\Controllers\customer\CustomerController@index');