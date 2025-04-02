<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../models/Reward.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../../public/login.php');
    exit();

}

$rewardModel = new Reward($pdo);
$reward = $rewardModel->getAllRewards(); // Get all rewards from the database

require_once __DIR__ . '/../../views/reward/reward_view.php';
