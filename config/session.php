<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();

    // Example: Storing admin session after login
    $_SESSION['admin'] = [
        'id' => $admin_id, 
        'username' => $admin_username
    ];
}
?>
