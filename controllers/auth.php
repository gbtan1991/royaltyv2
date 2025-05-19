<?php
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    // ✅ Create an instance of Admin
    $adminModel = new Admin($pdo);

    try {
        // ✅ Call the method using the instance
        $admin = $adminModel->getAdminByUsername($username);

        if (password_verify($password, $admin['password_hash'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin'] = $admin['username'];
            $_SESSION['role'] = $admin['role'];

            // Redirect to dashboard
            header("Location: ../public/index.php?page=dashboard");
            exit;
        } else {
            header("Location: ../public/login.php?error=Invalid credentials");
            exit;
        }
    } catch (Exception $e) {
        header("Location: ../public/login.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}
?>
