<?php
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../helpers/format.php';

$customerModel = new Customer($pdo);
$customers = $customerModel->getAllCustomers(); // You’ll define this next
?>

<h2>List of Customers</h2>

<?php if(isset($_GET['success'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
<?php endif; ?>
<?php if(isset($_GET['error'])): ?>
    <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
<?php endif; ?>

<input type="text" id="search-customer" placeholder="Search Customer">

<table id="customer-table">
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
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= htmlspecialchars($customer['id']) ?></td>
                <td><?= htmlspecialchars($customer['username']) ?></td>
                <td><?= htmlspecialchars($customer['fullname']) ?></td>
                <td><?= formatGender($customer['gender']) ?></td>
                <td><?= formatShortDate($customer['birthdate']) ?></td>
                <td><?= formatHoursFromPoints($customer['total_points']) ?></td>
                <td><?= formatShortDate($customer['created_at']) ?></td>
                <td><a href="index.php?page=customer_edit&id=<?= $customer['id'] ?>">Edit</a></td>
                <td><a href="index.php?page=delete_customer&id=<?= $customer['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="pagination-controls"></div>

<script src="../../../assets/js/customer.js"></script>
