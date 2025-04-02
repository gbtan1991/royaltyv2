<?php
require_once __DIR__ . '/../../config/database.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Rewards</title>
</head>
<body>
    <h2>Add New Rewards</h2>

    
    <?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>


    <form action="../../controllers/reward/add_reward.php" method="post">
        <label for="reward_name">Reward Name:</label>
        <input type="text" id="reward_name" name="reward_name" required><br><br>

        <label for="required_points">Reward Points:</label>
        <input type="number" id="required_points" name="required_points" required><br><br>

        <label for="reward_description">Reward Description:</label>
        <textarea id="reward_description" name="reward_description" required></textarea><br><br>
        <input type="submit" value="Add Reward">
        <a href="../../controllers/reward/reward_view.php">Back to Reward List</a>
    </form> 
    
</body>
</html>