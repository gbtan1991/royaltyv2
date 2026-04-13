<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../models/Reward.php';


if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?page=reward_view&error=Missing reward ID");
    exit;
}

$rewardModel = new Reward($pdo);
$reward = $rewardModel->getRewardById($_GET['id']);

if(!$reward){
    header("Location: index.php?page=reward_view&error=Reward not found");
    exit;
}

//Load the reward edit form
require_once __DIR__ . '/../../views/reward/edit_reward.php';