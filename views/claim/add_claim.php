<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../models/Reward.php';

//Ensure admin is logged in
if (!isset($_SESSION['admin'])){
    header('Location: ../../public/login.php');
    exit();
}

$rewardModel = new Reward($pdo);
$rewards = $rewardModel->getAllRewards();

$customerModel = new Customer($pdo);
$customers = $customerModel->getAllCustomers();
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
        <label for="reward_id" id="reward_id">Select Rewards</label> 
        <select name="reward_id" id="reward_id" required>
           <option value="">-- Select Reward --</option>
            <?php foreach ($rewards as $reward) : ?>
                <option value="<?= $reward['id'] ?>">
                    <?= htmlspecialchars($reward['reward_name']) ?> (Required Points: <?= $reward['required_points'] ?>)
                </option>
            <?php endforeach; ?>

        </select>
        <br><br>

        <label for="customer_id">Select Customer:</label>
        <select name="customer_id" id="customer_id" required>
            <option value="">-- Select Customer --</option>
            <?php foreach ($customers as $customer) : ?>
                <option value="<?= $customer['id'] ?>">
                    <?= htmlspecialchars($customer['username']) ?> (Total Points: <?= $customer['total_points'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <input type="submit" value="Claim Reward">
        </select>
    </form>
</body>
</html>