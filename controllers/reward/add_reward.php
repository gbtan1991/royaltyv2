<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Reward.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reward_name = $_POST['reward_name'];
    $required_points = $_POST['required_points'];
    $reward_description = $_POST['reward_description'];

    $rewardModel = new Reward($pdo);

    $reward = $rewardModel->addReward($reward_name, $required_points, $reward_description);
    if($reward) {
        header("Location: reward_view.php?success=Reward added successfully");
        exit;
    } else {
        header("Location: reward_view.php?error=Reward not added");
        exit;
    }
}


