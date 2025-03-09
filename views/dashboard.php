<?php

require_once __DIR__ . '/../config/database.php';

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

    <a href="../views/add_admin.php">Add Admin</a>
    <a href="../public/logout.php">Logout</a>
    
</body>
</html>