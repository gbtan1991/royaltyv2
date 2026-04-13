<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Reward.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $rewardModel = new Reward($pdo);

    if ($rewardModel->deleteReward($id)) {
        header('Location: index.php?page=reward_view&success=Reward Deleted Successfully');
        exit;

    } else {
        header('Location: index.php?page=reward_view&error=Failed to Delete Reward');
        exit;
    }


} else {
    // Handle the case when the id is not set
    header('Location: index.php?page=reward_view&error=Invalid Request');
    exit;
}