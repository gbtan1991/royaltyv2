<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Admin.php';



// Check if user is logged in and has superadmin role
if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'superadmin') {
    header('Location: ../../public/login.php');
    exit();
}

// Ensure ID is provided
if (isset($_GET['id'])) {
    $adminId = $_GET['id'];
    $loggedInAdminId = $_SESSION['admin_id']; // This should store the logged-in user's ID from session

    // ✅ Fail-safe: Prevent deleting own account
    if ($adminId == $loggedInAdminId) {
        // Don't allow self-deletion
        header('Location: ../../controllers/admin/admin_view.php?error=You cannot delete your own account!');
        echo "Admin id is $adminId and logged in admin id is $loggedInAdminId";
        exit();
    } else {
        // Proceed with deletion if NOT same as logged-in admin
        $adminModel = new Admin($pdo);

        if ($adminModel->deleteAdmin($adminId)) {
            header('Location: ../../controllers/admin/admin_view.php?success=Admin deleted successfully.');
            exit();
        } else {
            header('Location: ../../controllers/admin/admin_view.php?error=Failed to delete admin.');
            exit();
        }
    }
} else {
    // If no ID provided
    header('Location: ../../controllers/admin/admin_view.php?error=No admin ID provided.');
    exit();
}
?>
