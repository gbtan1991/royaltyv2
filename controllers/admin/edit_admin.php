<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Admin.php';
require_once __DIR__ . '/../../config/session.php'; // Always handle session

// ✅ Check if logged in and is superadmin
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] !== 'superadmin') {
    header('Location: ../../public/login.php');
    exit;
}

// ✅ Check if "id" is provided
if (!isset($_GET['id'])) {
    header('Location: index.php?page=admin_view&error=Admin ID is missing.');
    exit;
}

$adminModel = new Admin($pdo);

try {
    // ✅ Get admin details based on ID
    $admin = $adminModel->getAdminById($_GET['id']);
    if (!$admin) {
        header('Location: index.php?page=admin_view&error=Admin not found.');
        exit;
    }
} catch (Exception $e) {
    header('Location: index.php?page=admin_view&error=' . urlencode($e->getMessage()));
    exit;
}

// ✅ Load the view and pass $admin
require_once __DIR__ . '/../../views/admin/edit_admin.php';

