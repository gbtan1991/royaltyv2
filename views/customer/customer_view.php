<?php
require_once __DIR__ . '/../../helpers/format.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Customers</title>
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
    <h2>List of Customers</h2>

    <?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <!-- Search Bar -->
     <input type="text" id="search-customer" placeholder="Search Customer" >


    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Accumulated Time</th>
                <th>Registered Date</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody id="customer-table-body">
            <?php if (!empty($customers)): ?>
                <?php foreach ($customers as $customer) : ?>
                    <tr>
                        <td><?= htmlspecialchars($customer['id']) ?></td>
                        <td><?= htmlspecialchars($customer['username']) ?></td>
                        <td><?= htmlspecialchars($customer['fullname']) ?></td>
                        <td><?= formatGender($customer['gender']) ?></td>
                        <td><?= formatShortDate($customer['birthdate']) ?></td>
                        <td><?= formatHoursFromPoints($customer['total_points']) ?></td>
                        <td><?= formatShortDate($customer['created_at']) ?></td>
                        <td><a href="../../controllers/customer/customer_edit.php?id=<?= $customer['id'] ?>">Edit</a>
                        </td>
                        <td><a href="../../controllers/customer/delete_customer.php?id=<?= $customer['id'] ?>" onclick="return confirm('Are you sure you want to delete this cuustomer?')">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No Customers Found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="../../views/customer/add_customer.php">Register New Customer</a> |
    <a href="../../views/dashboard.php">Back to Dashboard</a>

    <script src="../../assets/js/customer.js">
    </script>
    

</body>
</html>
