<?php
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../config/database.php';

// session_start();
// if (!isset($_SESSION['admin'])) {
//     header('Location: ../public/login.php');
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // ✅ Create an instance of Admin
    $adminModel = new Admin($pdo);

    // ✅ Check if username already exists
    try {
        $existingAdmin = $adminModel->getAdminByUsername($username);
        if ($existingAdmin) {
            header("Location: ../views/add_admin.php?error=Username_exists");
            exit;
        }
    } catch (Exception $e) {
        // If user is not found, we can proceed with adding
    }

    // ✅ Add the new admin
    $success = $adminModel->addAdmin($username, $password, $role);
    if ($success) {
        header("Location: ../views/add_admin.php?success=Admin_added");
        exit;
    } else {
        header("Location: ../views/add_admin.php?error=Failed_to_add_admin");
        exit;
    }
}
?>
