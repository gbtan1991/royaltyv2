<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/session.php'; // Ensure session starts

// If the admin is already logged in, redirect to the dashboard
if (isset($_SESSION['admin'])) {
    header('Location: ../views/dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Royalty - Login</title>
</head>
<body>

<div class="login-container">
    <div class="container">
    <img src="../assets/image/royalty-logo.png" alt="Royalty Logo" class="logo">
    <h2>Admin Login</h2>

    <?php if (isset($_GET['error'])): ?>
        <p class="error"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <form action="../controllers/auth.php" method="post" class="form-login">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" >Login</button>
    </form>
    </div>
</div>
</body>
</html>