<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Admin.php';

session_start(); // Start session to check if user is logged in

// Check if user is logged in and has superadmin role
if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'superadmin') {
    header('Location: ../public/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = $_POST['id'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); // Optional
    $role = $_POST['role'];

    // Check if username is empty
    if (empty($username)) {
        header("Location: ../views/edit_admin.php?id=$id&error=Username is required.");
        exit();
    }

    // Instantiate Admin model
    $adminModel = new Admin($pdo);

    try {
        // Check if admin exists by ID
        $existingAdmin = $adminModel->getAdminById($id);
        if (!$existingAdmin) {
            header("Location: ../controllers/admin_view.php?error=Admin not found.");
            exit();
        }

        // Update logic based on whether password is provided or not
        if (!empty($password)) {
            // If password is provided, hash and update
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $adminModel->updateAdminWithPassword($id, $username, $hashed_password, $role);
        } else {
            // If no password, only update username and role
            $adminModel->updateAdmin($id, $username, $role);
        }

        // Redirect back to admin list with success message
        header("Location: ../controllers/admin_view.php?success=Admin updated successfully.");
        exit();
    } catch (Exception $e) {
        // Handle any errors and redirect back with error message
        header("Location: ../views/edit_admin.php?id=$id&error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    // If request is not POST, redirect to admin list
    header('Location: ../controllers/admin_view.php');
    exit();
}
