<?php

require_once __DIR__ . '/../models/admin.php';


// if(!isset($_SESSION['admin'])){
//     header('Location: login.php');
//     exit();
// }

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if(Admin::getAdminByUsername($pdo, $username)) {
        header("Location: ../views/add_admin.php?error=Username_exists");
        exit;
    }

    if(Admin::addAdmin($pdo, $username, $password, $role)) {
        header("Location: ../views/add_admin.php?success=Admin_added");
        exit;

    } else {
        header("Location: ../views/add_admin.php?error=Failed to add admin");   
        exit;
    }
       
}