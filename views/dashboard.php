<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/session.php';

if(!isset($_SESSION['admin'])){
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    
    <h2>Welcome, <?= htmlspecialchars($_SESSION['admin']) ?>!</h2>
    <h3>Your ID is, <?= htmlspecialchars(string: $_SESSION['admin_id']) ?> and your role is, <?= htmlspecialchars($_SESSION['role']) ?></h3>

    <?php if($_SESSION['role'] == "superadmin"): ?>
    <!-- <a href="../controllers/admin/test.php">Test</a> -->
    <a href="../controllers/admin/admin_view.php">Manage Admin Accounts</a>
    <?php endif; ?>

    <a href="../public/logout.php">Logout</a>
    
</body>
</html>