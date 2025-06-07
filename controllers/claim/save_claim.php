<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../models/Claim.php';
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../models/Reward.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?page=claim_view&error=Invalid Request Method');
    exit();

}

// Validate required fields

$reward_id = $_POST['reward_id'] ?? null;
$customer_id = $_POST['customer_id'] ?? null;
$remarks = $_POST['remarks'] ?? null;
$admin_id = $_SESSION['admin_id'] ?? null;



if (!$reward_id || !$customer_id || !$remarks || !$admin_id) {
    header('Location: index.php?page=claim_view&error=Mising required data');
}

// Instance models

$rewardModel = new Reward($pdo);
$customerModel = new Customer($pdo);
$claimModel = new Claim($pdo);


// Get reward Details

$reward = $rewardModel->getRewardById($reward_id);
$customer = $customerModel->getCustomerById($customer_id);

if (!$reward || !$customer) {
    header('Location: index.php?page=claim_view&error=Invalid Reward or Customer ID');
    exit;
}

//  Check if customer has enough points
if ($customer['total_points'] < $reward['required_points']) {
    header('Location: index.php?page=claim_view&error=Not enought points to claim this reward');
    exit;
}


try {
    // Start transaction
    $pdo->beginTransaction();


    //Insert claim
    $claimSuccess = $claimModel->addClaim($customer_id, $admin_id, $reward_id, $reward['required_points'], $remarks ?? '');

    $updatePoints = $customerModel->deductPoints($customer_id, $reward['required_points']);

    if ($claimSuccess && $updatePoints) {
        $pdo->commit();
        header('Location: index.php?page=claim_view&success=Claim added successfully');
    } else {
        $pdo->rollBack();
        header('Location: index.php?page=claim_view&error=Failed to add claim');
    }

    exit;
} catch (Exception $e) {
    $pdo->rollback();
    header('Location: index.php?page=claim_view&error=An error occurred: ' . $e->getMessage());
    exit;
}


