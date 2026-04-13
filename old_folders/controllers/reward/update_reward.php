<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../models/Reward.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../views/reward/edit_reward.php?error=Invalid request');
    exit;
}

$id = $_POST['id'];
$reward_name = $_POST['reward_name'];
$required_points = $_POST['required_points'];
$reward_description = $_POST['reward_description'];

$rewardModel = new Reward($pdo);

try {
    $existingReward = $rewardModel->getRewardById($id);

    if (!$existingReward) {
        header('Location: index.php?page=reward_view&error=Reward not found');
        exit;
    }

    $rewardSuccess = $rewardModel->updateReward($id, $reward_name, $required_points, $reward_description);

    if ($rewardSuccess) {
        header('Location: index.php?page=reward_view&success=Reward updated successfully');
        exit;
    } else {
        header('Location: index.php?page=reward_view&id=' . $id . '&error=Failed to update reward');
        exit;
    }
} catch (Exception $e) {
    header('Location: index.php?page=reward_view&id=' . $id . '&error=' . urlencode($e->getMessage()));
    exit;
}
