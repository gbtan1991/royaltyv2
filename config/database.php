<?php 
$host = "localhost";
$user = "root";
$password = "";
$db = "royalty_db";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    session_start();

    // echo "Connected Successfully";

}   catch (PDOExeption $e) {
    die("Connection Failed: " . $e->getMessage());
}



?>