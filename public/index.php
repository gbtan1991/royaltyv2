<?php 

require_once '../config/database.php';

//Check if the admin is logged in
if(!isset($_SESSION['admin'])){
    header('Location: login.php');
    exit();
} else {
    header('Location: ../views/dashboard.php');
    exit();
}

?>