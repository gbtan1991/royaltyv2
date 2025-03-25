<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../models/Customer.php';
require_once __DIR__ . '/../helpers/format.php';

if(!isset($_SESSION['admin'])){
    header('Location: login.php');
    exit();
}

// Fetching Customers

$customerModel = new Customer($pdo);

$customers = $customerModel->getLatestCustomers();
$customerCount = $customerModel->getCustomerCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    
    <h2>Welcome, <?= htmlspecialchars($_SESSION['admin']) ?>!</h2>
    <h3>Your ID is, <?= htmlspecialchars( $_SESSION['admin_id']) ?> and your role is, <?= htmlspecialchars($_SESSION['role']) ?></h3>
    
    <div >
        <h3>Total Customers</h3>
        <p><?= htmlspecialchars($customerCount) ?></p>
    </div>
    

    <div style="display: flex; align-items: center; justify-content: space-between;">
    <h3>Latest Customers</h3>
    <a href="../views/customer/add_customer.php">Add Customer</a>
    <a href="../controllers/customer/customer_view.php">View List</a>    
    </div>
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


    <?php if($_SESSION['role'] == "superadmin"): ?>
    <!-- <a href="../controllers/admin/test.php">Test</a> -->
    <a href="../controllers/admin/admin_view.php">Manage Admin Accounts</a>
    <?php endif; ?>
    <a href="../controllers/transaction/transaction_view.php">Manage Transactions</a>
    <a href="../public/logout.php">Logout</a>
    
</body>
</html>