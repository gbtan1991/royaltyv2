<?php 
require_once __DIR__ . '/../../config/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Edit Rewards</h2>
    
    <?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <form action="../../controllers/reward/edit_reward.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($reward['id']) ?>">
        
        <label for="reward_name">Reward Name:</label>
        <input type="text" id="reward_name" name="reward_name" value="<?= htmlspecialchars($reward['reward_name']) ?>" required><br><br>

        <label for="required_points">Required Points:</label>
        <input type="number" id="required_points" name="required_points" value="<?= htmlspecialchars($reward['required_points']) ?>" required><br><br>

        <label for="reward_description">Reward Description:</label>
        <textarea  id="reward_description" name="reward_description" value="<?= htmlspecialchars($reward['reward_description']) ?>" required></textarea>    <br><br>
        
        <button type="submit">Save Changes</button>
    </form>

</body>
</html>