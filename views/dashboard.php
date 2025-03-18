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
$customers = $customerModel->getAllCustomers();


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
    
    <a href="">Add Customer</a>

    <div style="display: flex; align-items: center; justify-content: space-between;">
    <h3>List of Customers</h3>
    <a href="../controllers/customer/customer_view.php">View List</a>    
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Registered Date</th>
            </tr>
            <tbody>
                <?php if (!empty($customers)): ?>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td><?= htmlspecialchars($customer['id']) ?></td>
                        <td><?= htmlspecialchars($customer['username'])?></td>
                        <td><?= htmlspecialchars($customer['fullname'])?></td>
                        <td><?= formatDateTime($customer['created_at'])?></td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="7">No Customers Found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </thead>
    </table>


    <?php if($_SESSION['role'] == "superadmin"): ?>
    <!-- <a href="../controllers/admin/test.php">Test</a> -->
    <a href="../controllers/admin/admin_view.php">Manage Admin Accounts</a>
    <?php endif; ?>

    <a href="../public/logout.php">Logout</a>
    
</body>
</html>