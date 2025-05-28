<?php 


require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../helpers/format.php';
require_once __DIR__ . '/../helpers/randomizer.php';

$pageTitle = isset($_GET['page']) 
    ? ucwords(str_replace('_', ' ', $_GET['page'])) 
    : "Dashboard";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/266a593bd6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Royalty - <?= $pageTitle ? $pageTitle : "" ?></title>
</head>
<body>

    <header class="header">
        <div>
            <h1 class="page-title"><?= $pageTitle ? $pageTitle : "" ?></h1>
        </div>

        <div class="settings">
            <div class="admin-name">
                <i class="fa-solid fa-user icon-user"></i>
                <p><?= formatAdmin($_SESSION['admin']) ?>
                </p></div>
            <div class="admin-details">
                <p>ID: <?= htmlspecialchars($_SESSION['admin_id']) ?></p>
                <p>Role: <?= formatRole($_SESSION['role']) ?></p>
            </div>
            <div class="settings-container">
                <i class="fa-solid fa-gear settings-icon" id="settingsToggle"></i>
                <div class="settings-dropdown" id="settingsDropdown">
                    <div class="settings-wrapper">
                        <a href="#">Settings</a>
                        <a href="../public/logout.php">Logout</a>
                    </div>
                </div>
        </div>
        


    </header>

