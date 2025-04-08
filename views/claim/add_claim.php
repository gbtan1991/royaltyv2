<?php
require_once __DIR__ . '/../../config/databse.php';
require_once __DIR__ .'../../models/Claim.php';
require_once __DIR__ . '../../models/session.php';

//Ensure admin is logged in
if (!isset($_SESSION['admin'])){
    header('Location: ../../public/login.php');
    exit();
}

$claimModel = new Claim($pdo);
$claims = $claimModel->getAllClaims();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Rewards</title>
</head>
<body>
    <h2>Claim Rewards</h2>
    
    <?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="customer_username" id="customer_username">Customer Username:</label>
    </form>
</body>
</html>