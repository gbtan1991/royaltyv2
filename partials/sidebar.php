




<aside class="sidebar">
    <div class="sidebar-header">
        <img src="../assets/image/royalty-logo.png" alt="Royalty logo" class="sidebar-logo">
        <h1>Royalty</h1>
        <p>Rewards Application</p>
    </div>

    <nav class="sidebar-nav">
      
        <?php 

        $navItems = [
            ['href' => '/royaltyv2/views/dashboard.php', 'label' => 'Dashboard', 'logo' => 'fa-solid fa-chart-simple'],
            ['href' => '../controllers/customer/customer_view.php', 'label' => 'Manage Customers', 'logo' => 'fa-solid fa-users'],
            ['href' => '../controllers/transaction/transaction_view.php', 'label' => 'Manage Transactions', 'logo' => 'fa-solid fa-handshake-simple'],
            ['href' => '../controllers/reward/reward_view.php', 'label' => 'Manage Rewards', 'logo' => 'fa-solid fa-gift'],
            ['href' => '../public/logout.php', 'label' => 'Logout', 'logo' => 'fa-solid fa-right-from-bracket'],
            ['href' => '../controllers/claim/claim_view.php', 'label' => 'View Claims']

        ];

        if ($_SESSION['role'] == 'superadmin') {
            
            $manageAdmin = ['href' => '../controllers/admin/admin_view.php', 'label' => 'Manage Admin Accounts', 'logo' => 'fa-solid fa-user-tie'];

            array_splice($navItems, 4, 0, [$manageAdmin]);
          
        }


        foreach ($navItems as $navItem){
            $href = $navItem['href'];
            $label = $navItem['label'];
            $logo = $navItem['logo'] ?? null; // Use null if 'logo' is not set
            include __DIR__ . '/components/nav-button.php';

        }

        ?>




    </nav>
</aside>