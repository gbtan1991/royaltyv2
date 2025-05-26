<?php
require_once __DIR__ . '/../../config/config.php';

$basePublicUrl = BASE_URL . 'public/';

// Define buttons with the same structure as sidebar
$dashboardButtons = [
    ['page' => 'customer_add', 'label' => 'Register New Customer', 'logo' => 'fa-solid fa-user-plus'],
    ['page' => 'transaction_add', 'label' => 'Add New Transaction', 'logo' => 'fa-solid fa-square-plus'],
    ['page' => 'reward_add', 'label' => 'Customer Claim Rewards', 'logo' => 'fa-solid fa-certificate'],
    ['page' => 'claim_add', 'label' => 'Add New Reward', 'logo' => 'fa-solid fa-gift'],
];
?>

<div class="button-dashboard">
    <?php foreach ($dashboardButtons as $btn): ?>
        <?php
            $href = $basePublicUrl . 'index.php?page=' . $btn['page'];
            $label = $btn['label'];
            $logo = $btn['logo'] ?? '';
        ?>
        <a href="<?= $href ?>" class="dashboard-button-link">
            
                <i class="<?= $logo ?>"></i> <?= $label ?>
        
        </a>
    <?php endforeach; ?>
</div>
