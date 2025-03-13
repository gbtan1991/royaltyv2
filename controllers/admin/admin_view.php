<?php
// Load Database connection and Admin Model
require_once __DIR__ . '/../../config/database.php'; // DB connection
require_once __DIR__ . '/../../config/session.php';  // Session start
require_once __DIR__ . '/../../models/Admin.php';   // Admin model

// Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: ../public/login.php');
    exit();
}

// Check if user is superadmin
if ($_SESSION['role'] !== 'superadmin') {
    header('Location: /../../views/dashboard.php');
    exit();
}

// Fetch admins list using the Admin model
$adminModel = new Admin($pdo);
$admins = $adminModel->getAllAdmins();

// Now pass $admins to the view (included here)
require_once __DIR__ . '/../../views/admin/admin_view.php';
