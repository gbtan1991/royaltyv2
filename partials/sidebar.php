<?php
require_once __DIR__ . '/../config/config.php';
// Base URL path to the public folder where index.php is located
$basePublicUrl = BASE_URL . 'public/';

// Define nav items with page keys instead of direct file paths
$navItems = [
    ['page' => 'dashboard', 'label' => 'Dashboard', 'logo' => 'fa-solid fa-chart-simple'],
    ['page' => 'customer_view', 'label' => 'Manage Customers', 'logo' => 'fa-solid fa-users'],
    ['page' => 'transaction_view', 'label' => 'Manage Transactions', 'logo' => 'fa-solid fa-handshake-simple'],
    ['page' => 'claim_view', 'label' => 'View Claims', 'logo' => 'fa-solid fa-certificate'],
    ['page' => 'reward_view', 'label' => 'Manage Rewards', 'logo' => 'fa-solid fa-gift'],
    ['page' => 'logout', 'label' => 'Logout', 'logo' => 'fa-solid fa-right-from-bracket'],
];

if ($_SESSION['role'] == 'superadmin') {
    $insertIndex = count($navItems) - 1;
    $manageAdmin = ['page' => 'admin_view', 'label' => 'Manage Admin Accounts', 'logo' => 'fa-solid fa-user-tie'];
    array_splice($navItems, $insertIndex, 0, [$manageAdmin]);
}
?>

<aside class="sidebar">
    <div class="sidebar-header">
        <img src="<?= BASE_URL ?>assets/image/royalty-logo.png" alt="Royalty logo" class="sidebar-logo">
        <h1>Royalty</h1>
        <p>Rewards Application</p>
    </div>

    <nav class="sidebar-nav">
        <?php
        foreach ($navItems as $navItem) {
            // Create href using index.php?page=...
            $href = $basePublicUrl . 'index.php?page=' . $navItem['page'];
            $label = $navItem['label'];
            $logo = $navItem['logo'] ?? '';
            include __DIR__ . '/components/nav-button.php';
        }
        ?>
    </nav>
</aside>
