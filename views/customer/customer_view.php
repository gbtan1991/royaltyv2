<?php
require_once __DIR__ . '/../../helpers/format.php';
?>

<div class="customer-view-layout">
<h2>List of Customers</h2>

<?php if(isset($_GET['success'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
<?php endif; ?>
<?php if(isset($_GET['error'])): ?>
    <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
<?php endif; ?>

<input type="text" id="search-customer" placeholder="Search Customer">

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Birth Date</th>
            <th>Accumulated points</th>
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
                <td><?= ($customer['total_points']) ?></td>
                <td><?= formatShortDate($customer['created_at']) ?></td>
                <td class="table-actions">
                <a href=""><i class="fa-solid fa-user"></i></a></i>
                <a href="index.php?page=customer_edit&id=<?= $customer['id'] ?>"><i class="fa-solid fa-wrench"></i></a>
                <a href="index.php?page=delete_customer&id=<?= $customer['id'] ?>" class="delete-button" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



</div>


<div id="pagination-controls">
    <button id="prev-page" class="pagination"
</div>
