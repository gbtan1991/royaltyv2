<?php 

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../helpers/format.php';

// // Check if the user is logged in
// if (!isset($_SESSION['admin'])) {
//     header('Location: ../../public/login.php');
//     exit;
// }



// Get search input
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Fetch matching customers
$customerModel = new Customer($pdo);
$customers = $customerModel->searchCustomer($search);

foreach ($customers as $customer): ?>
    <tr>
        <td><?= htmlspecialchars($customer['id']) ?></td>
        <td><?= htmlspecialchars($customer['username']) ?></td>
        <td><?= htmlspecialchars($customer['fullname']) ?></td>
        <td><?= formatGender($customer['gender']) ?></td>
        <td><?= formatShortDate($customer['birthdate']) ?></td>
        <td><?= htmlspecialchars($customer['total_points']) ?></td>
        <td><?= formatShortDate($customer['created_at']) ?></td>
        <td>
        <a href="">Profile</a><i class="fa-solid fa-user"></i>
        <a href="index.php?page=customer_edit&id=<?= $customer['id'] ?>"><i class="fa-solid fa-wrench"></i></a>
        <a href="index.php?page=delete_customer&id=<?= $customer['id'] ?>" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></a>
        </td>
     </tr>

        <?php endforeach; ?>
