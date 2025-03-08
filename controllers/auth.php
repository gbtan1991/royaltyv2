<?php
require_once __DIR__ . '/../models/admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin = Admin::getAdminByUsername($pdo, $username);

    if ($admin) {
        echo "Stored Hash: " . $admin['password_hash'] . "<br>";
        echo "Entered Password: " . $password . "<br>";

        if (password_verify($password, $admin['password_hash'])) {
            echo "Password Matched! Redirecting...";
            $_SESSION['admin'] = $admin['username'];
            header("Location: ../public/dashboard.php");
            exit;
        } else {
            echo "Password Mismatch!";
        }
    } else {
        echo "User not found!";
    }
    exit;
}




?>
