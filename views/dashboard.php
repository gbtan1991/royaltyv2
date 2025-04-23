<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../helpers/format.php';
require_once __DIR__ . '/../helpers/randomizer.php';

if(!isset($_SESSION['admin_id'])){
    header('Location: ../public/login.php');
    exit();
}


// Page Title

$pageTitle = 'Dashboard';

// Fetching Customers

$customerModel = new Customer($pdo);
$transactionModel = new transaction($pdo);

$customers = $customerModel->getLatestCustomers();
$customerCount = $customerModel->getCustomerCount();
$topCustomers = $customerModel->getTopCustomerPoints(3); 


?>

    
<?php include __DIR__ . '../../partials/header.php'; ?>
    
       
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="../assets/image/royalty-logo.png" alt="Royalty Logo" class="sidebar-logo">
            </div>
               
        </aside>
    
        <div class="dashboard-content">
         
            
            
            
    
        <h3>Total Customers</h3>
        <p><?= htmlspecialchars($customerCount) ?></p>
    </div>
    
    
    <div style="display: flex; align-items: center; justify-content: space-between;">
        
        <a href="../views/customer/add_customer.php">Add Customer</a>
        <a href="../controllers/customer/customer_view.php">View List</a>    
    </div>
    <div style="display: flex; gap: 20px">
        <div>
            <h3>Latest Customers</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($customers)): ?>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td><?= htmlspecialchars($customer['id']) ?></td>
                        <td><?= htmlspecialchars($customer['username']) ?></td>
                        <td><?= htmlspecialchars($customer['fullname']) ?></td>
                        <td><?= formatGender($customer['gender']) ?></td>
                       
                        
                    </tr>
                    <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No Customers Found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div>
        
        <h3>Top Customers</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Accumulated Time (Hours)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($topCustomers)): ?>
                    <?php foreach ($topCustomers as $customer): ?>
                        <tr>
                            <td><?= htmlspecialchars($customer['id']) ?></td>
                            <td><?= htmlspecialchars($customer['username']) ?></td>
                            <td><?= formatHoursFromPoints($customer['total_points']) ?></td>
                            <!-- Assuming each 1 point = 30 mins, so total_points / 2 gives hours -->
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No top customers found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            
            
            
            <div class="sidebar-nav">
                <?php if($_SESSION['role'] == "superadmin"): ?>
                    <a href="../controllers/admin/admin_view.php">Manage Admin Accounts</a>
                    <?php endif; ?>
                    <a href="../controllers/transaction/transaction_view.php">Manage Transactions</a>
                    <a href="../controllers/reward/reward_view.php">Manage Rewards</a>
                    <a href="../controllers/claim/claim_view.php">View Claims</a>
                    <a href="../public/logout.php">Logout</a>     
                    
                    
                    
                </div>
                    
                </div>
                <script src="../assets/js/dashboard.js"></script>
            </body>
            </html>