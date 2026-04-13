<?php 
require_once '../config/session.php';

// Check login first
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

// Load the router
require_once '../router/router.php';
