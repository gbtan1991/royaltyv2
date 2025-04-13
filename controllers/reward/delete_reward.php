<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Reward.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $rewardModel = new Reward($pdo);

    if ($rewardModel->deleteReward($id)) {
        header('Location: reward_view.php?success=Reward Deleted Successfully');
        exit;

    } else {
        header('Location: reward_view.php?error=Failed to Delete Reward');
        exit;
    }


} else {
    // Handle the case when the id is not set
    header('Location: reward_view.php?error=Invalid Request');
    exit;
}