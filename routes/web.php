<?php
/** @var \Bramus\Router\Router $router */

$router->get('/', function() {
    echo "<h1>Home Page</h1>";
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